<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Asistentecomisions Controller
 *
 * @property \App\Model\Table\AsistentecomisionsTable $Asistentecomisions
 */
class AsistentecomisionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Comisions', 'Tecnicos']
        ];
        $asistentecomisions = $this->paginate($this->Asistentecomisions);

        $this->set(compact('asistentecomisions'));
        $this->set('_serialize', ['asistentecomisions']);
    }

    /**
     * View method
     *
     * @param string|null $id Asistentecomision id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $asistentecomision = $this->Asistentecomisions->get($id, [
            'contain' => ['Comisions', 'Tecnicos']
        ]);

        $this->set('asistentecomision', $asistentecomision);
        $this->set('_serialize', ['asistentecomision']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        $asistentecomision = $this->Asistentecomisions->newEntity();
 

        if ($this->request->is('post')) {
           
           $tecnico_id = $this->request->data['tecnico_id'];  
           $comision_id = $this->request->data['comision_id'];  
          
           $existe_asistente = $this->Asistentecomisions->find('list', [
                                'conditions'=>['tecnico_id'=>$tecnico_id,
                                                'comision_id' =>$comision_id]
                                ]);
            if (empty($existe_asistente->toArray())) {
                $this->request->data['rol']='asistente';
                $asistentecomision = $this->Asistentecomisions->patchEntity($asistentecomision, $this->request->data);
                $this->Asistentecomisions->save($asistentecomision);
            } else {
                $asistentecomision = $this->Asistentecomisions->get($existe_asistente->toArray());
                $this->Asistentecomisions->delete($asistentecomision);                
            }

            //debug($existe_asistente->toArray());exit();

            $this->autoRender=false;
        }

    }

    /**
     * Edit method
     *
     * @param string|null $id Asistentecomision id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        
        $asistentecomision = $this->Asistentecomisions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $asistentecomision = $this->Asistentecomisions->patchEntity($asistentecomision, $this->request->data);
            if ($this->Asistentecomisions->save($asistentecomision)) {
                //$this->Flash->success(__('The asistentecomision has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The asistentecomision could not be saved. Please, try again.'));
            }
        }
        $comisions = $this->Asistentecomisions->Comisions->find('list', ['limit' => 200]);
        $tecnicos = $this->Asistentecomisions->Tecnicos->find('list', ['limit' => 200]);
        $this->set(compact('asistentecomision', 'comisions', 'tecnicos'));
        $this->set('_serialize', ['asistentecomision']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Asistentecomision id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $asistentecomision = $this->Asistentecomisions->get($id);
        if ($this->Asistentecomisions->delete($asistentecomision)) {
            $this->Flash->success(__('The asistentecomision has been deleted.'));
        } else {
            $this->Flash->error(__('The asistentecomision could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

}
