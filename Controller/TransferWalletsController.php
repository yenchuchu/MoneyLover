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
        $this->loadModel('Wallet');

        $this->TransferWallet->recursive = 0;
        $id_auth = $this->Auth->user('id');
        $findWallet = $this->User->findWalletAuth($id_auth);

        $result_wallet_selected = Set::classicExtract($findWallet, '{n}.wallets.id');

        $sentWalletId = $this->request->query('sent_wallet_id');
        $recieveWalletId = $this->request->query('receive_wallet_id');
        $money = $this->request->query('transfer_money');

        $day = $this->request->query('day_start');
        $month = $this->request->query('month_start');
        $year = $this->request->query('year_start');

        $conditions = array('TransferWallet.sent_wallet_id is not null',
            'TransferWallet.receive_wallet_id is not null'
        ); 
        if (!empty($sentWalletId)) {
            $conditions['TransferWallet.sent_wallet_id'] = $sentWalletId;
        } else {
            $conditions['TransferWallet.sent_wallet_id'] = $result_wallet_selected;
        }

        if (!empty($recieveWalletId)) {
            $conditions['TransferWallet.receive_wallet_id'] = $recieveWalletId;
        } else {
            $conditions['TransferWallet.receive_wallet_id'] = $result_wallet_selected;
        }

        if (!empty($money)) {
            if ($money >= 500001) {
                $conditions[] = 'TransferWallet.transfer_money >' . $money;
            } else {
                $conditions[] = 'TransferWallet.transfer_money <=' . $money;
            }
        }
        if (!empty($day)) {
            $conditions['day(TransferWallet.created)'] = $day;
        } else {
            $conditions[] = 'day(TransferWallet.created) is not null';
        }
        if (!empty($month)) {
            $conditions['month(TransferWallet.created)'] = $month;
        }

        if (!empty($year)) {
            $conditions['YEAR(TransferWallet.created)'] = $year;
        }
        
        $countTransfer = count($this->TransferWallet->find('all',array('conditions'=>$conditions)));
 
        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => 20);
        
        $sentWallets = $this->TransferWallet->getListWalletSent($result_wallet_selected);
        $receiveWallets = $this->TransferWallet->getListWalletReceive($result_wallet_selected);

        $this->set('transferWallets', $this->Paginator->paginate());
        $this->set('countTransfer', $countTransfer);
        $this->set(compact('sentWallets', 'receiveWallets'));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        $this->loadModel('Wallet');
        $this->loadModel('User');
        $this->loadModel('Transaction');

        $auth_id = $this->Auth->user('id');
        if ($this->request->is('post')) {

            $this->TransferWallet->create();
            $moneyEdit = $this->data['TransferWallet']['transfer_money'];
            $idWalletSentEdit = $this->data['TransferWallet']['sent_wallet_id'];
            $idWalletRecieveEdit = $this->data['TransferWallet']['receive_wallet_id'];

            $walletSentEdit = $this->Transaction->getWalletById($idWalletSentEdit);
            $walletRecieveEdit = $this->Transaction->getWalletById($idWalletRecieveEdit);
            
            if($this->Auth->user('role') === '0') {
                $this->request->data['TransferWallet']['user_id'] = $this->Auth->user('id');
            }
              
//            if($walletSentEdit[0]['Wallet']['money_initialize'] >= $moneyEdit) {
                if ($this->TransferWallet->save($this->request->data)) {
                $walletSentEdit[0]['Wallet']['money_current'] -= $moneyEdit;
                $walletRecieveEdit[0]['Wallet']['money_current'] += $moneyEdit;

                $this->Wallet->updateAll(array(
                    'Wallet.money_current' => $walletSentEdit[0]['Wallet']['money_current']), array(
                    'Wallet.id' => $idWalletSentEdit));

                $this->Wallet->updateAll(array(
                    'Wallet.money_current' => $walletRecieveEdit[0]['Wallet']['money_current']), array(
                    'Wallet.id' => $idWalletRecieveEdit));

                $this->Flash->success(__('The transfer wallet has been saved.'));
                return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Flash->error(__('The transfer wallet could not be saved. Please, try again.'));
                }
//            } else {
//                $this->Flash->error(__('money of wallet dont enought to complete transfer'));
//                return $this->redirect(array('action' => 'index'));
//            }
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
        $this->loadModel('Wallet');
        $this->loadModel('User');
        $this->loadModel('Transaction');
        $auth_id = $this->Auth->user('id');

        if (!$this->TransferWallet->exists($id)) {
            throw new NotFoundException(__('Invalid transfer wallet'));
        }


        if ($this->request->is(array('post', 'put'))) {
            // transfer wallet before:
            $beforeTransferWallet = $this->TransferWallet->getTransferWalletById($id);

            $moneyTransferBefore = $beforeTransferWallet[0]['transfer_wallets']['transfer_money'];

            $idWalletSentBefore = $beforeTransferWallet[0]['transfer_wallets']['sent_wallet_id'];
            $idWalletRecieveBefore = $beforeTransferWallet[0]['transfer_wallets']['receive_wallet_id'];

            // get wallet info sent
            $walletSentBefore = $this->Transaction->getWalletById($idWalletSentBefore)[0]['Wallet'];

            // get wallet info sent
            $walletRecieveBefore = $this->Transaction->getWalletById($idWalletRecieveBefore)[0]['Wallet'];

            // get money current before 
            $moneyCurrentWalletSentBefore = $this->Wallet->getMoneyCurrent($walletSentBefore['id'])[0]['wallets']['money_current'];
            $moneyCurrentWalletRecieveBefore = $this->Wallet->getMoneyCurrent($walletRecieveBefore['id'])[0]['wallets']['money_current'];


            $moneyTransferEdit = $this->data['TransferWallet']['transfer_money'];
            $idWalletSentEdit = $this->data['TransferWallet']['sent_wallet_id'];
            $idWalletRecieveEdit = $this->data['TransferWallet']['receive_wallet_id'];

            if ($this->TransferWallet->save($this->request->data)) {
                $walletSentBefore['money_current'] += $moneyTransferBefore;
                $walletRecieveBefore['money_current'] -= $moneyTransferBefore;

                $this->Wallet->updateAll(array(
                    'Wallet.money_current' => $walletSentBefore['money_current']), array(
                    'Wallet.id' => $idWalletSentBefore));

                $this->Wallet->updateAll(array(
                    'Wallet.money_current' => $walletRecieveBefore['money_current']), array(
                    'Wallet.id' => $idWalletRecieveBefore));

                //        transfer wallet edit
                $walletSentEdit = $this->Transaction->getWalletById($idWalletSentEdit);
                $walletRecieveEdit = $this->Transaction->getWalletById($idWalletRecieveEdit);

                $walletSentEdit[0]['Wallet']['money_current'] -= $moneyTransferEdit;
                $walletRecieveEdit[0]['Wallet']['money_current'] += $moneyTransferEdit;

                $this->Wallet->updateAll(array(
                    'Wallet.money_current' => $walletSentEdit[0]['Wallet']['money_current']), array(
                    'Wallet.id' => $idWalletSentEdit));

                $this->Wallet->updateAll(array(
                    'Wallet.money_current' => $walletRecieveEdit[0]['Wallet']['money_current']), array(
                    'Wallet.id' => $idWalletRecieveEdit));

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
        $this->loadModel('Wallet');
        $this->loadModel('Transaction');

        $this->TransferWallet->hasAndBelongsToMany = array();
        $this->TransferWallet->id = $id;

        if (!$this->TransferWallet->exists($id)) {
            throw new NotFoundException(__('Invalid transfer wallet'));
        }

        $transferDelete = $this->TransferWallet->getTransferWalletById($id);

        $moneyTransfer = $transferDelete[0]['transfer_wallets']['transfer_money'];
        $idWalletSent = $transferDelete[0]['transfer_wallets']['sent_wallet_id'];
        $idWalletRecieve = $transferDelete[0]['transfer_wallets']['receive_wallet_id'];

        // get wallet info sent
        $walletSent = $this->Transaction->getWalletById($idWalletSent)[0]['Wallet'];
        // get wallet info sent
        $walletRecieve = $this->Transaction->getWalletById($idWalletRecieve)[0]['Wallet'];

        $walletSent['money_current'] += $moneyTransfer;
        $walletRecieve['money_current'] -= $moneyTransfer;

        $this->request->allowMethod('post', 'delete');
        if ($this->TransferWallet->delete($id, false)) {
            $this->Wallet->updateAll(array(
                'Wallet.money_current' => $walletSent['money_current']), array(
                'Wallet.id' => $idWalletSent));

            $this->Wallet->updateAll(array(
                'Wallet.money_current' => $walletRecieve['money_current']), array(
                'Wallet.id' => $idWalletRecieve));
        } else {
            $this->Flash->error(__('The transfer wallet could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function deleteAll() {
        $this->loadModel('Wallet');
        $this->loadModel('Transaction');

        $this->request->allowMethod('post');
        $this->TransferWallet->hasAndBelongsToMany = false;
        $ids = $this->request->data['ids'];

        $transferDelete = array();
        foreach ($ids as $id) {
            $transferDelete = $this->TransferWallet->getTransferWalletById($id);

            $moneyTransfer = $transferDelete[0]['transfer_wallets']['transfer_money'];
            $idWalletSent = $transferDelete[0]['transfer_wallets']['sent_wallet_id'];
            $idWalletRecieve = $transferDelete[0]['transfer_wallets']['receive_wallet_id'];

            // get wallet info sent
            $walletSent = $this->Transaction->getWalletById($idWalletSent)[0]['Wallet'];
            // get wallet info sent
            $walletRecieve = $this->Transaction->getWalletById($idWalletRecieve)[0]['Wallet'];

            $walletSent['money_current'] += $moneyTransfer;
            $walletRecieve['money_current'] -= $moneyTransfer;
            
            $this->Wallet->updateAll(array(
                'Wallet.money_current' => '"' . $walletSent['money_current'] . '"'), array(
                'Wallet.id' => $idWalletSent));

            $this->Wallet->updateAll(array(
                'Wallet.money_current' => '"' . $walletRecieve['money_current'] . '"'), array(
                'Wallet.id' => $idWalletRecieve));
        }
        if ($this->TransferWallet->deleteAll(array('id' => $ids), false)) {
            
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

    public function isAuthorizedTransferWallet($user) {
        // All registered users can add posts
        if ($this->action === 'add') {
            return true;
        }

        // The owner of a post can edit and delete it
        if (in_array($this->action, array('edit', 'delete'))) {
            $postId = (int) $this->request->params['pass'][0];
            if ($this->TransferWallet->isOwnedBy($postId, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }
}
