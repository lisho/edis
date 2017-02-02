<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Incidencias Controller
 *
 * @property \App\Model\Table\IncidenciasTable $Incidencias
 */
class IncidenciasController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Incidenciatipos', 'Users', 'Expedientes']
        ];
        $incidencias = $this->paginate($this->Incidencias);

        $this->set(compact('incidencias'));
        $this->set('_serialize', ['incidencias']);
    }

    /**
     * View method
     *
     * @param string|null $id Incidencia id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $incidencia = $this->Incidencias->get($id, [
            'contain' => ['Incidenciatipos', 'Users', 'Expedientes']
        ]);

        $this->set('incidencia', $incidencia);
        $this->set('_serialize', ['incidencia']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $incidencia = $this->Incidencias->newEntity();
        
        if ($this->request->is('post')) {
        
            $cachos_fecha = preg_split("/[\/]+/", $this->request->data['fecha']);
            
            $this->request->data['fecha']=array(
                                'year'=>$cachos_fecha[2],
                                'month'=>$cachos_fecha[1],
                                'day' =>$cachos_fecha[0] 
                        );
//debug($this->request->data);exit();   
            $incidencia = $this->Incidencias->patchEntity($incidencia, $this->request->data);
            if ($this->Incidencias->save($incidencia)) {
                $this->Flash->success(__('The incidencia has been saved.'));
                return $this->redirect($this->referer());
            } else {
                $this->Flash->error(__('The incidencia could not be saved. Please, try again.'));
            }
        }
        $incidenciatipos = $this->Incidencias->Incidenciatipos->find('list', [  'keyField' => 'id',
                                                                                'valueField' => 'tipo'
                                                                                ]);

        //$incidenciatipos = $incidenciatipos->toArray();
        $users = $this->Incidencias->Users->find('list', [  'keyField' => 'id',
                                                            'valueField' => 'nombre'
                                                            ]);

        $expedientes = $this->Incidencias->Expedientes->find('list', [  'keyField' => 'id',
                                                                        'valueField' => 'numedis'
                                                                        ]);

        $this->set(compact('incidencia', 'incidenciatipos', 'users', 'expedientes'));
        $this->set('_serialize', ['incidencia']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Incidencia id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $incidencia = $this->Incidencias->get($id, [
            'contain' => ['Expedientes','Users']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
             $cachos_fecha = preg_split("/[\/]+/", $this->request->data['fecha']);
            
            $this->request->data['fecha']=array(
                                'year'=>$cachos_fecha[2],
                                'month'=>$cachos_fecha[1],
                                'day' =>$cachos_fecha[0] 
                        );
            $incidencia = $this->Incidencias->patchEntity($incidencia, $this->request->data);
            if ($this->Incidencias->save($incidencia)) {
                $this->Flash->success(__('The incidencia has been saved.'));
                return $this->redirect(['controller' => 'Expedientes', 'action' => 'view', $incidencia->expediente_id]);
                
            } else {
                $this->Flash->error(__('The incidencia could not be saved. Please, try again.'));
            }
        }
        $incidenciatipos = $this->Incidencias->Incidenciatipos->find('list', ['limit' => 200]);
        $users = $this->Incidencias->Users->find('list', [  'keyField' => 'id',
                                                            'valueField' => 'user'
                                                            ]);

        $expedientes = $this->Incidencias->Expedientes->find('list', [  'keyField' => 'id',
                                                                        'valueField' => 'numedis'
                                                                        ]);
        $this->set(compact('incidencia', 'incidenciatipos', 'users', 'expedientes'));
        $this->set('_serialize', ['incidencia']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Incidencia id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $incidencia = $this->Incidencias->get($id);
        if ($this->Incidencias->delete($incidencia)) {
            $this->Flash->success(__('The incidencia has been deleted.'));
        } else {
            $this->Flash->error(__('The incidencia could not be deleted. Please, try again.'));
        }
        return $this->redirect($this->referer());
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function gestion()
    {
        $incidencia = $this->Incidencias->newEntity();
        if ($this->request->is('post')) {
            $incidencia = $this->Incidencias->patchEntity($incidencia, $this->request->data);
            if ($this->Incidencias->save($incidencia)) {
                $this->Flash->success(__('The incidencia has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The incidencia could not be saved. Please, try again.'));
            }
        }
        $incidenciatipos = $this->Incidencias->Incidenciatipos->find('list', [  'keyField' => 'id',
                                                                                'valueField' => 'tipo'
                                                                                ]);

        //$incidenciatipos = $incidenciatipos->toArray();
        $users = $this->Incidencias->Users->find('all', ['limit' => 200, 'fields' => ['nombre','apellidos']]);
        $expedientes = $this->Incidencias->Expedientes->find('list', ['limit' => 200]);
        $this->set(compact('incidencia', 'incidenciatipos', 'users', 'expedientes'));
        $this->set('_serialize', ['incidencia']);
    }

}
