<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PrestacionestadosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PrestacionestadosTable Test Case
 */
class PrestacionestadosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PrestacionestadosTable
     */
    public $Prestacionestados;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.prestacionestados',
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
        'app.pasacomisions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Prestacionestados') ? [] : ['className' => 'App\Model\Table\PrestacionestadosTable'];
        $this->Prestacionestados = TableRegistry::get('Prestacionestados', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Prestacionestados);

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
