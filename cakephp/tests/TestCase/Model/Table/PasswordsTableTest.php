<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PasswordsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PasswordsTable Test Case
 */
class PasswordsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PasswordsTable
     */
    public $Passwords;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.passwords',
        'app.users',
        'app.did_at'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Passwords') ? [] : ['className' => PasswordsTable::class];
        $this->Passwords = TableRegistry::get('Passwords', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Passwords);

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
