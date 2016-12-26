<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ExpedientesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ExpedientesTable Test Case
 */
class ExpedientesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ExpedientesTable
     */
    public $Expedientes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.expedientes',
        'app.participantes',
        'app.roles',
        'app.users',
        'app.equipos',
        'app.avisos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Expedientes') ? [] : ['className' => 'App\Model\Table\ExpedientesTable'];
        $this->Expedientes = TableRegistry::get('Expedientes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Expedientes);

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
