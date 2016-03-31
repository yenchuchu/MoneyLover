<?php

App::uses('AppModel', 'Model');
App::uses('Transaction', 'Model');

/**
 * Wallet Model
 *
 * @property User $User
 * @property Transaction $Transaction
 */
class Wallet extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'user_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'name' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'money_current' => array(
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
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'Transaction' => array(
            'className' => 'Transaction',
            'foreignKey' => 'wallet_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );
    
    public function getAllWallets($walletId) {
        $allWallets = $this->find('all', array('condition'=>array('id'=>$walletId)));
        return $allWallets;
    }
    
    public function getMoneyCurrent($walletId) {
        $moneyCurrent = $this->query("select money_current from wallets where id = $walletId");
        return $moneyCurrent;
    }
    
     public function isOwnedBy($post, $user) {
        return $this->field('id', array('id' => $post, 'user' => $user)) !== false;
    }
}
