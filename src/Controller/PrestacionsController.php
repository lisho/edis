<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Prestacions Controller
 *
 * @property \App\Model\Table\PrestacionsTable $Prestacions
 */
class PrestacionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Prestaciontipos', 'Expedientes', 'Participantes', 'Prestacionestados']
        ];
        $prestacions = $this->paginate($this->Prestacions);

        $this->set(compact('prestacions'));
        $this->set('_serialize', ['prestacions']);
    }

    /**
     * View method
     *
     * @param string|null $id Prestacion id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $prestacion = $this->Prestacions->get($id, [
            'contain' => ['Prestaciontipos', 'Expedientes', 'Participantes', 'Prestacionestados']
        ]);

        $this->set('prestacion', $prestacion);
        $this->set('_serialize', ['prestacion']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $prestacion = $this->Prestacions->newEntity();
        if ($this->request->is('post')) {

            $prestaciones_existentes = $this->Prestacions->findByExpediente_id($this->requiest->data->expediente_id);
debug($prestaciones_existentes);exit();
            $prestacion = $this->Prestacions->patchEntity($prestacion, $this->request->data);
            if ($this->Prestacions->save($prestacion)) {
                $this->Flash->success(__('The prestacion has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The prestacion could not be saved. Please, try again.'));
            }
        }
        $prestaciontipos = $this->Prestacions->Prestaciontipos->find('list', ['limit' => 200]);
        $expedientes = $this->Prestacions->Expedientes->find('list', ['limit' => 200]);
        $participantes = $this->Prestacions->Participantes->find('list', ['limit' => 200]);
        $prestacionestados = $this->Prestacions->Prestacionestados->find('list', ['limit' => 200]);
        $this->set(compact('prestacion', 'prestaciontipos', 'expedientes', 'participantes', 'prestacionestados'));
        $this->set('_serialize', ['prestacion']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Prestacion id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {

        $prestaciontipos = $this->Prestacions->Prestaciontipos->find('list', [  'keyField' => 'id',
                                                                                'valueField' => 'tipo'
                                                                                ]);
        $prestacionestados = $this->Prestacions->Prestacionestados->find('list', [  'keyField' => 'id',
                                                                                'valueField' => 'estado'
                                                                                ]);

        $prestacion = $this->Prestacions->get($id, [
            'contain' => ['Prestaciontipos', 'Expedientes', 'Participantes', 'Prestacionestados']
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

                $data = $this->request->data;

                if ( $data['apertura']!='') {
                    $cachos_fecha_apertura = preg_split("/[\/]+/", $data['apertura']);
                     $data['apertura']=array(
                                    'year'=>$cachos_fecha_apertura[2],
                                    'month'=>$cachos_fecha_apertura[1],
                                    'day' =>$cachos_fecha_apertura[0] 
                            );
                }
                if ( $data['cierre']!='') {
                    $cachos_fecha_cierre = preg_split("/[\/]+/", $data['cierre']);
                     $data['cierre']=array(
                                    'year'=>$cachos_fecha_cierre[2],
                                    'month'=>$cachos_fecha_cierre[1],
                                    'day' =>$cachos_fecha_cierre[0] 
                            );
                } else { $data['cierre']=null;}
//debug($data);exit();
            $prestacion = $this->Prestacions->patchEntity($prestacion, $data);
            if ($this->Prestacions->save($prestacion)) {
                $this->Flash->success(__('Los cambios en la prestación se han guardado correctamente.'));

                return $this->redirect(['controller'=>'Expedientes', 'action' => 'view', $data['expediente_id']]);
            } else {
                $this->Flash->error(__('No ha sido posible guardar los cambios. Por favor inténtalo de nuevo.'));
            }
        }
        
        $participantes = $this->listadoMiembrosParrilla($prestacion->expediente_id);
        
        $this->set(compact('prestacion', 'participantes', 'prestaciontipos', 'expedientes','prestacionestados'));
        $this->set('_serialize', ['prestacion']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Prestacion id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $prestacion = $this->Prestacions->get($id);
        if ($this->Prestacions->delete($prestacion)) {
            $this->Flash->success(__('The prestacion has been deleted.'));
        } else {
            $this->Flash->error(__('The prestacion could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function cerrarPrestacion($id=null, $mensaje=null)
    {
        $data = [];
        $prestacion = $this->Prestacions->get($id);

        $data['cierre'] = $this->ajustarFecha(date('d/m/Y'));
        $data['prestacionestado_id'] = 6;
        $data['observaciones'] = $mensaje;
//debug($data);exit();
        if ($this->request->is(['patch', 'post', 'put'])) {

            $prestacion = $this->Prestacions->patchEntity($prestacion, $data);
            if ($this->Prestacions->save($prestacion)) {
                $this->Flash->success(__('Has cerrado la prestación.'));

            } else {
                $this->Flash->error(__('No ha sido posible cerrar la prestación. Inténtalo de nuevo.'));
            }
        }

        return $this->redirect($this->referer());
        $this->autoRender = false;

    }
}
