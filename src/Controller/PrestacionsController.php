<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Prestacions Controller
 *
 * @property \App\Model\Table\PrestacionsTable $Prestacions
 */
class PrestacionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Tipoprestacions', 'Expedientes', 'Participantes', 'Estadoprestacions']
        ];
        $prestacions = $this->paginate($this->Prestacions);

        $this->set(compact('prestacions'));
        $this->set('_serialize', ['prestacions']);
    }

    /**
     * View method
     *
     * @param string|null $id Prestacion id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $prestacion = $this->Prestacions->get($id, [
            'contain' => ['Tipoprestacions', 'Expedientes', 'Participantes', 'Estadoprestacions']
        ]);

        $this->set('prestacion', $prestacion);
        $this->set('_serialize', ['prestacion']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $prestacion = $this->Prestacions->newEntity();
        if ($this->request->is('post')) {
            $prestacion = $this->Prestacions->patchEntity($prestacion, $this->request->data);
            if ($this->Prestacions->save($prestacion)) {
                $this->Flash->success(__('The prestacion has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The prestacion could not be saved. Please, try again.'));
            }
        }
        $tipoprestacions = $this->Prestacions->Tipoprestacions->find('list', ['limit' => 200]);
        $expedientes = $this->Prestacions->Expedientes->find('list', ['limit' => 200]);
        $participantes = $this->Prestacions->Participantes->find('list', ['limit' => 200]);
        $estadoprestacions = $this->Prestacions->Estadoprestacions->find('list', ['limit' => 200]);
        $this->set(compact('prestacion', 'tipoprestacions', 'expedientes', 'participantes', 'estadoprestacions'));
        $this->set('_serialize', ['prestacion']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Prestacion id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $prestacion = $this->Prestacions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $prestacion = $this->Prestacions->patchEntity($prestacion, $this->request->data);
            if ($this->Prestacions->save($prestacion)) {
                $this->Flash->success(__('The prestacion has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The prestacion could not be saved. Please, try again.'));
            }
        }
        $tipoprestacions = $this->Prestacions->Tipoprestacions->find('list', ['limit' => 200]);
        $expedientes = $this->Prestacions->Expedientes->find('list', ['limit' => 200]);
        $participantes = $this->Prestacions->Participantes->find('list', ['limit' => 200]);
        $estadoprestacions = $this->Prestacions->Estadoprestacions->find('list', ['limit' => 200]);
        $this->set(compact('prestacion', 'tipoprestacions', 'expedientes', 'participantes', 'estadoprestacions'));
        $this->set('_serialize', ['prestacion']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Prestacion id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $prestacion = $this->Prestacions->get($id);
        if ($this->Prestacions->delete($prestacion)) {
            $this->Flash->success(__('The prestacion has been deleted.'));
        } else {
            $this->Flash->error(__('The prestacion could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
