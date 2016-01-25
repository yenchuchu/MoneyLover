<?php
/**
 * TransferWallet Fixture
 */
class TransferWalletFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => false, 'key' => 'primary'),
		'transfer_money' => array('type' => 'float', 'null' => false, 'default' => '0', 'unsigned' => false),
		'transfer_date' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'sent_wallet_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => false, 'key' => 'index'),
		'receive_wallet_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => false, 'key' => 'index'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'sent_wallet_id' => array('column' => 'sent_wallet_id', 'unique' => 0),
			'receive_wallet_id' => array('column' => 'receive_wallet_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'transfer_money' => 1,
			'transfer_date' => '2016-01-25 15:19:38',
			'sent_wallet_id' => 1,
			'receive_wallet_id' => 1,
			'created' => '2016-01-25 15:19:38',
			'modified' => '2016-01-25 15:19:38'
		),
	);

}
