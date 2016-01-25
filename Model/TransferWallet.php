<?php
App::uses('AppModel', 'Model');
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
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
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
	public $belongsTo = array(
		'SentWallet' => array(
			'className' => 'SentWallet',
			'foreignKey' => 'sent_wallet_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ReceiveWallet' => array(
			'className' => 'ReceiveWallet',
			'foreignKey' => 'receive_wallet_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}