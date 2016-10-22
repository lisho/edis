<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Migrausuarios Controller
 *
 * @property \App\Model\Table\MigrausuariosTable $Migrausuarios
 */
class MigrausuariosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $migrausuarios = $this->paginate($this->Migrausuarios);

        $this->set(compact('migrausuarios'));
        $this->set('_serialize', ['migrausuarios']);
    }

    /**
     * View method
     *
     * @param string|null $id Migrausuario id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $migrausuario = $this->Migrausuarios->get($id, [
            'contain' => []
        ]);

        $this->set('migrausuario', $migrausuario);
        $this->set('_serialize', ['migrausuario']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        $migrausuario = $this->Migrausuarios->newEntity();
        $cuenta_migrausuarios=0;
        $cuenta_fallos=0;
        $lineas  = [];
        $keys = ['dni','sexo','nombre','apellidos','telefono','otrosdatos','numedis','observaciones','relacion','nacimiento','nacionalidad'];
        

        //verificamos que se haya enviado un post.

        if ($this->request->is('post') && $this->request->data['migrausuario']['tmp_name']!='') {

            $csv = $this->request->data['migrausuario'];
            $filename = $csv['tmp_name'];
            $lineas = file($filename);
            unset($lineas[0] 
                    );
//colocamos los usuarios en un array

             foreach ($lineas as $linea_num => $linea){        
                $datos = []; 
                $datos = explode('|',$linea);

                //debug($linea);debug($datos);debug(count($datos));
                //if(count($datos)!=11){exit();}
                $datos_array[$linea_num] = $datos;
                if (count($datos)!=11) { $datos_array_incorrectos[$linea_num] = $datos;}
                //if (count($datos)==3) { $datos_array[$linea_num-1] = $datos;echo $linea_num;}

             }
        echo count($datos_array_incorrectos);
        debug($datos_array_incorrectos);exit();








exit();



            foreach ($lineas as $linea_num => $linea){        
                $data = [];
                $datos = [];   

                    $datos = explode('|',$linea);
//debug(count($datos));exit();
                    if (count($datos)!=11) {debug($linea);debug($datos);}

        //debug($datos);exit();
                    $data = array_combine($keys,$datos);

                    foreach ($data as $k => $d) { $data[$k] = trim($d);}
                    if($data['nacimiento']){$data['nacimiento'] = $this->ajustarFecha($data['nacimiento']);}else{$data['nacimiento']=null;}
                    
                    $comprueba_usuario = $this->Migrausuarios->find('all', ['conditions' => [
                                'dni' => $data['dni'],
                                'nombre' => $data['nombre'],
                                'numedis' => $data['numedis'],
                                'relacion' => $data['relacion']
                            ]
                        ]);
//debug($linea_num);exit();
                    if (empty($comprueba_usuario->toArray())) {
                        $n = $this->Migrausuarios->newEntity();
                        $n = $this->Migrausuarios->patchEntity($n, $data);

                        if ($this->Migrausuarios->save($n)) {
                            $cuenta_migrausuarios++;

                        } else {
                            //$this->Flash->error(__('The migrausuario could not be saved. Please, try again.'));
                            $this->Flash->error('Error al cargar la migrausuario:'.$linea_num);
                        }
                    } else {
                        $cuenta_fallos++;
                        
                    }  
            } 
                   
            $this->Flash->success(__('Se han cargado correctamente '.$cuenta_migrausuarios.' usuarios'));
            $this->Flash->error(__('No ha sido posible cargar '.$cuenta_fallos.' nominas porque ya existen en el sistema'));
        }
        
        $this->set(compact('migrausuario'));
        $this->set('_serialize', ['migrausuario']);
    
















/*
        $migrausuario = $this->Migrausuarios->newEntity();
        if ($this->request->is('post')) {
            $migrausuario = $this->Migrausuarios->patchEntity($migrausuario, $this->request->data);
            if ($this->Migrausuarios->save($migrausuario)) {
                $this->Flash->success(__('The migrausuario has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The migrausuario could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('migrausuario'));
        $this->set('_serialize', ['migrausuario']);
*/
    }

    /**
     * Edit method
     *
     * @param string|null $id Migrausuario id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $migrausuario = $this->Migrausuarios->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $migrausuario = $this->Migrausuarios->patchEntity($migrausuario, $this->request->data);
            if ($this->Migrausuarios->save($migrausuario)) {
                $this->Flash->success(__('The migrausuario has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The migrausuario could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('migrausuario'));
        $this->set('_serialize', ['migrausuario']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Migrausuario id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $migrausuario = $this->Migrausuarios->get($id);
        if ($this->Migrausuarios->delete($migrausuario)) {
            $this->Flash->success(__('The migrausuario has been deleted.'));
        } else {
            $this->Flash->error(__('The migrausuario could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    /**
     * 
     * Detectar errores en los expedientes
     */

    public function errores()
    {
        $tedis = [];

        $migraexpediente = $this->Migraexpedientes->find('all', [
            'contain' => []
        ]);

        //$m_e = $migraexpediente->toArray();

        foreach ($migraexpediente as $k => $expediente) {
            
            if (!preg_match('/[0-9]{4}/',$expediente['numedis'])) {
        
               $numedis_error[] = $expediente;        
            }

            if (!isset($tedis[$expediente['tedis']])) {
                $tedis[$expediente['tedis']]['val']=0;
            }
            $tedis[$expediente['tedis']]['val']++;
        }

    
//debug($tedis);exit();

        $this->set(compact('numedis_error','tedis'));
        $this->set('_serialize', ['migraexpediente']);
    }
}
