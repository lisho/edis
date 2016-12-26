<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NominasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NominasTable Test Case
 */
class NominasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\NominasTable
     */
    public $Nominas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.nominas'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Nominas') ? [] : ['className' => 'App\Model\Table\NominasTable'];
        $this->Nominas = TableRegistry::get('Nominas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Nominas);

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
