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

    /**
     * Método para generar el combo de los TS asociados a un CEAS
     *
     * @param ceas_id por AJAX
     * @return Listado trabajadores sociales de CEAS JSON
     */
    public function combots()
    {
      
        if ($this->request->is('ajax')) { 
          $idCeas = $this->request->data['ceas'];
          //  debug($idCeas);exit();
          //$tecnico_ceas = new Tecnico();
          $tecnico_ceas='';
          
          $tecnicos = $this->Equipos->Tecnicos->find('all',array(
           'fields' => array('Tecnicos.id', 'Tecnicos.nombre', 'Tecnicos.apellidos'), 
           'conditions'=>array('equipo_id'=>$idCeas)
           ));
        
        foreach ($tecnicos as $t) {
                $tecnico_ceas[$t['id']]=$t['nombre'].' '.$t['apellidos'];
            }
           //debug($tecnico_ceas);exit();
          $this->RequestHandler->respondAs('json');
          $this->autoRender = false;      
          echo json_encode ($tecnico_ceas);
          //echo json_encode ($tecnico_edis);      
         }
    }

    /**
     * Método para generar el combo de los tecnicos edis asociados a un CEAS
     *
     * @param ceas_id por AJAX
     * @return listado tedis por JSON
     */
    public function combotedis()
    {
        
        if ($this->request->is('ajax')) { 
          $idCeas = $this->request->data['ceas'];
          //  debug($idCeas);exit();

          $tecnico_edis='';
          
          $aas = $this->Equipos->get($idCeas,array(
           'fields' => 'Equipos.aas', 
           )); // Determinamos el AAS a la que pertenece el CEAS

          $equipo = 'EDIS'.$aas['aas']; // Generamos el nombre del equipo EDIS

          // Lanzamos consulta de los nombres de los TEDIS de ese equipo.
          $tecnicos = $this->Equipos->Tecnicos->find('all')
               -> contain(['Equipos'])
               -> where(['Equipos.nombre'=>$equipo])
               -> select(['id', 'nombre', 'apellidos'])
               ;

        //debug($tecnicos->toArray());exit();
        // Generamos el listado para pasarlo por JSON.
        foreach ($tecnicos as $t) {
               $tecnico_edis[$t['id']]=$t['nombre'].' '.$t['apellidos'];
            }

          $this->RequestHandler->respondAs('json');
          $this->autoRender = false;      
          echo json_encode ($tecnico_edis);
        
         }

    }
}
