<?php

App::uses('AppController', 'Controller');
App::uses('CakeNumber', 'Utility');

/**
 * TransferWallets Controller
 *
 * @property TransferWallet $TransferWallet
 * @property PaginatorComponent $Paginator
 */
class TransferWalletsController extends AppController {

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
        
        $this->TransferWallet->recursive = 0;

        $id_auth = $this->Auth->user('id');
        $findWallet = $this->User->findWalletAuth($id_auth); 

        $result_wallet_selected = Set::classicExtract($findWallet, '{n}.wallets.id');

        $this->paginate = array(
            'conditions' => array(
                'TransferWallet.sent_wallet_id is not null',
                'TransferWallet.receive_wallet_id is not null',
                'TransferWallet.sent_wallet_id' => $result_wallet_selected,
                'TransferWallet.receive_wallet_id' => $result_wallet_selected),
            'limit'=>20);

        $this->set('transferWallets', $this->Paginator->paginate());

        $sentWallets = $this->TransferWallet->getListWalletSent($result_wallet_selected);
        $receiveWallets = $this->TransferWallet->getListWalletReceive($result_wallet_selected);

        $this->set(compact('sentWallets', 'receiveWallets'));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->TransferWallet->create();

            if ($this->TransferWallet->save($this->request->data)) {
                $this->Flash->success(__('The transfer wallet has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The transfer wallet could not be saved. Please, try again.'));
            }
        }
        $sentWallets = $this->TransferWallet->findListWalletSent();
        $receiveWallets = $this->TransferWallet->findListWalletReceive();
        $this->set(compact('sentWallets', 'receiveWallets'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->TransferWallet->exists($id)) {
            throw new NotFoundException(__('Invalid transfer wallet'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->TransferWallet->save($this->request->data)) {
                $this->Flash->success(__('The transfer wallet has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The transfer wallet could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('id' => $id), 'recursive' => 0);
            $this->request->data = $this->TransferWallet->find('first', $options);
        }
        $sentWallets = $this->TransferWallet->findListWalletSent();
        $receiveWallets = $this->TransferWallet->findListWalletReceive();
        $this->set(compact('sentWallets', 'receiveWallets'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->TransferWallet->hasAndBelongsToMany = array();
        $this->TransferWallet->id = $id;

        if (!$this->TransferWallet->exists($id)) {
            throw new NotFoundException(__('Invalid transfer wallet'));
        }

        $this->request->allowMethod('post', 'delete');
        if ($this->TransferWallet->delete($id, false)) {
            $this->Flash->success(__('The transfer wallet has been deleted.'));
        } else {
            $this->Flash->error(__('The transfer wallet could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function deleteAll() {
        $this->request->allowMethod('post');
        $this->TransferWallet->hasAndBelongsToMany = false;
        $ids = $this->request->data['ids'];
        if ($this->TransferWallet->deleteAll(array('id' => $ids), false)) {
            echo json_encode(['status' => 0, 'message' => 'OK']);
            exit;
        }

        echo json_encode(['status' => 1, 'message' => 'Save not success']);
        exit;
    }

}
