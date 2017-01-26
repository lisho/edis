<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Informes Controller
 *
 * @property \App\Model\Table\InformesTable $Informes
 */
class InformesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Expedientes']
        ];
        $informes = $this->paginate($this->Informes);

        $this->set(compact('informes'));
        $this->set('_serialize', ['informes']);
    }

    /**
     * View method
     *
     * @param string|null $id Informe id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $informe = $this->Informes->get($id, [
            'contain' => ['Users', 'Expedientes']
        ]);

        $this->set('informe', $informe);
        $this->set('_serialize', ['informe']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $informe = $this->Informes->newEntity();
        if ($this->request->is('post')) {
            $informe = $this->Informes->patchEntity($informe, $this->request->data);
            if ($this->Informes->save($informe)) {
                $this->Flash->success(__('The informe has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The informe could not be saved. Please, try again.'));
            }
        }
        $users = $this->Informes->Users->find('list', ['limit' => 200]);
        $expedientes = $this->Informes->Expedientes->find('list', ['limit' => 200]);
        $this->set(compact('informe', 'users', 'expedientes'));
        $this->set('_serialize', ['informe']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Informe id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $informe = $this->Informes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $informe = $this->Informes->patchEntity($informe, $this->request->data);
            if ($this->Informes->save($informe)) {
                $this->Flash->success(__('The informe has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The informe could not be saved. Please, try again.'));
            }
        }
        $users = $this->Informes->Users->find('list', ['limit' => 200]);
        $expedientes = $this->Informes->Expedientes->find('list', ['limit' => 200]);
        $this->set(compact('informe', 'users', 'expedientes'));
        $this->set('_serialize', ['informe']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Informe id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $informe = $this->Informes->get($id);
        if ($this->Informes->delete($informe)) {
            $this->Flash->success(__('The informe has been deleted.'));
        } else {
            $this->Flash->error(__('The informe could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
