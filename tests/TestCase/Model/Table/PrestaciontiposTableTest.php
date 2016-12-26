<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PrestaciontiposTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PrestaciontiposTable Test Case
 */
class PrestaciontiposTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PrestaciontiposTable
     */
    public $Prestaciontipos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.prestaciontipos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Prestaciontipos') ? [] : ['className' => 'App\Model\Table\PrestaciontiposTable'];
        $this->Prestaciontipos = TableRegistry::get('Prestaciontipos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Prestaciontipos);

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
