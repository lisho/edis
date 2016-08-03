<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Expedientes Controller
 *
 * @property \App\Model\Table\ExpedientesTable $Expedientes
 */
class ExpedientesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $expedientes = $this->paginate($this->Expedientes);

        $this->set(compact('expedientes'));
        $this->set('_serialize', ['expedientes']);
    }

    /**
     * View method
     *
     * @param string|null $id Expediente id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $expediente = $this->Expedientes->get($id, [
            'contain' => ['Participantes', 'Roles']
        ]);

        $this->set('expediente', $expediente);
        $this->set('_serialize', ['expediente']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
    
        $listado_ceas = $this->listadoEquipo('ceas');
        $listado_edis = $this->listadoEquipo('edis');

//debug($this->request->data);exit();
//debug($listado_edis);exit();
        $expediente = $this->Expedientes->newEntity();

        if ($this->request->is('post')) {
            $expediente = $this->Expedientes->patchEntity($expediente, $this->request->data, [
                        'asociated' => [
                                'Roles',
                                'Roles.Tecnicos',
                                'Roles.Tecnicos.Equipos'
                        ]
                    ]);
            
            debug($this->request->data);exit();


            if ($this->Expedientes->save($expediente) && $this->Roles->save($rol)) {
                $this->Flash->success(__('The expediente has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The expediente could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('expediente','listado_ceas','listado_edis'));
        $this->set('_serialize', ['expediente']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Expediente id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $expediente = $this->Expedientes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $expediente = $this->Expedientes->patchEntity($expediente, $this->request->data);
            if ($this->Expedientes->save($expediente)) {
                $this->Flash->success(__('The expediente has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The expediente could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('expediente'));
        $this->set('_serialize', ['expediente']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Expediente id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $expediente = $this->Expedientes->get($id);
        if ($this->Expedientes->delete($expediente)) {
            $this->Flash->success(__('The expediente has been deleted.'));
        } else {
            $this->Flash->error(__('The expediente could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
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
}
