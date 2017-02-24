<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Incidenciatipos Controller
 *
 * @property \App\Model\Table\IncidenciatiposTable $Incidenciatipos
 */
class IncidenciatiposController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $incidenciatipos = $this->paginate($this->Incidenciatipos);

        $this->set(compact('incidenciatipos'));
        $this->set('_serialize', ['incidenciatipos']);
    }

    /**
     * View method
     *
     * @param string|null $id Incidenciatipo id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $incidenciatipo = $this->Incidenciatipos->get($id, [
            'contain' => ['Incidencias']
        ]);

        $this->set('incidenciatipo', $incidenciatipo);
        $this->set('_serialize', ['incidenciatipo']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tipos_de_incidencia = $this->paginate($this->Incidenciatipos);
        $incidenciatipo = $this->Incidenciatipos->newEntity();
        if ($this->request->is('post')) {
            $incidenciatipo = $this->Incidenciatipos->patchEntity($incidenciatipo, $this->request->data);
            if ($this->Incidenciatipos->save($incidenciatipo)) {
                $this->Flash->success(__('The incidenciatipo has been saved.'));
                return $this->redirect(['action' => 'add']);
            } else {
                $this->Flash->error(__('The incidenciatipo could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('incidenciatipo', 'tipos_de_incidencia'));
        $this->set('_serialize', ['incidenciatipo']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Incidenciatipo id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $incidenciatipo = $this->Incidenciatipos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $incidenciatipo = $this->Incidenciatipos->patchEntity($incidenciatipo, $this->request->data);
            if ($this->Incidenciatipos->save($incidenciatipo)) {
                $this->Flash->success(__('The incidenciatipo has been saved.'));
                return $this->redirect(['action' => 'add']);
            } else {
                $this->Flash->error(__('The incidenciatipo could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('incidenciatipo'));
        $this->set('_serialize', ['incidenciatipo']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Incidenciatipo id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $incidenciatipo = $this->Incidenciatipos->get($id);
        if ($this->Incidenciatipos->delete($incidenciatipo)) {
            $this->Flash->success(__('The incidenciatipo has been deleted.'));
        } else {
            $this->Flash->error(__('The incidenciatipo could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

        /**
    **
    ** Lista de TIPOS DE INCIEDENCIA
    **
    **/

    public function listaTipos()
    {
        $lista = $this->Incidenciatipos->find('list')
                                        -> select('tipo')
                                        -> toArray()
                                        ;

        echo json_encode($lista);
        $this->autoRender = false;

    }
}
