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

    /*
    public function buscar_avatar($id=null)
    {        
        $this->loadModel('Users');     

        if ($id!=null) {
            $foto=[];
            $user = $this->Users->get($id);
            
            $dir = new Folder(WWW_ROOT . 'img/user_fotos');
            $f=$user['user'].'.jpg';
            $g=$user['user'].'.png';
            //$foto = $dir->find($f);
            if ($dir->find($f)) {
                $foto = $dir->find($f);
            } elseif ($dir->find($g)) {
                $foto = $dir->find($g);
            } 
            
        } else {
            $dir = new Folder(WWW_ROOT . 'img/user_fotos');
            //$f=$user['user'].'.jpg';
            //$g=$user['user'].'.png';
            //$foto = $dir->find($f);
            $foto = $dir->find();
        }
        
        //$this->set('foto',$foto);  
        return $foto;
    } */
}
