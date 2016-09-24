<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ComisionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ComisionsTable Test Case
 */
class ComisionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ComisionsTable
     */
    public $Comisions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.comisions',
        'app.asistentecomisions',
        'app.pasacomisions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Comisions') ? [] : ['className' => 'App\Model\Table\ComisionsTable'];
        $this->Comisions = TableRegistry::get('Comisions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Comisions);

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
}
