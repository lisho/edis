<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TecnicosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TecnicosTable Test Case
 */
class TecnicosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TecnicosTable
     */
    public $Tecnicos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.tecnicos',
        'app.equipos',
        'app.users',
        'app.avisos',
        'app.roles',
        'app.expedientes',
        'app.participantes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Tecnicos') ? [] : ['className' => 'App\Model\Table\TecnicosTable'];
        $this->Tecnicos = TableRegistry::get('Tecnicos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Tecnicos);

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
