<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Prestacionestados Controller
 *
 * @property \App\Model\Table\PrestacionestadosTable $Prestacionestados
 */
class PrestacionestadosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $prestacionestados = $this->paginate($this->Prestacionestados);

        $this->set(compact('prestacionestados'));
        $this->set('_serialize', ['prestacionestados']);
    }

    /**
     * View method
     *
     * @param string|null $id Prestacionestado id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $prestacionestado = $this->Prestacionestados->get($id, [
            'contain' => []
        ]);

        $this->set('prestacionestado', $prestacionestado);
        $this->set('_serialize', ['prestacionestado']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $prestacionestado = $this->Prestacionestados->newEntity();
        if ($this->request->is('post')) {
            $prestacionestado = $this->Prestacionestados->patchEntity($prestacionestado, $this->request->data);
            if ($this->Prestacionestados->save($prestacionestado)) {
                $this->Flash->success(__('The prestacionestado has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The prestacionestado could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('prestacionestado'));
        $this->set('_serialize', ['prestacionestado']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Prestacionestado id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $prestacionestado = $this->Prestacionestados->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $prestacionestado = $this->Prestacionestados->patchEntity($prestacionestado, $this->request->data);
            if ($this->Prestacionestados->save($prestacionestado)) {
                $this->Flash->success(__('The prestacionestado has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The prestacionestado could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('prestacionestado'));
        $this->set('_serialize', ['prestacionestado']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Prestacionestado id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $prestacionestado = $this->Prestacionestados->get($id);
        if ($this->Prestacionestados->delete($prestacionestado)) {
            $this->Flash->success(__('The prestacionestado has been deleted.'));
        } else {
            $this->Flash->error(__('The prestacionestado could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
