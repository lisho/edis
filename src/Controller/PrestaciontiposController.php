<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Prestaciontipos Controller
 *
 * @property \App\Model\Table\PrestaciontiposTable $Prestaciontipos
 */
class PrestaciontiposController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $prestaciontipos = $this->paginate($this->Prestaciontipos);

        $this->set(compact('prestaciontipos'));
        $this->set('_serialize', ['prestaciontipos']);
    }

    /**
     * View method
     *
     * @param string|null $id Prestaciontipo id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $prestaciontipo = $this->Prestaciontipos->get($id, [
            'contain' => []
        ]);

        $this->set('prestaciontipo', $prestaciontipo);
        $this->set('_serialize', ['prestaciontipo']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $prestaciontipo = $this->Prestaciontipos->newEntity();
        if ($this->request->is('post')) {
            $prestaciontipo = $this->Prestaciontipos->patchEntity($prestaciontipo, $this->request->data);
            if ($this->Prestaciontipos->save($prestaciontipo)) {
                $this->Flash->success(__('The prestaciontipo has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The prestaciontipo could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('prestaciontipo'));
        $this->set('_serialize', ['prestaciontipo']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Prestaciontipo id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $prestaciontipo = $this->Prestaciontipos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $prestaciontipo = $this->Prestaciontipos->patchEntity($prestaciontipo, $this->request->data);
            if ($this->Prestaciontipos->save($prestaciontipo)) {
                $this->Flash->success(__('The prestaciontipo has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The prestaciontipo could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('prestaciontipo'));
        $this->set('_serialize', ['prestaciontipo']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Prestaciontipo id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $prestaciontipo = $this->Prestaciontipos->get($id);
        if ($this->Prestaciontipos->delete($prestaciontipo)) {
            $this->Flash->success(__('The prestaciontipo has been deleted.'));
        } else {
            $this->Flash->error(__('The prestaciontipo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
