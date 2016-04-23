<?php

App::uses('AppModel', 'Model');
App::import('Model', 'Wallet');
App::import('Model', 'User');

/**
 * TransferWallet Model
 *
 * @property SentWallet $SentWallet
 * @property ReceiveWallet $ReceiveWallet
 */
class TransferWallet extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'transfer_money' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Your must enter money',
                //'allowEmpty' => false,
                'required' => true,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'transfer_date' => array(
            'datetime' => array(
                'rule' => array('datetime'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'sent_wallet_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'receive_wallet_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );

    // The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $hasAndBelongsToMany = array(
        'SentWallet' =>
        array(
            'className' => 'Wallet',
            'foreignKey' => 'sent_wallet_id',
            'unique' => true,
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'ReceiveWallet' =>
        array(
            'className' => 'Wallet',
            'foreignKey' => 'receive_wallet_id',
            'unique' => true,
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
    
    public function getListWalletSent($walletId) {
        $sentWallets = $this->SentWallet->find('list', array(
            'conditions' => array('id' => $walletId)));
        return $sentWallets;
    }
    
    public function getListWalletReceive($walletId) {
        $receiveWallets = $this->ReceiveWallet->find('list', array(
            'conditions' => array('id' => $walletId)));
        return $receiveWallets;
    }
    
     public function findListWalletSent() {
        $listWalletSent =  $this->SentWallet->find('list');
//                , array( 'conditions'=>array( 'Wallet.id' => $authId)) );
        return $listWalletSent;
    }
    
     public function findListWalletReceive() {
        $listWalletReceive =  $this->ReceiveWallet->find('list');
        return $listWalletReceive;
    }
    
    public function getWalletRecieveSent($walletIdSent) {
        $result_sent = $walletModel->find('first', array(
                        'conditions' => array(
                                'Wallet.id' => $walletIdSent)));
        return $result_sent;
    }
 
    public function getWalletRecieve($walletIdRecieve) {
        $result_recieve = $walletModel->find('first', array(
                        'conditions' => array(
                                'Wallet.id' => $walletIdRecieve)));
        return $result_recieve;
    }
    
    public function getIdWalletSentByIdTransfer($idTransfer) {
        $id_wallet_sent = $this->find('first', array(
            'fields'=> 'sent_wallet_id',
            'conditions'=> array(
                'id' => $idTransfer
            )
        ));
        
        return $id_wallet_sent; 
    }
    
     public function getIdWalletRecieveByIdTransfer($idTransfer) {
        $id_wallet_receive = $this->find('first', array(
            'fields'=> 'receive_wallet_id',
            'conditions'=> array(
                'id' => $idTransfer
            )
        ));
        
        return $id_wallet_receive; 
    }
    
    public function getTransferWalletById($transferWalletId) {
         $return_transfer = $this->query(" select * from transfer_wallets where id = $transferWalletId");
         return $return_transfer;
    } 
    
     public function isOwnedBy($post, $user) {
        return $this->field('id', array('id' => $post, 'user_id' => $user)) !== false;
    }
}
