<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TransferWalletsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TransferWalletsTable Test Case
 */
class TransferWalletsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TransferWalletsTable
     */
    public $TransferWallets;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.transfer_wallets',
        'app.sent_wallets',
        'app.receive_wallets'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TransferWallets') ? [] : ['className' => 'App\Model\Table\TransferWalletsTable'];
        $this->TransferWallets = TableRegistry::get('TransferWallets', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TransferWallets);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
