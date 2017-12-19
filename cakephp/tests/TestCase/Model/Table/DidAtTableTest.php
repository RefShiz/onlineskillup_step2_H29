<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DidAtTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DidAtTable Test Case
 */
class DidAtTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DidAtTable
     */
    public $DidAt;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.did_at',
        'app.users',
        'app.passwords'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('DidAt') ? [] : ['className' => DidAtTable::class];
        $this->DidAt = TableRegistry::get('DidAt', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DidAt);

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
