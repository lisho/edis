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
        $expediente = $this->Expedientes->get($id, [
            'contain' => ['Participantes', 'Roles']
        ]);

        $this->set('expediente', $expediente);
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
            $this->request->data['participantes'][0]['nacimiento']=array(
                                'year'=>$cachos_fecha[2],
                                'month'=>$cachos_fecha[1],
                                'day' =>$cachos_fecha[0] 
                        );

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
                                //'Roles.Tecnicos',
                                //'Roles.Tecnicos.Equipos',
                                'Participantes'
                        ]
                    ]);


            if ($this->Expedientes->save($expediente)) {
                $this->Flash->success(__('The expediente has been saved.'));
                return $this->redirect(['action' => 'view',$expediente['id']]);
            } else {
                $this->Flash->error(__('The expediente could not be saved. Please, try again.'));
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
                if (isset($this->request->data['roles']) || isset($this->request->data['volver'])) {
                    return $this->redirect($this->referer());
                } else {
                    return $this->redirect(['action' => 'index']);
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
     * Listado de los Equipos segun el tipo que pasamos
     *
     * 
     */
        public function listadoEquipo($tipo=null)
    {
        $this->loadModel('Equipos');
        $listado = [];
        $listado = $this->Equipos->findByTipo($tipo);
        foreach ($listado as $l) {
            //debug($l);exit();
            $listado_tipo[$l->id] = $l->nombre;
        }

        return $listado_tipo;
    }

    /**
     * Listado de todos los tecnicos
     *
     * 
     */
        public function listadoTecnicos()
    {
        $this->loadModel('Tecnicos');
        $listado = [];
        $listado = $this->Tecnicos->find('all');
        foreach ($listado as $l) {
            //debug($l);exit();
            $listado_tecnicos[$l->id] = $l->nombre.' '. $l->apellidos;
        }

        return $listado_tecnicos;
    }
}
