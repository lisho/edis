<?php
namespace App\Test\TestCase\Controller;

use App\Controller\InformesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\InformesController Test Case
 */
class InformesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.informes',
        'app.users',
        'app.equipos',
        'app.tecnicos',
        'app.roles',
        'app.expedientes',
        'app.participantes',
        'app.relations',
        'app.prestacions',
        'app.prestaciontipos',
        'app.prestacionestados',
        'app.incidencias',
        'app.incidenciatipos',
        'app.pasacomisions',
        'app.comisions',
        'app.asistentecomisions',
        'app.avisos'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
