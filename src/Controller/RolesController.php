<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Roles Controller
 *
 * @property \App\Model\Table\RolesTable $Roles
 */
class RolesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Expedientes', 'Tecnicos']
        ];
        $roles = $this->paginate($this->Roles);

        $this->set(compact('roles'));
        $this->set('_serialize', ['roles']);
    }

    /**
     * View method
     *
     * @param string|null $id Role id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $role = $this->Roles->get($id, [
            'contain' => ['Expedientes', 'Tecnicos']
        ]);

        $this->set('role', $role);
        $this->set('_serialize', ['role']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($exp = null)
    {
        $role = $this->Roles->newEntity();
        if ($this->request->is('post')) {
            $role = $this->Roles->patchEntity($role, $this->request->data);
            if ($this->Roles->save($role)) {
                $this->Flash->success(__('The role has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The role could not be saved. Please, try again.'));
            }
        }
        $expedientes = $this->Roles->Expedientes->find('list', ['limit' => 200]);
        $tecnicos = $this->Roles->Tecnicos->find('list', ['limit' => 200]);
        $this->set(compact('role', 'expedientes', 'tecnicos', 'exp'));
        $this->set('_serialize', ['role']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Role id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $role = $this->Roles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $role = $this->Roles->patchEntity($role, $this->request->data);
            if ($this->Roles->save($role)) {
                $this->Flash->success(__('The role has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The role could not be saved. Please, try again.'));
            }
        }
        $expedientes = $this->Roles->Expedientes->find('list', ['limit' => 200]);
        $tecnicos = $this->Roles->Tecnicos->find('list', ['limit' => 200]);
        $this->set(compact('role', 'expedientes', 'tecnicos'));
        $this->set('_serialize', ['role']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Role id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        
//debug($this->request);exit();
       // $this->request->allowMethod(['post','put', 'delete']);
        $role = $this->Roles->get($id);
        if ($this->Roles->delete($role)) {
            $this->Flash->success(__('The role has been deleted.'));
        } else {
            $this->Flash->error(__('The role could not be deleted. Please, try again.'));
        }
        $this->redirect($this->referer());
        //return $this->redirect(['action' => 'index']);
    }

    /**
     * Mis Expedientes method
     *
     * @return \Cake\Network\Response|null
     */
    public function misRoles()
    {
        $auth=$this->Auth->user(); // lo pasamos a minúsculas
        $nombre_user = strtolower($auth['nombre']);
        $apellidos_user = strtolower($auth['apellidos']);
        $mis_pestaciones = [];
        
        $expedientes = $this->Roles->find('all')
            -> where(['Tecnicos.nombre'=>ucwords($nombre_user),'Tecnicos.apellidos'=>ucwords($apellidos_user)])
            -> contain ([
                                            'Expedientes',
                                            //'Tecnicos',
                                            'Tecnicos.Equipos',
                                            'Expedientes.Participantes.Relations',
                                            'Expedientes.Prestacions'
                                            //'Participantes.Relations'
                                    ])
            ;
        $nomina = $this->ultima(); 

        foreach ($nomina as $n) {
             $dni_en_nomina[]= $n->dni;
             //$rgc_en_nomina[]= $n->RGC;
             $hs_en_nomina[]= $n->HS;
         } 
//debug($expedientes->toArray());exit();
         foreach ($expedientes as $exp) {
            foreach ($exp->expediente->prestacions as $pres) {

                if ($pres->prestacionestado_id != 6) {
                    
                    switch ($pres->prestaciontipo_id){
                        case 3:
                            $mis_pestaciones[$exp->expediente->id]['RGC'][]= $pres;
                            break;
                        case 2:
                            $mis_pestaciones[$exp->expediente->id]['AUS'][]= $pres;
                            break;
                        case 4:
                            $mis_pestaciones[$exp->expediente->id]['ATFIS'][]= $pres;
                            break;
                        default:
                            
                            break;
                    } 
                }          
            }            
         }
//debug($mis_pestaciones);exit();         
        $listado_ceas = $this->listadoEquipo('ceas');

        $this->set(compact('expedientes','listado_ceas','dni_en_nomina', 'hs_en_nomina','mis_pestaciones'));
        //$this->set('_serialize', ['expedientes']);
    }
}
