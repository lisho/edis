<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MigrausuariosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MigrausuariosTable Test Case
 */
class MigrausuariosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MigrausuariosTable
     */
    public $Migrausuarios;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.migrausuarios'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Migrausuarios') ? [] : ['className' => 'App\Model\Table\MigrausuariosTable'];
        $this->Migrausuarios = TableRegistry::get('Migrausuarios', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Migrausuarios);

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
