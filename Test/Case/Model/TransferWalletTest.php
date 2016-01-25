<?php
App::uses('TransferWallet', 'Model');

/**
 * TransferWallet Test Case
 */
class TransferWalletTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.transfer_wallet',
		'app.sent_wallet',
		'app.receive_wallet'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->TransferWallet = ClassRegistry::init('TransferWallet');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->TransferWallet);

		parent::tearDown();
	}

}
