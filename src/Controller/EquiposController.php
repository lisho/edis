<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Equipos Controller
 *
 * @property \App\Model\Table\EquiposTable $Equipos
 */
class EquiposController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $equipos = $this->paginate($this->Equipos);

        $this->set(compact('equipos'));
        $this->set('_serialize', ['equipos']);
    }

    /**
     * View method
     *
     * @param string|null $id Equipo id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $equipo = $this->Equipos->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('equipo', $equipo);
        $this->set('_serialize', ['equipo']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $equipo = $this->Equipos->newEntity();
        if ($this->request->is('post')) {
            $equipo = $this->Equipos->patchEntity($equipo, $this->request->data);
            if ($this->Equipos->save($equipo)) {
                $this->Flash->success(__('The equipo has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The equipo could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('equipo'));
        $this->set('_serialize', ['equipo']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Equipo id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $equipo = $this->Equipos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $equipo = $this->Equipos->patchEntity($equipo, $this->request->data);
            if ($this->Equipos->save($equipo)) {
                $this->Flash->success(__('The equipo has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The equipo could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('equipo'));
        $this->set('_serialize', ['equipo']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Equipo id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $equipo = $this->Equipos->get($id);
        if ($this->Equipos->delete($equipo)) {
            $this->Flash->success(__('The equipo has been deleted.'));
        } else {
            $this->Flash->error(__('The equipo could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function combots()
    {
      /*
        $ceas = $this->request->data;
        
        //debug($ceas);exit();

        if ($ceas[0]=='3') {
           $lista = ['Juan', 'Pedro', 'Sancho', 'Luis'];
        } else {
            $lista = ['este no es el ceas de armunia'];
        }
        

        

        //$this->set(compact(json_encode('elegido')));
        echo json_encode($lista);
        $this->autoRender = false;
    */

        if ($this->request->is('ajax')) { 
          $idCeas = $this->request->data['ceas'];
          //  debug($idCeas);exit();
          //$tecnico = new Tecnico();
          $tecnico='';
          $tecnicos = $this->Equipos->Tecnicos->find('all',array(
           'fields' => array('Tecnicos.id', 'Tecnicos.nombre', 'Tecnicos.apellidos'), 
           'conditions'=>array('equipo_id'=>$idCeas)));
        
        foreach ($tecnicos as $t) {
                $tecnico[$t['id']]=$t['nombre'].' '.$t['apellidos'];
            }
           //debug($tecnico);exit();
          $this->RequestHandler->respondAs('json');
          $this->autoRender = false;      
          echo json_encode ($tecnico);      
         }
    }

    public function combotedis()
    {
        $elegido = ['1'=>'Juan', '2'=>'Pedro', '3'=>'Sancho'];
        //$this->set(compact(json_encode('elegido')));


        echo json_encode($elegido);
        $this->autoRender = false;
    }
}
