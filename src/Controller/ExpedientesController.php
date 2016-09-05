<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Expedientes Controller
 *
 * @property \App\Model\Table\ExpedientesTable $Expedientes
 */
class ExpedientesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Participantes'=>[
                                'conditions' => ['Participantes.relation_id'=>'1']
                ]
            ],
            //'conditions' => ['participantes.relation_id'=>'1']
        ];
        $expedientes = $this->paginate($this->Expedientes);
        $listado_ceas = $this->listadoEquipo('ceas');

        $this->set(compact('expedientes', 'listado_ceas'));
        $this->set('_serialize', ['expedientes']);
    }

    
    /**
     * View method
     *
     * @param string|null $id Expediente id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->loadModel('Participantes');
        $participante = $this->Participantes->newEntity();

        $expediente = $this->Expedientes->get($id, [
            'contain' => ['Participantes', 'Roles', 'Roles.Tecnicos', 'Participantes.Relations']
        ]);

        //Añadimos la edad al array de datos del expediente
            foreach ($expediente->participantes as $p) {
                $edad = $this->calcularEdad($p['nacimiento']);
                $p['edad'] = $edad;
            }

       
            //Si creamos un nuevo usuario en el expediente...
            if ($this->request->is('post')) {
        
                $data = $this->request->data['participantes'];
                $this->addParticipante($data,$expediente,$participante);
                
            } // FIN creación de nuevo usuario/participante.

        $listado_ceas = $this->listadoEquipo('ceas');        
        $listado_relaciones = $this->listadoRelaciones();
       unset($listado_relaciones['1']); // Quitamos la opcion Titular del desplegable.       

        $this->set(compact('expediente', 'participante', 'listado_ceas', 'listado_relaciones'));
        $this->set('_serialize', ['expediente']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        
        $listado_ceas = $this->listadoEquipo('ceas');
        $listado_edis = $this->listadoEquipo('edis');

        $expediente = $this->Expedientes->newEntity();

        if ($this->request->is('post')) {
            $cachos_fecha = preg_split("/[\/]+/", $this->request->data['participantes'][0]['nacimiento']);

            $this->request->data['participantes'][0]['foto']='';
            
            $this->request->data['participantes'][0]['nacimiento']=null;
            if ( $this->request->data['participantes'][0]['nacimiento']) {
                 $this->request->data['participantes'][0]['nacimiento']=array(
                                'year'=>$cachos_fecha[2],
                                'month'=>$cachos_fecha[1],
                                'day' =>$cachos_fecha[0] 
                        );
            }
           

            $this->request->data['roles'][0]= array(
                                //'expediente_id'=> $this->request->data['tecnico_ceas'],
                                'id'=>'',
                                'tecnico_id'=> $this->request->data['tecnico_ceas'],
                                'rol'=> 'CC',
                                'observaciones'=> '',
                        );
            $this->request->data['roles'][1]= array(
                                //'expediente_id'=> $this->request->data['tecnico_ceas'],
                                'id'=>'',
                                'tecnico_id'=> $this->request->data['tecnico_inclusion'],
                                'rol'=> 'tedis',
                                'observaciones'=> '',
                        );


            $expediente = $this->Expedientes->patchEntity($expediente, $this->request->data, [
                        'associated' => [
                                'Roles',
                                'Roles.Tecnicos',
                                //'Roles.Tecnicos.Equipos',
                                'Participantes'
                        ]
                    ]);

//debug($expediente);exit();

            if ($this->Expedientes->save($expediente)) {
                $this->Flash->success(__('El expediente '.$expediente['numedis'].' ha sido creado correctamente.'));
                return $this->redirect(['action' => 'view',$expediente['id']]);
            } else {
                $this->Flash->error(__('No se ha podiodo crear el expediente correctamente. Por favor revisa los datos.'));
            }


        }
        $this->set(compact('expediente','listado_ceas','listado_edis'));
        $this->set('_serialize', ['expediente']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Expediente id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $listado_ceas = $this->listadoEquipo('ceas');
        $listado_edis = $this->listadoEquipo('edis');
        $listado_tecnicos = $this->listadoTecnicos();
        $opciones_rol = ['CC'=>'Coordinador de Caso', 'tedis'=>'Técnico de Inclusión'];
        $expediente = $this->Expedientes->get($id, [
            'contain' => [
                                'Roles',
                                'Roles.Tecnicos',
                                'Roles.Tecnicos.Equipos',
                                'Participantes',
                                'Participantes.Relations'
                        ]
            
        ]);
//debug($this->request->data);exit();

        /* Ajustes para los cambios de roles*/

        if (isset($this->request->data['roles'][0]['rol'])) {
            if (!isset($this->request->data['roles'][0]['id'])) {
                $this->request->data['roles'][0]['id']='';
            }

            $this->request->data['roles'][0]['expediente_id']=$id;
        }
        
                            
        if ($this->request->is(['patch', 'post', 'put'])) {
            
            $expediente = $this->Expedientes->patchEntity($expediente, $this->request->data, [
                        'associated' => [
                                'Roles',
                                'Roles.Tecnicos',
                                //'Roles.Tecnicos.Equipos',
                                'Participantes'
                        ]
                    ]);


            if ($this->Expedientes->save($expediente)) {
                $this->Flash->success(__('The expediente has been saved.'));
                
                return $this->redirect(['action' => 'view',$id]);
                
                if (isset($this->request->data['roles']) || isset($this->request->data['volver'])) {
                    /*return $this->redirect($this->referer());*/
                    
                } else {
                    return $this->redirect(['action' => 'view',$id]);
                }
                
                
            } else {
                $this->Flash->error(__('The expediente could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('expediente', 'listado_ceas','listado_edis','listado_tecnicos', 'opciones_rol'));
        $this->set('_serialize', ['expediente']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Expediente id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $expediente = $this->Expedientes->get($id);
        if ($this->Expedientes->delete($expediente)) {
            $this->Flash->success(__('The expediente has been deleted.'));
        } else {
            $this->Flash->error(__('The expediente could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }


    /**
     * AddParticipante method
     *
     * Crea un n uevo partricipante en la parrilla familia.
     *
     * Necesitamos pasarle:
     *  1. Array con los datos del expediente, al menos id y numedis
     *  2. Array con el request->data del formulario.
     *   Redirecciona a la vista del expediente.
     */
    public function addParticipante($data,$expediente,$participante)
    {
        
        $cachos_fecha = preg_split("/[\/]+/", $data['nacimiento']);
        $data['id']='';
        $data['foto']='';
        $data['expediente_id']=$expediente['id'];
        //$data['nacimiento']=null;
            if ( $data['nacimiento']!='') {
                 $data['nacimiento']=array(
                                'year'=>$cachos_fecha[2],
                                'month'=>$cachos_fecha[1],
                                'day' =>$cachos_fecha[0] 
                        );
            }
       
        $participante = $this->Participantes->patchEntity($participante, $data);    
        //debug($data);exit();
        if ($this->Participantes->save($participante)) {
            $this->Flash->success('Se ha añadido correctamente un nuevo miembro a la parrilla familiar del expediente'.$expediente['numedis']);
            
            return $this->redirect(['action' => 'view',$expediente['id']]);
            
        } else {
            $this->Flash->error(__('Lo siento. No ha sido posible incluir a esa persona en el sistema. Por favor revisa los datos.'));
        }

    }
    
}
