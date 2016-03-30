<?php

App::uses('AppController', 'Controller');
App::uses('CakeNumber', 'Utility');

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
            if ($money >= 500001) {
                $conditions[] = 'Transaction.transaction_money >' . $money;
            } else {
                $conditions[] = 'Transaction.transaction_money <=' . $money;
            }
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

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        $this->loadModel('Wallet');
        if ($this->request->is('post')) {
            $this->Transaction->create();
            $data = $this->request->data;

            $typeCategory = $this->Transaction->getTypeCategory($this->data['Transaction']['categorie_id']);
            $return_transaction = $this->Transaction->getWalletById($this->data['Transaction']['wallet_id']);
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

}
