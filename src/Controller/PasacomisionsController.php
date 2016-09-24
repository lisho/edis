<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Pasacomisions Controller
 *
 * @property \App\Model\Table\PasacomisionsTable $Pasacomisions
 */
class PasacomisionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Expedientes', 'Comisions']
        ];
        $pasacomisions = $this->paginate($this->Pasacomisions);

        $this->set(compact('pasacomisions'));
        $this->set('_serialize', ['pasacomisions']);
    }

    /**
     * View method
     *
     * @param string|null $id Pasacomision id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $pasacomision = $this->Pasacomisions->get($id, [
            'contain' => ['Expedientes', 'Comisions']
        ]);

        $this->set('pasacomision', $pasacomision);
        $this->set('_serialize', ['pasacomision']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $pasacomision = $this->Pasacomisions->newEntity();
        if ($this->request->is('post')) {
            $pasacomision = $this->Pasacomisions->patchEntity($pasacomision, $this->request->data);
            if ($this->Pasacomisions->save($pasacomision)) {
                $this->Flash->success(__('The pasacomision has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The pasacomision could not be saved. Please, try again.'));
            }
        }
        $expedientes = $this->Pasacomisions->Expedientes->find('list', ['limit' => 200]);
        $comisions = $this->Pasacomisions->Comisions->find('list', ['limit' => 200]);
        $this->set(compact('pasacomision', 'expedientes', 'comisions'));
        $this->set('_serialize', ['pasacomision']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Pasacomision id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $pasacomision = $this->Pasacomisions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pasacomision = $this->Pasacomisions->patchEntity($pasacomision, $this->request->data);
            if ($this->Pasacomisions->save($pasacomision)) {
                $this->Flash->success(__('The pasacomision has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The pasacomision could not be saved. Please, try again.'));
            }
        }
        $expedientes = $this->Pasacomisions->Expedientes->find('list', ['limit' => 200]);
        $comisions = $this->Pasacomisions->Comisions->find('list', ['limit' => 200]);
        $this->set(compact('pasacomision', 'expedientes', 'comisions'));
        $this->set('_serialize', ['pasacomision']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Pasacomision id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pasacomision = $this->Pasacomisions->get($id);
        if ($this->Pasacomisions->delete($pasacomision)) {
            $this->Flash->success(__('The pasacomision has been deleted.'));
        } else {
            $this->Flash->error(__('The pasacomision could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
