<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AsistentecomisionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AsistentecomisionsTable Test Case
 */
class AsistentecomisionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AsistentecomisionsTable
     */
    public $Asistentecomisions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.asistentecomisions',
        'app.comisions',
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
        'app.incidenciatipos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Asistentecomisions') ? [] : ['className' => 'App\Model\Table\AsistentecomisionsTable'];
        $this->Asistentecomisions = TableRegistry::get('Asistentecomisions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Asistentecomisions);

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
