<?php

App::uses('AppController', 'Controller');
App::uses('CakeNumber', 'Utility');
// echo CakeNumber::currency('1234.56', 'FOO');

/**
 * Wallets Controller
 *
 * @property Wallet $Wallet
 * @property PaginatorComponent $Paginator
 */
class WalletsController extends AppController {

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
        $this->loadModel('Transaction');
        $this->loadModel('TransferWallet');
        $this->loadModel('Category');

        $this->Paginator->settings = array(
            'conditions' => array('User.id' => $this->Auth->user('id'))
        );
        
        $this->Wallet->recursive = 0;

        $sumMoneyWallet = $this->Wallet->find('all', array(
            'fields' => array('sum(money_current) as sumCurrent'),
            'conditions' => array('user_id' => $this->Auth->user('id'))
        ));

        $this->set('sumMoneyCurrent', $sumMoneyWallet[0][0]['sumCurrent']);
        $this->set('wallets', $this->Paginator->paginate());
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        $this->loadModel('User');
        if ($this->request->is('post')) {
            $this->Wallet->create();
            $data = $this->request->data;
            $data['Wallet']['user_id'] = $this->Auth->user('id');
            if($this->Auth->user('role') === '0') {
                $this->request->data['Wallet']['user_id'] = $this->Auth->user('id');
            }
            
            if ($this->Wallet->save($data)) {
                $changable = $this->request->data['Wallet'];
                $this->Wallet->save(['money_current' => $changable["money_initialize"]]);
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The wallet could not be saved. Please, try again.'));
            }
        }
        $users = $this->Wallet->User->find('list');
        $this->set(compact('users'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Wallet->exists($id)) {
            throw new NotFoundException(__('Invalid wallet'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Wallet->save($this->request->data)) {
                $this->Flash->success(__('The wallet has been Updated.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The wallet could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Wallet.' . $this->Wallet->primaryKey => $id));
            $this->request->data = $this->Wallet->find('first', $options);
        }
        $users = $this->Wallet->User->find('list');
        $this->set(compact('users'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        
        $this->Wallet->id = $id;
        if (!$this->Wallet->exists()) {
            throw new NotFoundException(__('Invalid wallet'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Wallet->delete()) {
             $this->Flash->success(__('The wallet has been deleted.'));
        } else {
            $this->Flash->error(__('The wallet could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
    
    public function dashboard_user() {
        $this->loadModel('User');
        $this->loadModel('Wallet');
        $this->loadModel('Transaction');
        $this->loadModel('TransferWallet');
        
        $id_auth = $this->Auth->user('id');
        $wallet = $this->Wallet->getIdWallet($id_auth);
        foreach ($wallet as $walletId) {
            $walletAuth[] = $walletId['Wallet']['id'];
        }
        
        $countWallet = $this->Wallet->countWallets($id_auth); 
        $transaction = $this->Transaction->countTransaction($walletAuth);
        
        $transfer = $this->TransferWallet->countTransfer($walletAuth);
        
        $this->set('wallets', $countWallet[0][0]['count(*)']);
        $this->set('transactions', $transaction);
        $this->set('transfers', count($transfer));
    }

     public function isAuthorized($user) {
        // Admin can access every action
        if (isset($user['role']) && $user['role'] === '0' && $user['active'] === '1') {
            return true;
        }
        // Default deny
       return false;
    }

    public function isAuthorizedW($user) {
        // All registered users can add posts
        if ($this->action === 'add' || $this->action === 'index' || $this->action === 'dashboard_user') {
            return true;
        }

        // The owner of a post can edit and delete it
        if (in_array($this->action, array('edit', 'delete'))) {
            $postId = (int) $this->request->params['pass'][0];
            if ($this->Wallet->isOwnedBy($postId, $user['id'])) {
                return true;
            }
        }

        return isAuthorized($user);
    }
}
