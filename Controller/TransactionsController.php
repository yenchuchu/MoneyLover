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
        
        $this->paginate = array(
            'conditions' => array('Wallet.id is not null',
                'Categorie.id is not null',
                'Transaction.wallet_id' => $result_wallet_id),
            'limit'=>20);

        $this->set('transactions', $this->Paginator->paginate());

        $categories = $this->Transaction->findListCategory();  
        $wallets = $this->Transaction->findIdWalletAuth($result_wallet_id); 
        $this->set(compact('categories', 'wallets'));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Transaction->create();
            $data = $this->request->data;

            if ($this->Transaction->save($data)) {
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
        if (!$this->Transaction->exists($id)) {
            throw new NotFoundException(__('Invalid transaction'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Transaction->save($this->request->data)) {
                $this->Flash->success(__('The transaction has been saved.'));
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
        $this->Transaction->id = $id;
        if (!$this->Transaction->exists()) {
            throw new NotFoundException(__('Invalid transaction'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Transaction->delete()) {
            $this->Flash->success(__('The transaction has been deleted.'));
        } else {
            $this->Flash->error(__('The transaction could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function deleteAll() {
        $this->request->allowMethod('post');

        $ids = $this->request->data['ids'];
        $this->Transaction->belongsTo = false;
        if ($this->Transaction->deleteAll(array('id' => $ids), true)) {
            echo json_encode(['status' => 0, 'message' => 'OK']);
            exit;
        }

        echo json_encode(['status' => 1, 'message' => 'Save not success']);
        exit;
    }

}
