<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PasacomisionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PasacomisionsTable Test Case
 */
class PasacomisionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PasacomisionsTable
     */
    public $Pasacomisions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.pasacomisions',
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
        'app.comisions',
        'app.asistentecomisions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Pasacomisions') ? [] : ['className' => 'App\Model\Table\PasacomisionsTable'];
        $this->Pasacomisions = TableRegistry::get('Pasacomisions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Pasacomisions);

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
