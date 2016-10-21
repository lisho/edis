<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Migraexpedientes Controller
 *
 * @property \App\Model\Table\MigraexpedientesTable $Migraexpedientes
 */
class MigraexpedientesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $migraexpedientes = $this->paginate($this->Migraexpedientes);



        $this->set(compact('migraexpedientes'));
        $this->set('_serialize', ['migraexpedientes']);
    }

    /**
     * View method
     *
     * @param string|null $id Migraexpediente id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $migraexpediente = $this->Migraexpedientes->get($id, [
            'contain' => []
        ]);

        $this->set('migraexpediente', $migraexpediente);
        $this->set('_serialize', ['migraexpediente']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        $migraexpediente = $this->Migraexpedientes->newEntity();
        $cuenta_migraexpedientes=0;
        $cuenta_fallos=0;
        $lineas  = [];
        $keys = ['rgc','numedis','tedis','cc','ceas','alta','baja','domicilio'];
        

        //verificamos que se haya enviado un post.

        if ($this->request->is('post') && $this->request->data['migraexpediente']['tmp_name']!='') {

            $csv = $this->request->data['migraexpediente'];
            $filename = $csv['tmp_name'];
            $lineas = file($filename);
            unset($lineas[0] 
                    //,$lineas[1], 
                    //$lineas[2]
                    );



            foreach ($lineas as $linea_num => $linea){        
                $data = [];
                $datos = [];   

                    $datos = explode(';',$linea);
                    $data = array_combine($keys,$datos);

                    foreach ($data as $k => $d) { $data[$k] = trim($d);}
                    if($data['alta']){$data['alta'] = $this->ajustarFecha($data['alta']);}else{$data['alta']=null;}
                    if($data['baja']){$data['baja'] = $this->ajustarFecha($data['baja']);}else{$data['baja']=null;}
                    $comprueba_expediente = $this->Migraexpedientes->find('all', ['conditions' => [
                                'numedis' => $data['numedis'],
                                //'nombrecompleto' => $data['nombrecompleto'],
                                //'dni' => $data['dni'],
                                //'relacion' => $data['relacion']
                            ]
                        ]);
//debug($linea_num);exit();
                    if (empty($comprueba_expediente->toArray())) {
                        $n = $this->Migraexpedientes->newEntity();
                        $n = $this->Migraexpedientes->patchEntity($n, $data);

                        if ($this->Migraexpedientes->save($n)) {
                            $cuenta_migraexpedientes++;

                        } else {
                            //$this->Flash->error(__('The migraexpediente could not be saved. Please, try again.'));
                            $this->Flash->error('Error al cargar la migraexpediente:'.$linea_num);
                        }
                    } else {
                        $cuenta_fallos++;
                        
                    }  
            } 
                   
            $this->Flash->success(__('Se han cargado correctamente '.$cuenta_migraexpedientes.' expedientes'));
            $this->Flash->error(__('No ha sido posible cargar '.$cuenta_fallos.' nominas porque ya existen en el sistema'));
        }
        
        $this->set(compact('migraexpediente'));
        $this->set('_serialize', ['migraexpediente']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Migraexpediente id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $migraexpediente = $this->Migraexpedientes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $migraexpediente = $this->Migraexpedientes->patchEntity($migraexpediente, $this->request->data);
            if ($this->Migraexpedientes->save($migraexpediente)) {
                $this->Flash->success(__('The migraexpediente has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The migraexpediente could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('migraexpediente'));
        $this->set('_serialize', ['migraexpediente']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Migraexpediente id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $migraexpediente = $this->Migraexpedientes->get($id);
        if ($this->Migraexpedientes->delete($migraexpediente)) {
            $this->Flash->success(__('The migraexpediente has been deleted.'));
        } else {
            $this->Flash->error(__('The migraexpediente could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * 
     * Detectar errores en los expedientes
     */

    public function errores()
    {
        $migraexpediente = $this->Migraexpedientes->find('all', [
            'contain' => []
        ]);

        //$m_e = $migraexpediente->toArray();

        foreach ($migraexpediente as $k => $expediente) {
            
            if (preg_match('/^(\d{4})$/i',$expediente['numedis'])) {
               $numedis_error[]= $expediente['numedis'].' - '.$expediente['tedis'];
            }
        }

debug($numedis_error);exit();

        $this->set(compact('migraexpediente','numedis_error'));
        $this->set('_serialize', ['migraexpediente']);
    }
}
