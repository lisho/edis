<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Participantes Controller
 *
 * @property \App\Model\Table\ParticipantesTable $Participantes
 */
class ParticipantesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Expedientes']
        ];
        $participantes = $this->paginate($this->Participantes);

        $this->set(compact('participantes'));
        $this->set('_serialize', ['participantes']);
    }

    /**
     * View method
     *
     * @param string|null $id Participante id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $participante = $this->Participantes->get($id, [
            'contain' => ['Expedientes']
        ]);

        $this->set('participante', $participante);
        $this->set('_serialize', ['participante']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        
        $participante = $this->Participantes->newEntity();
        if ($this->request->is('post')) {
            $participante = $this->Participantes->patchEntity($participante, $this->request->data, [
                        'associated' => [
                                'Relations'
                        ]
                        ]);
            if ($this->Participantes->save($participante)) {
                $this->Flash->success(__('The participante has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The participante could not be saved. Please, try again.'));
            }
        }
        
        $relaciones = $this->Participantes->Relations->find('list', ['limit' => 20]);
        $this->set(compact('participante','relaciones'));
        $this->set('_serialize', ['participante']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Participante id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $participante = $this->Participantes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $participante = $this->Participantes->patchEntity($participante, $this->request->data);
            if ($this->Participantes->save($participante)) {
                $this->Flash->success(__('The participante has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The participante could not be saved. Please, try again.'));
            }
        }
        $expedientes = $this->Participantes->Expedientes->find('list', ['limit' => 200]);
        $this->set(compact('participante', 'expedientes'));
        $this->set('_serialize', ['participante']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Participante id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $participante = $this->Participantes->get($id);
        if ($this->Participantes->delete($participante)) {
            $this->Flash->success(__('The participante has been deleted.'));
        } else {
            $this->Flash->error(__('The participante could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }


    /*
    * BUSCADOR DE ALUMNOS;
    *
    * 
    */  

    public function searchjson()
    {
        $term=null;
        if (!empty($this->request->query['term'])) {
            $term=$this->request->query['term'];
            $terms=explode(' ', trim($term));
            $terms=array_diff($terms, array(''));


            $participantes = $this->Participantes->find('all')
                        -> where(['CONCAT(dni," ", nombre," ", apellidos) LIKE' => '%' . implode(" ", $terms) . '%'])
                        -> orWhere(['CONCAT(dni," ", apellidos," ", nombre) LIKE' => '%' . implode(" ", $terms) . '%'])
                        ;
                        
            //debug($conditions);exit();
        }
        echo json_encode($participantes);
        $this->autoRender = false;
    }

}
