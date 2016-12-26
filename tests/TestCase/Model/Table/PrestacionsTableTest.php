<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PrestacionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PrestacionsTable Test Case
 */
class PrestacionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PrestacionsTable
     */
    public $Prestacions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.prestacions',
        'app.prestaciontipos',
        'app.expedientes',
        'app.participantes',
        'app.relations',
        'app.roles',
        'app.tecnicos',
        'app.equipos',
        'app.users',
        'app.avisos',
        'app.incidencias',
        'app.incidenciatipos',
        'app.asistentecomisions',
        'app.comisions',
        'app.pasacomisions',
        'app.prestacionestados'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Prestacions') ? [] : ['className' => 'App\Model\Table\PrestacionsTable'];
        $this->Prestacions = TableRegistry::get('Prestacions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Prestacions);

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
