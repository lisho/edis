<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MigraactuacionesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MigraactuacionesTable Test Case
 */
class MigraactuacionesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MigraactuacionesTable
     */
    public $Migraactuaciones;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.migraactuaciones'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Migraactuaciones') ? [] : ['className' => 'App\Model\Table\MigraactuacionesTable'];
        $this->Migraactuaciones = TableRegistry::get('Migraactuaciones', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Migraactuaciones);

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
