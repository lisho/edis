<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MigraexpedientesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MigraexpedientesTable Test Case
 */
class MigraexpedientesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MigraexpedientesTable
     */
    public $Migraexpedientes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.migraexpedientes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Migraexpedientes') ? [] : ['className' => 'App\Model\Table\MigraexpedientesTable'];
        $this->Migraexpedientes = TableRegistry::get('Migraexpedientes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Migraexpedientes);

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
