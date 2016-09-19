<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\IncidenciasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\IncidenciasTable Test Case
 */
class IncidenciasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\IncidenciasTable
     */
    public $Incidencias;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.incidencias',
        'app.incidenciatipos',
        'app.users',
        'app.equipos',
        'app.tecnicos',
        'app.roles',
        'app.expedientes',
        'app.participantes',
        'app.relations',
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
        $config = TableRegistry::exists('Incidencias') ? [] : ['className' => 'App\Model\Table\IncidenciasTable'];
        $this->Incidencias = TableRegistry::get('Incidencias', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Incidencias);

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
