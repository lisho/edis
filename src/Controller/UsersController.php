<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Equipos']
        ];
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
         
    }


    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Equipos']
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);

       
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $filename = '';
        $ext = '';
        $user = $this->Users->newEntity();
        //debug($this->request->data);exit();
        
        if ($this->request->is('post')) {
            
            switch ($this->request->data['photo']['type']) {
                case 'image/jpeg':
                    $ext = '.jpg';
                    break;
                case 'image/png':
                    $ext = '.png';
                    break;           
                default:
                    # code...
                    break;
            }

            if ($this->request->data['photo']['tmp_name']!='') {
                $this->request->data['foto'] = $this->request->data['user'].$ext;
            }

            $user = $this->Users->patchEntity($user, $this->request->data);

                if ($this->Users->save($user)) {

                    
                    $filename=$this->request->data['photo'];
                    move_uploaded_file($filename['tmp_name'], IMAGES.'user_fotos/'. DS . $user['user'].$ext);
                    
/*
                    if (!empty($this->request->data['photo']['tmp_name'])
                    && is_uploaded_file($this->request->data['photo']['tmp_name'])) 
                    {
        
                    $filename=basename($this->request->data['user']);
        
                    move_uploaded_file($this->request->data['photo']['tmp_name'],IMAGES.'user_fotos/'.$this->request->data['user'].'.jpg');
                    } 
*/
                    $this->Flash->success(__('Se ha añadido un nuevo usuario.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('No se ha guardado el nuevo usuario. Por favor, inténtelo le nuevo.'));
                }
                
        }

        $equipos = $this->Users->Equipos->find('list', ['limit' => 200, 'order' => 'Equipos.nombre ASC']);
                
        $this->set(compact('user', 'equipos'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {

        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $old_foto=$user['foto'];
        //debug($fotos);exit();

        if ($this->request->is(['patch', 'post', 'put'])) {

            switch ($this->request->data['photo']['type']) {
                case 'image/jpeg':
                    $ext = '.jpg';
                    break;
                case 'image/png':
                    $ext = '.png';
                    break;           
                default:
                    # code...
                    break;
            }

            $this->request->data['foto'] = $this->request->data['user'].$ext;

            $user = $this->Users->patchEntity($user, $this->request->data);

            if (!empty($this->request->data['photo']['tmp_name'])
                    && is_uploaded_file($this->request->data['photo']['tmp_name'])) 
                {
                    if ($old_foto != []){
                        $file = new File(IMAGES.'user_fotos/'.$old_foto);
                        $file->delete();
                        $file->close();
                    }
                   

                    $filename=$this->request->data['photo'];
                    move_uploaded_file($filename['tmp_name'], IMAGES.'user_fotos/'. DS . $user['user'].$ext);

                } 

                
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $equipos = $this->Users->Equipos->find('list', ['limit' => 200, 'order' => 'nombre DESC']);
        
        $this->set(compact('user', 'equipos'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        
        if ($this->Users->delete($user)) {
            
            if ($user['fotos']!='') {
                $file = new File(IMAGES.'user_fotos/'.$user['foto']);
                $file->delete();
                $file->close();
            } 

            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function login()
    {
        if ($this->request->is('post')) {
            //debug($_POST);exit();
            $user = $this->Auth->identify();
            
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->error('Los datos no son correctos. Inténtalo de nuevo...', ['key'=>'auth']);
            }
        }
    }

    public function home()
    {
        $this->render();
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }


}
