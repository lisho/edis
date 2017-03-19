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
        
        $user = $this->Users->newEntity();
        
        // ****  Inicio Preparacion de foto **** //
        
            $filename = '';
            $ext = '';
                   
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
        // ****  FIN preparacion de FOTO *******//


            if ($this->request->data['photo']['tmp_name']!='') {
                $this->request->data['foto'] = $this->request->data['user'].$ext;
            }


            $user = $this->Users->patchEntity($user, $this->request->data);

                if ($this->Users->save($user)) {

                // ****  Añadimos el archivo a la carpeta *******//    
                    $filename=$this->request->data['photo'];

                //****** Redismensionamos las fotos *********** 

                    $this->redimensionarImagen($filename['tmp_name']);
                        
                //***********************************

//debug($filename);exit();
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
//debug($this->request->data['photo']);exit(); 
            if (!empty($this->request->data['photo']['tmp_name'])
                    && is_uploaded_file($this->request->data['photo']['tmp_name'])) 
                {
                    if ($old_foto != []){
                        $file = new File(IMAGES.'user_fotos/'.$old_foto);
                        $file->delete();
                        $file->close();
                    }

                    $filename=$this->request->data['photo'];

            //****** Redismensionamos las fotos *********** 

            $this->redimensionarImagen($filename['tmp_name']);
              
            //***********************************
                   
                    move_uploaded_file($filename['tmp_name'], IMAGES.'user_fotos/'. DS . $this->request->data['photo']['size'].$ext);
                    $this->request->data['foto'] = $this->request->data['photo']['size'].$ext;
                     
                }

            
            $user = $this->Users->patchEntity($user, $this->request->data);
                
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Los cambios se han guardado correctamente.'));
                return $this->redirect(['action'=>'view', $user->id]);
            } else {
                $this->Flash->error(__('No ha sido posible hacer los cambios. Por favor, inténtalo de nuevo.'));
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
            
            if ($user['foto']!='') {
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
        $mis_cambios = [];
        $lista_tedis = [
                36 => 2,
                53 => 5,
                54 => 6,
                55 => 3,
                56 => 8,
                57 => 7
        ];

        //debug( );exit();
        $this->loadModel('Comisions');

        // Datos de mis expedientes en las 4 últimas comisiones
       
        $user = $lista_tedis[$this->Auth->user()['id']];

        $mis_ultimas_comisiones = $this->Comisions -> find()
                                                        //->contain ('Pasacomisions.Expedientes.Roles')
                                                        -> order(['fecha' => 'DESC'])
                                                        -> limit(4)
                                                        //-> where(['Pasacomisions.Expedientes.Roles.tecnico_id' => $user])
                                                        -> contain([
                                                                'Pasacomisions.Expedientes.Roles'=> function ($q) use ($user){
                                                                    return $q -> where(['tecnico_id' => $user]);
                                                                },
                                                                'Pasacomisions.Expedientes.Prestacions.Participantes'=> function ($q) {
                                                                    return $q -> where(['Prestacions.prestacionestado_id' => 5]);
                                                                }
                                                            ]);
                                                        
        

        $compara_nominas = $this->llamaComparaNominas();

        // Iteramos los ****** CAMBIOS DE DOMICILIO ******
        foreach ($compara_nominas['cambios']['domicilio'] as $rgc => $cambio) {
            
            // Revisamos si existen roles asignados es este expediente
            if (isset($cambio['datos_bd']['rol'])) {
                // Iteramos los roles buscando aquellos en los que coincida con el logueado.
                foreach ($cambio['datos_bd']['rol'] as $rol) {
                    
                    // Si aparece el rol del usuario logueado
                    if ($rol['tecnico']['id'] == $user) {
                        $mis_cambios['domicilio'][$rgc] = $cambio;
                    }
                }
            }
        }

        // Iteramos los ****** NUEVOS EXPEDIENTES ******
        foreach ($compara_nominas['cambios']['nuevo_expediente'] as $rgc => $cambio) {
            
            // Revisamos si existen roles asignados es este expediente
            if (isset($cambio['datos_bd']['rol'])) {
                // Iteramos los roles buscando aquellos en los que coincida con el logueado.
                foreach ($cambio['datos_bd']['rol'] as $rol) {
                    
                    // Si aparece el rol del usuario logueado
                    if ($rol['tecnico']['id'] == $user) {
                        $mis_cambios['nuevo_expediente'][$rgc] = $cambio;
                    }
                }
            }
        }

        // Iteramos los ****** MIS BAJAS EN NOMINA ******
        foreach ($compara_nominas['cambios']['bajas_nomina'] as $rgc => $cambio) {
            
            // Revisamos si existen roles asignados es este expediente
            if (isset($cambio['datos_bd']['rol'])) {
                // Iteramos los roles buscando aquellos en los que coincida con el logueado.
                foreach ($cambio['datos_bd']['rol'] as $rol) {
                    
                    // Si aparece el rol del usuario logueado
                    if ($rol['tecnico']['id'] == $user) {
                        $mis_cambios['bajas_nomina'][$rgc] = $cambio;
                    }
                }
            }
        }

        //debug($compara_nominas);exit();
        //debug($mis_cambios);exit();
        $ultima_nomina = $compara_nominas['ultima_nomina'];
        $penultima_nomina = $compara_nominas['penultima_nomina'];

        $this->set(compact('mis_ultimas_comisiones', 'mis_cambios','ultima_nomina', 'penultima_nomina'));
        //$this->set('_serialize', ['mis_ultimas_comisiones']);                                                       
        //$this->render();
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

}
