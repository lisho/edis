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
        $ultimas_comisiones = $this->Comisions->find('all',['contain' => 'Pasacomisions', 'order'=>'fecha DESC' ,'limit'=>4]);

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
        $secretario='';
        $posibles_secretarios=[];
        $this->loadModel('Pasacomisions');      
        $nuevo_pasacomision = $this->Pasacomisions->newEntity();
        
        $comision = $this->Comisions->get($id, [
            'contain' => ['Asistentecomisions', 'Pasacomisions', 'Asistentecomisions.Tecnicos.Equipos', 'Pasacomisions.Expedientes','Pasacomisions.Expedientes.Participantes']
        ]);

        foreach ($comision->asistentecomisions as $asistente) {
            $asistentes[]=$asistente->tecnico_id; 
            if ($asistente->tecnico->equipo->tipo === "EDIS" && $asistente->rol ==="asistente") {
                $posibles_secretarios[$asistente->id]=$asistente->tecnico->nombre.' '.$asistente->tecnico->apellidos;
            }
            if ($asistente->rol ==="secretario") {
                    $secretario[$asistente->id]=$asistente->tecnico->nombre.' '.$asistente->tecnico->apellidos;
                }                           
        }

// BORRADOR      

        foreach ($comision->pasacomisions as $expediente) {
            $parrillas[]=$expediente->expediente->id;  
        /*    
            foreach ($expediente->expediente->participantes as $participante) {
                          $parrillas[$expediente->expediente->id][]=$participante->nombre.' '. $participante->apellidos; 
                      }    */    
        }

//debug($parrillas);exit();

// fin BORRADOR

        $this->loadModel('Tecnicos');
        $tecnicos = $this->Tecnicos->find('all', ['contain' => ['Asistentecomisions', 'Equipos'],
                                                    ]);

        if ($this->request->is('post')) {
                    $data = $this->request->data['pasacomision'];
                    $this->addPasacomision($data, $id, $nuevo_pasacomision);
                }

        $this->set(compact('comision', 'tecnicos', 'asistentes', 'listado_ceas', 'nuevo_pasacomision', 'posibles_secretarios','secretario'));
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

    /**
     * Add method
     * Añade un nuevo expediente a una comisión.
     * 
     */
    public function addPasacomision($data=null, $comision=null, $nuevo_pasacomision=null)
    {
       
        $existe_expediente = $this->Pasacomisions->findByComision_idAndExpediente_id($comision, $data['expediente_id']);
//debug($existe_expediente);exit();
        if (empty($existe_expediente->toArray())) {
                $nuevo_pasacomision = $this->Pasacomisions->patchEntity($nuevo_pasacomision, $data);    
                //debug($nueva_incidencia);exit();
                if ($this->Pasacomisions->save($nuevo_pasacomision)) {
                    $this->Flash->success('Se ha añadido correctamente el expediente a esta comisión');
                    
                    return $this->redirect(['action' => 'view',$comision]);
                    
                } else {
                    $this->Flash->error(__('Lo siento. No ha sido posible incluir este expediente en la comisión. Por favor revisa los datos.'));
                }

                $this->autoRender = false;

        } else {
           $this->Flash->error(__('Lo siento. No ha sido posible añadir este expediente porque ya existe en esta Comisión.'));
        }
            
        
    }

}