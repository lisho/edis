<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Comisions Controller
 *
 * @property \App\Model\Table\ComisionsTable $Comisions
 */
class ComisionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $comisions = $this->paginate($this->Comisions);
        $ultimas_comisiones = $this->Comisions->find('all',['order'=>'fecha DESC' ,'limit'=>4]);

        $nueva_comision = $this->Comisions->newEntity();
        
        if ($this->request->is('post')) {
            $cachos_fecha = preg_split("/[\/]+/", $this->request->data['fecha']);
            if ( $this->request->data['fecha']!='') {
                 $this->request->data['fecha']=array(
                                'year'=>$cachos_fecha[2],
                                'month'=>$cachos_fecha[1],
                                'day' =>$cachos_fecha[0] 
                        );
            }
            
            //$this->request->data['id']='';
            $nueva_comision = $this->Comisions->patchEntity($nueva_comision, $this->request->data);

            if ($this->Comisions->save($nueva_comision)) {
                $this->Flash->success(__('The comision has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The comision could not be saved. Please, try again.'));
            }
        }

        $this->set(compact('comisions', 'nueva_comision', 'ultimas_comisiones'));
        $this->set('_serialize', ['comisions', 'nueva_comision']);
    }

    /**
     * View method
     *
     * @param string|null $id Comision id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $listado_ceas = $this->listadoEquipo('CEAS');
        $pasacomision = $this->Comisions->Pasacomisions->newEntity();
        $comision = $this->Comisions->get($id, [
            'contain' => ['Asistentecomisions', 'Pasacomisions', 'Asistentecomisions.Tecnicos.Equipos', 'Pasacomisions.Expedientes']
        ]);

        foreach ($comision->asistentecomisions as $asistente) {
            $asistentes[]=$asistente->tecnico_id;            
        }

        $this->loadModel('Tecnicos');
        $tecnicos = $this->Tecnicos->find('all', ['contain' => ['Asistentecomisions', 'Equipos'],
                                                    ]);


        $this->set(compact('comision', 'tecnicos', 'asistentes', 'listado_ceas', 'pasacomision'));
        $this->set('_serialize', ['comision']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $comision = $this->Comisions->newEntity();
        if ($this->request->is('post')) {
            $comision = $this->Comisions->patchEntity($comision, $this->request->data);
            if ($this->Comisions->save($comision)) {
                $this->Flash->success(__('The comision has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The comision could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('comision'));
        $this->set('_serialize', ['comision']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Comision id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $comision = $this->Comisions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $comision = $this->Comisions->patchEntity($comision, $this->request->data);
            if ($this->Comisions->save($comision)) {
                $this->Flash->success(__('The comision has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The comision could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('comision'));
        $this->set('_serialize', ['comision']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Comision id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $comision = $this->Comisions->get($id);
        if ($this->Comisions->delete($comision)) {
            $this->Flash->success(__('The comision has been deleted.'));
        } else {
            $this->Flash->error(__('The comision could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
