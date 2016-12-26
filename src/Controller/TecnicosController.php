<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Tecnicos Controller
 *
 * @property \App\Model\Table\TecnicosTable $Tecnicos
 */
class TecnicosController extends AppController
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
        $tecnicos = $this->paginate($this->Tecnicos);

        $this->set(compact('tecnicos'));
        $this->set('_serialize', ['tecnicos']);
    }

    /**
     * View method
     *
     * @param string|null $id Tecnico id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tecnico = $this->Tecnicos->get($id, [
            'contain' => ['Equipos', 'Roles']
        ]);

        $this->set('tecnico', $tecnico);
        $this->set('_serialize', ['tecnico']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tecnico = $this->Tecnicos->newEntity();

        //debug( $this->request->data);exit();
        if ($this->request->is('post')) {
            $tecnico = $this->Tecnicos->patchEntity($tecnico, $this->request->data);
            if ($this->Tecnicos->save($tecnico)) {
                $this->Flash->success(__('The tecnico has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The tecnico could not be saved. Please, try again.'));
            }
        }
        $equipos = $this->Tecnicos->Equipos->find('list', ['limit' => 200]);
        $this->set(compact('tecnico', 'equipos'));
        $this->set('_serialize', ['tecnico']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Tecnico id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tecnico = $this->Tecnicos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tecnico = $this->Tecnicos->patchEntity($tecnico, $this->request->data);
            if ($this->Tecnicos->save($tecnico)) {
                $this->Flash->success(__('The tecnico has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The tecnico could not be saved. Please, try again.'));
            }
        }
        $equipos = $this->Tecnicos->Equipos->find('list', ['limit' => 200]);
        $this->set(compact('tecnico', 'equipos'));
        $this->set('_serialize', ['tecnico']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Tecnico id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tecnico = $this->Tecnicos->get($id);
        if ($this->Tecnicos->delete($tecnico)) {
            $this->Flash->success(__('The tecnico has been deleted.'));
        } else {
            $this->Flash->error(__('The tecnico could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * PASAMOS A PRIMERA EN MAYUSCULA LOS CAMPOS DE LA FUNCION
     */
    public function mayuscula()
    {
        $tecnicos = $this->Tecnicos->find('all');

        foreach ($tecnicos as $t) {
            $tecnico = $t->toArray();
            $mayusculas = ["Á", "É", "Í", "Ó", "Ú"];
            $minusculas = ["á", "é", "í", "ó", "ú"];

            $tecnico['nombre']=ucwords(strtolower($tecnico['nombre']));
            $tecnico['nombre']=str_replace($mayusculas,$minusculas,$tecnico['nombre']);
            $tecnico['apellidos']=ucwords(strtolower($tecnico['apellidos']));
            $tecnico['apellidos']=str_replace($mayusculas,$minusculas,$tecnico['apellidos']);
            $t= $this->Tecnicos->patchEntity($t, $tecnico);

            $this->Tecnicos->save($t);
        }
        debug($t);
        exit();
        
    }
}
