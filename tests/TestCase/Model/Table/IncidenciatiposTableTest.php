<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\IncidenciatiposTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\IncidenciatiposTable Test Case
 */
class IncidenciatiposTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\IncidenciatiposTable
     */
    public $Incidenciatipos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.incidenciatipos',
        'app.incidencias',
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
        $config = TableRegistry::exists('Incidenciatipos') ? [] : ['className' => 'App\Model\Table\IncidenciatiposTable'];
        $this->Incidenciatipos = TableRegistry::get('Incidenciatipos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Incidenciatipos);

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
