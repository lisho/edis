<?php
namespace App\Test\TestCase\Controller;

use App\Controller\PrestacionsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\PrestacionsController Test Case
 */
class PrestacionsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.prestacions',
        'app.tipoprestacions',
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
        'app.pasacomisions',
        'app.estadoprestacions'
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
