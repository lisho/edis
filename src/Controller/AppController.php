<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
      
        $this->loadComponent('Auth', [
                'authorize' => ['Controller'],
                'authenticate' => [
                    'Form' => [
                        'fields' => [
                            'username' => 'user',
                            'password' => 'password'
                            ]
                        ]
                    ],
                'loginAction' => [
                    'controller' => 'Users',
                    'action' => 'login'
                    ],
                'autrhError' => 'Debe introducir datos correctos...',
                'loginRedirect' => [
                    'controller' => 'Users',
                    'action' => 'home'
                    ],
                'logoutRedirect' => [
                    'controller' => 'Users',
                    'action' => 'login'
                    ],
                'authError' => '¿Crees que puedes entrar sin loguearte?',
            ]);

    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event)
    {
        $this->Auth->allow(['index', 'view', 'display']);
         
        $this->set('auth', $this->Auth->user()); //Con esta linea pasamos $auth a las vistas.
        $this->set('ultimos_avisos', $this->ultimosAvisos(5)); //Con esta linea pasamos $auth a las vistas.

        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
 
    }

    public function isAuthorized($user)
    {
        return true;
    }

    /**
    *
    * 
    * @return Devuelve los avisos y las noticias publicadas
    *       por el usuario logueado.
    **/

    public function ultimosAvisos($num)
    {
        $this->loadModel('Avisos');
        $ultimos_avisos = $this->Avisos->find('all')
                    -> contain('Users')
                    -> limit($num)
                    -> order('Avisos.created DESC')
                    -> where(['Avisos.tipo' => 'aviso']);

        return $ultimos_avisos;

        //debug(Avisos::mis_avisos());exit();
        //return $this->ultimosAvisos($num);
    }

    /**
     * Listado de los Equipos segun el tipo que pasamos
     *
     * 
     */
        public function listadoEquipo($tipo=null)
    {
        $this->loadModel('Equipos');
        $listado = [];
        $listado = $this->Equipos->findByTipo($tipo);
        foreach ($listado as $l) {
            //debug($l);exit();
            $listado_tipo[$l->id] = $l->nombre;
        }

        return $listado_tipo;
    }

    /**
     * Listado de todos los tecnicos
     *
     * 
     */
        public function listadoTecnicos($expediente_id=null)
    {
        $this->loadModel('Tecnicos');
        $listado = [];
    
            $listado = $this->Tecnicos->find('all');
            foreach ($listado as $l) {
                //debug($l);exit();
                $listado_tecnicos[$l->id] = $l->nombre.' '. $l->apellidos;
                }

        return $listado_tecnicos;
    }

    /**
     * Listado de las posibles relaciones entre los participantes
     *
     * 
     */
        public function listadoRelaciones($expediente_id=null)
    {
        $this->loadModel('Relations');
        $listado = [];
    
            $listado = $this->Relations->find('all');
            foreach ($listado as $l) {
                //debug($l);exit();
                $listado_relaciones[$l->id] = $l->nombre;
                }

        return $listado_relaciones;
    }

    /**
     * Calcular la EDAD
     *
     * Necesitamos pasar la fecha de nacimiento y nos devuelve un integral.
     */
        public function calcularEdad($nacimiento=null)
    {
        if ($nacimiento!=null) {
            $nac_format = $nacimiento->i18nFormat('yyyy-MM-dd');
            $fecha = time() - strtotime($nac_format);
            $edad = floor($fecha / 31556926);

            /*$dias = explode("/", $nacimiento, 3);
            $dias = mktime(0,0,0,$dias[1],$dias[0],$dias[2]);
            $edad = (int)((date('now')-$dias)/31556926 );*/
            return $edad;
        }        
    }   
}
