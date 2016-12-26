<?php
namespace App\Test\TestCase\Controller;

use App\Controller\IncidenciasController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\IncidenciasController Test Case
 */
class IncidenciasControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.incidencias',
        'app.incidenciatipos',
        'app.users',
        'app.equipos',
        'app.tecnicos',
        'app.roles',
        'app.expedientes',
        'app.participantes',
        'app.relations',
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
