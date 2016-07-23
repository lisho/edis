<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AvisosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AvisosTable Test Case
 */
class AvisosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AvisosTable
     */
    public $Avisos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.avisos',
        'app.users',
        'app.equipos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Avisos') ? [] : ['className' => 'App\Model\Table\AvisosTable'];
        $this->Avisos = TableRegistry::get('Avisos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Avisos);

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
