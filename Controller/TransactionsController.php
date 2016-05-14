<?php

App::uses('AppController', 'Controller');
App::uses('CakeNumber', 'Utility');
App::import('Controller', 'Users');

$Users = new UsersController;
$Users->constructClasses();

/**
 * Transactions Controller
 *
 * @property Transaction $Transaction
 * @property PaginatorComponent $Paginator
 */
class TransactionsController extends AppController {
    
     
  
    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->loadModel('User');

        $this->Transaction->recursive = 0;

        $id_auth = $this->Auth->user('id');
        $findWallet = $this->User->findWalletAuth($id_auth);

        $result_wallet_id = Set::classicExtract($findWallet, '{n}.wallets.id');
        
        $categorieId = $this->request->query('categorie_id');
        $walletId = $this->request->query('wallet_id');
        $money = $this->request->query('money');

        $day = $this->request->query('day_start');
        $month = $this->request->query('month_start');
        $year = $this->request->query('year_start');

        $conditions = array('Wallet.id is not null', 'Categorie.id is not null');
        if (!empty($categorieId)) {
            $conditions['Transaction.categorie_id'] = $categorieId;
        }

        if (!empty($walletId)) {
            $conditions['Transaction.wallet_id'] = $walletId;
        } else {
            $conditions['Transaction.wallet_id'] = $result_wallet_id;
        }

        if (!empty($money)) {
                $conditions[] = 'Transaction.transaction_money <=' . $money;
        }

        if (!empty($day)) {
            $conditions['day(Transaction.day_transaction)'] = $day;
        }

        if (!empty($month)) {
            $conditions['month(Transaction.day_transaction)'] = $month;
        }

        if (!empty($year)) {
            $conditions['year(Transaction.day_transaction)'] = $year;
        }

        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => 20);
        
        $countTransaction = count($this->Transaction->find('all',array('conditions'=>$conditions)));
        
        $categoriesIncome = $this->Transaction->getAllCategoriesIncome();
        $categoriesExpense = $this->Transaction->getAllCategoriesExpense();
        $categories = $this->Transaction->findListCategory();
        $wallets = $this->Transaction->findIdWalletAuth($result_wallet_id);
        
        $this->set('transactions', $this->Paginator->paginate());
        $this->set('countTransaction', $countTransaction);
        $this->set(compact('categoriesIncome', 'categoriesExpense', 'categories', 'wallets'));
    }
    
//    public function search() {
//        
//        $this->request->allowMethod('post');
//        
//        $conditions = array();
//        
//        $cate = $this->request->data['searchCate'];
//        $wallet = $this->request->data['searchWallet'];
//        $money = $this->request->data['searchMoney'];
//        $day = $this->request->data['searchDay'];
//        $month = $this->request->data['searchMonth'];
//        $year = $this->request->data['searchYear'];
//        
//        
//        if(!empty($cate)) {
//            $conditions['categorie_id'] = $cate ;
//        }
//          
//        if(!empty($wallet)) {
//            $conditions['wallet_id'] = $wallet ;
//        }
//        
//       if (!empty($money)) {
//                $conditions[] = 'transaction_money <=' . $money;
//        }
//
//        if (!empty($day)) {
//            $conditions['day(day_transaction)'] = $day;
//        }
//
//        if (!empty($month)) {
//            $conditions['month(day_transaction)'] = $month;
//        }
//
//        if (!empty($year)) {
//            $conditions['year(day_transaction)'] = $year;
//        }
//         
//        $searchs = $this->Transaction->find('all', array('conditions' => $conditions ));
//        
//        $searchJsonArrays = array();
//        if(!empty($searchs)) {
//            foreach ($searchs as $search) { 
//
//                $nameCategory = $this->Transaction->findIdCategory($search['Transaction']['categorie_id']);
//                $nameWallet = $this->Transaction->findIdWalletAuth($search['Transaction']['wallet_id']);
//                 
//                $searchJsonArrays[] = ['status' => 0, 'message' => 'OK', 
//                    'id' => $search['Transaction']['id'],
////                    'categorie_id' => $nameCategory[$search['Transaction']['categorie_id']],
//                    'wallet_id' => $nameWallet[$search['Transaction']['wallet_id']],
//                    'transaction_money' => $search['Transaction']['transaction_money'],
//                    'day_transaction' => $search['Transaction']['day_transaction'],
//                    'transaction_description' => $search['Transaction']['transaction_description'],
//                    'created' => $search['Transaction']['created'],
//                    'modified' => $search['Transaction']['modified']
//                    ];
//                
//            }
//            debug($searchJsonArrays);
//            echo json_encode($searchJsonArrays);
//            exit;
//        } else {
//           $searchJsonArrays[] = ['status' => 1, 'message' => 'No Category'];
//            echo json_encode($searchJsonArrays);
//            exit;
//        }
//        die;
//    }

    
    public function view($id) {
        $this->loadModel('User');
    
        if (!$id) {
            throw new NotFoundException(__('Invalid employee'));
        }
        $transaction = $this->Transaction->getTransactionById($id);
        if (!$transaction) {
            throw new NotFoundException(__('Invalid employee'));
        }
        

        $id_auth = $this->Auth->user('id');
        $findWallet = $this->User->findWalletAuth($id_auth);

        $result_wallet_id = Set::classicExtract($findWallet, '{n}.wallets.id');
        $categoriesIncome = $this->Transaction->getAllCategoriesIncome();
        $categoriesExpense = $this->Transaction->getAllCategoriesExpense();
        $categorie = $this->Transaction->findListCategory();
        debug($categorie);
//        debug($transaction);die;
        $this->set('transaction', $transaction);
        $this->set(compact('categoriesIncome', 'categoriesExpense', 'categorie', 'wallets'));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        $this->loadModel('Wallet');
        $this->loadModel('User');
        
        if ($this->request->is('post')) {
            $this->Transaction->create();
            $data = $this->request->data;
            if($this->Auth->user('role') === '0') {
                $this->request->data['Transaction']['user_id'] = $this->Auth->user('id');
            }
            $typeCategory = $this->Transaction->getTypeCategory($this->data['Transaction']['categorie_id']);
            $return_transaction = $this->Transaction->getWalletById($this->data['Transaction']['wallet_id']);
//           debug($this->data['Transaction']['transaction_money']);
//            debug($return_transaction); 
            
//            $condition =  1 ;//- du dieu kien. 
//            if ($typeCategory[$this->data['Transaction']['categorie_id']] == true) {
//                if($return_transaction[0]['Wallet']['money_current'] < $this->data['Transaction']['transaction_money']) {
//                    $condition = 0;
//                } 
//            }  
//            if($condition == 1) {
                if ($this->Transaction->save($data)) {
                if ($typeCategory[$this->data['Transaction']['categorie_id']] == false) { // category - thu 
                    $return_transaction[0]['Wallet']['money_current'] += $this->data['Transaction']['transaction_money'];
                } else {
                    $return_transaction[0]['Wallet']['money_current'] -= $this->data['Transaction']['transaction_money'];
                }
                $this->Wallet->updateAll(array(
                    'Wallet.money_current' => $return_transaction[0]['Wallet']['money_current']), array(
                    'Wallet.id' => $this->data['Transaction']['wallet_id']));
                $this->Flash->success(__('The transaction has been saved.'));
                return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Flash->error(__('The transaction could not be saved. Please, try again.'));
                }
//            } else {
//                $this->Flash->error(__('The transaction could not be saved. Please, try again.'));
//                return $this->redirect(array('action' => 'index'));
//            }
            
        }
        $categories = $this->Transaction->findListCategory();
        $wallets = $this->Transaction->findListWallet();
        $this->set(compact('categories', 'wallets'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        $this->loadModel('Wallet');
        if (!$this->Transaction->exists($id)) {
            throw new NotFoundException(__('Invalid transaction'));
        }
        $beforeTransaction = $this->Transaction->getTransactionById($id);

        if ($this->request->is(array('post', 'put'))) {

            $typeCategoryBefore = $this->Transaction->getTypeCategory($beforeTransaction[0]['transactions']['categorie_id']);

            $beforeWallet = $this->Transaction->getWalletById($beforeTransaction[0]['transactions']['wallet_id']);

            if ($this->Transaction->save($this->request->data)) {

                if ($typeCategoryBefore[$beforeTransaction[0]['transactions']['categorie_id']] == false) {
                    $beforeWallet[0]['Wallet']['money_current'] -= $beforeTransaction[0]['transactions']['transaction_money'];
                } else {
                    $beforeWallet[0]['Wallet']['money_current'] += $beforeTransaction[0]['transactions']['transaction_money'];
                }

                $this->Wallet->updateAll(array(
                    'Wallet.money_current' => $beforeWallet[0]['Wallet']['money_current']), array(
                    'Wallet.id' => $beforeTransaction[0]['transactions']['wallet_id']));

                $typeCategoryEdit = $this->Transaction->getTypeCategory($this->data['Transaction']['categorie_id']);
                $return_transaction = $this->Transaction->getWalletById($this->data['Transaction']['wallet_id']);

                if ($typeCategoryEdit[$this->data['Transaction']['categorie_id']] == false) { // category - thu 
                    $return_transaction[0]['Wallet']['money_current'] += $this->data['Transaction']['transaction_money'];
                } else {
                    $return_transaction[0]['Wallet']['money_current'] -= $this->data['Transaction']['transaction_money'];
                }
                $this->Wallet->updateAll(array(
                    'Wallet.money_current' => $return_transaction[0]['Wallet']['money_current']), array(
                    'Wallet.id' => $this->data['Transaction']['wallet_id']));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The transaction could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Transaction.' . $this->Transaction->primaryKey => $id));
            $this->request->data = $this->Transaction->find('first', $options);
        }
        $categories = $this->Transaction->findListCategory();
        $wallets = $this->Transaction->findListWallet();
        $this->set(compact('categories', 'wallets'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {

        $this->loadModel('Wallet');
        $this->Transaction->id = $id;
        if (!$this->Transaction->exists()) {
            throw new NotFoundException(__('Invalid transaction'));
        }
        $transactionDelete = $this->Transaction->getTransactionById($id);

        $typeCategoryDelete = $this->Transaction->getTypeCategory($transactionDelete[0]['transactions']['categorie_id']);
        $wallet = $this->Transaction->getWalletById($transactionDelete[0]['transactions']['wallet_id']);

        if ($typeCategoryDelete[$transactionDelete[0]['transactions']['categorie_id']] == false) {
            $wallet[0]['Wallet']['money_current'] -= $transactionDelete[0]['transactions']['transaction_money'];
        } else {
            $wallet[0]['Wallet']['money_current'] += $transactionDelete[0]['transactions']['transaction_money'];
        }

        $this->request->allowMethod('post', 'delete');
        if ($this->Transaction->delete()) {
            $this->Wallet->updateAll(array(
                'Wallet.money_current' => $wallet[0]['Wallet']['money_current']), array(
                'Wallet.id' => $transactionDelete[0]['transactions']['wallet_id']));
        } else {
            $this->Flash->error(__('The transaction could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function deleteAll() {
        $this->loadModel('Wallet');
        $this->request->allowMethod('post');

        $ids = $this->request->data['ids'];

        $transactionDelete = array();
        foreach ($ids as $id) {
            $transactionDelete[$id] = $this->Transaction->getTransactionById($id);

            $typeCategoryDelete = $this->Transaction->getTypeCategory($transactionDelete[$id][0]['transactions']['categorie_id']);
            $wallet = $this->Transaction->getWalletById($transactionDelete[$id][0]['transactions']['wallet_id']);

            if ($typeCategoryDelete[$transactionDelete[$id][0]['transactions']['categorie_id']] == false) {
                $wallet[0]['Wallet']['money_current'] -= $transactionDelete[$id][0]['transactions']['transaction_money'];
            } else {
                $wallet[0]['Wallet']['money_current'] += $transactionDelete[$id][0]['transactions']['transaction_money'];
            }
            $this->Wallet->updateAll(array(
                'Wallet.money_current' => '"' . $wallet[0]['Wallet']['money_current'] . '"'), array(
                'Wallet.id' => $transactionDelete[$id][0]['transactions']['wallet_id']));
        }
        $this->Transaction->belongsTo = false;
        if ($this->Transaction->deleteAll(array('id' => $ids), true)) {

            echo json_encode(['status' => 0, 'message' => 'OK']);
            exit;
        }

        echo json_encode(['status' => 1, 'message' => 'Save not success']);
        exit;
    }
    
    public function isAuthorized($user) {
        // Admin can access every action
        if (isset($user['role']) && $user['role'] === '0' && $user['active'] === '1') {
            return true;
        }
        // Default deny
       return false;
    }
        
    public function isAuthorizedT($user) {
        $this->loadModel('User');
        // All registered users can add posts
        if ($this->action === 'add') {
            return true;
        }
        
        
        
        // The owner of a post can edit and delete it
        if (in_array($this->action, array('edit', 'delete', 'UploadImage', 'change_password', 'logout'))) {
            $postId = (int) $this->request->params['pass'][0];
            if ($this->Transaction->isOwnedBy($postId, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }
}
