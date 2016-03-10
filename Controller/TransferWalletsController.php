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
        $this->TransferWallet->recursive = 0;

        $id_auth = $this->Auth->user('id');
        $wallet_selected_query = $this->TransferWallet->query(
                "select wallets.user_id, wallets.id from wallets 
            inner join users on users.id = wallets.user_id where users.id = '$id_auth'");

// $sent_wallet_query = $this->TransferWallet->query("select transfer_wallets.sent_wallet_id
//     from transfer_wallets inner join (select wallets.user_id, wallets.id from wallets 
//     inner join users on users.id = wallets.user_id where users.id = '$id_auth') 
//     as a1 on a1.id = transfer_wallets.sent_wallet_id");
// $receive_wallet_query = $this->TransferWallet->query("select transfer_wallets.receive_wallet_id 
//     from transfer_wallets inner join (select wallets.user_id, wallets.id from wallets 
//     inner join users on users.id = wallets.user_id where users.id = '$id_auth') 
// as a1 on a1.id = transfer_wallets.receive_wallet_id");

        $result_wallet_selected = Set::classicExtract($wallet_selected_query, '{n}.wallets.id');

// $result_sent = Set::classicExtract($sent_wallet_query, '{n}.transfer_wallets.sent_wallet_id');
// $result_recieve = Set::classicExtract($receive_wallet_query, '{n}.transfer_wallets.receive_wallet_id');

        $this->paginate = array(
            'conditions' => array(
                'TransferWallet.sent_wallet_id is not null',
                'TransferWallet.receive_wallet_id is not null',
                'TransferWallet.sent_wallet_id' => $result_wallet_selected,
                'TransferWallet.receive_wallet_id' => $result_wallet_selected));

        $this->set('transferWallets', $this->Paginator->paginate());

        $sentWallets = $this->TransferWallet->SentWallet->find('list', array(
            'conditions' => array('id' => $result_wallet_selected)));

        $receiveWallets = $this->TransferWallet->ReceiveWallet->find('list', array(
            'conditions' => array('id' => $result_wallet_selected)));

        $this->set(compact('sentWallets', 'receiveWallets'));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->TransferWallet->exists($id)) {
            throw new NotFoundException(__('Invalid transfer wallet'));
        }
        $options = array('conditions' => array('TransferWallet.' . $this->TransferWallet->primaryKey => $id));
        $this->set('transferWallet', $this->TransferWallet->find('first', $options));
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
        $sentWallets = $this->TransferWallet->SentWallet->find('list');
        $receiveWallets = $this->TransferWallet->ReceiveWallet->find('list');
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
        $sentWallets = $this->TransferWallet->SentWallet->find('list');
        $receiveWallets = $this->TransferWallet->ReceiveWallet->find('list');
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
