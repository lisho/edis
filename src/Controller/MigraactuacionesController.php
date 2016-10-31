<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Migraactuaciones Controller
 *
 * @property \App\Model\Table\MigraactuacionesTable $Migraactuaciones
 */
class MigraactuacionesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $migraactuaciones = $this->paginate($this->Migraactuaciones);

        $this->set(compact('migraactuaciones'));
        $this->set('_serialize', ['migraactuaciones']);
    }

    /**
     * View method
     *
     * @param string|null $id Migraactuacione id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $migraactuacione = $this->Migraactuaciones->get($id, [
            'contain' => []
        ]);

        $this->set('migraactuacione', $migraactuacione);
        $this->set('_serialize', ['migraactuacione']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        set_time_limit(600);

        $migraactuacion = $this->Migraactuaciones->newEntity();
        $cuenta_migraactuaciones=0;
        $cuenta_fallos=0;
        $nueva_linea = true;
        $lineas  = [];
        $o =0;
        $l=0; 
        $datos_ordenados = [];
        $keys = ["antiguo","fecha","descripcion","numedis","actuacion"];
        

        //verificamos que se haya enviado un post.

        if ($this->request->is('post') && $this->request->data['migraactuacion']['tmp_name']!='') {

            $csv = $this->request->data['migraactuacion'];
            $filename = $csv['tmp_name'];
            $lineas = file($filename);
            unset($lineas[0] 
                    );

            foreach ($lineas as $linea_num => $linea){        
                $data = [];
                $datos = [];  

                $datos = explode('|',$linea);
                $d = count($datos);

                if ($d==5) {
                    
                    $datos_ordenados[$l]=$datos;   
                    $l++;                 
                    $nueva_linea = true;
                } else {
                    
                    if ($nueva_linea==true) {
                        $datos_ordenados[$l]=$datos;
                        $nueva_linea = false;
                    }else{
                        
                        $o = count($datos_ordenados[$l])-1;

                        if (count($datos)==1) {
                           $datos_ordenados[$l][$o] = $datos_ordenados[$l][$o].' '.$datos[0];
                        } else {

                            foreach ($datos as $k=>$dato) {  
                                
                                if ($k==0) {
                                    $datos_ordenados[$l][$o] = $datos_ordenados[$l][$o].' '.$dato;
                                }  else {
                                    $datos_ordenados[$l][$o] = $dato;
                                }
                                
                                if (count($datos_ordenados[$l])==5) {
                                    $nueva_linea = true; $l++; 
                                }
                                $o++;           
                            }  
                        }                       
                        
                    }
                }
            }        

            foreach ($datos_ordenados as $datos) {
 
                    $data = array_combine($keys,$datos);

                    foreach ($data as $k => $d) { $data[$k] = trim($d);}
                    if($data['fecha']){$data['fecha'] = $this->ajustarFecha($data['fecha']);}else{$data['fecha']=null;}
                  
                    $comprueba_actuacion = $this->Migraactuaciones->find('all', ['conditions' => [
                                'numedis' => $data['numedis'],
                                'antiguo' => $data['antiguo'],
                                //'actuacion' => $data['actuacion'],
                                //'relacion' => $data['relacion']
                            ]
                        ]);

                    if (empty($comprueba_actuacion->toArray())) {

                        $n = $this->Migraactuaciones->newEntity();
                        $n = $this->Migraactuaciones->patchEntity($n, $data);

                        if ($this->Migraactuaciones->save($n)) {
                            $cuenta_migraactuaciones++;
                            echo "cargado... ";
                        } else {
                            //$this->Flash->error(__('The migraactuacion could not be saved. Please, try again.'));
                            $this->Flash->error('Error al cargar la migraactuacion:'.$linea_num);
                            echo "ERROR al Gravar";
                        }
                    } else {
                        $cuenta_fallos++;
                    }                     
            } 
                   
            $this->Flash->success(__('Se han cargado correctamente '.$cuenta_migraactuaciones.' actuaciones'));
            $this->Flash->error(__('No ha sido posible cargar '.$cuenta_fallos.' nominas porque ya existen en el sistema'));
        }    
        $this->set(compact('migraactuacion'));
        $this->set('_serialize', ['migraactuacion']);

    }

    /**
     * Edit method
     *
     * @param string|null $id Migraactuacione id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $migraactuacione = $this->Migraactuaciones->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $migraactuacione = $this->Migraactuaciones->patchEntity($migraactuacione, $this->request->data);
            if ($this->Migraactuaciones->save($migraactuacione)) {
                $this->Flash->success(__('The migraactuacione has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The migraactuacione could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('migraactuacione'));
        $this->set('_serialize', ['migraactuacione']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Migraactuacione id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $migraactuacione = $this->Migraactuaciones->get($id);
        if ($this->Migraactuaciones->delete($migraactuacione)) {
            $this->Flash->success(__('The migraactuacione has been deleted.'));
        } else {
            $this->Flash->error(__('The migraactuacione could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

        /**
     * 
     * asigna expediente_id a los actuaciones
     */

    public function enlazaExpedientes()
    {
        set_time_limit(300);

        $listado_no_encontrados = []; // actuaciones cuyo numedis no esta en expedientes
        $listado_emparejados = [];
        $listado_errores_save = [];
        $this->loadModel('Migraexpedientes');
        $expedientes = $this->Migraexpedientes->find('list', [
                'keyField' => 'numedis',
                'valueField' => 'id'
            ]);

        $actuaciones = $this->Migraactuaciones->find('all');
        $expedientes_array = $expedientes->toArray();

//debug(count($expedientes_array));exit();
//debug($expedientes->toArray());

        foreach ($actuaciones as $actuacion) {
            
            if (array_key_exists($actuacion['numedis'],$expedientes_array)) {


                $actuacion_con_numedis['migraexpedientes_id'] = $expedientes_array[$actuacion->numedis];
                $actuacion = $this->Migraactuaciones->patchEntity($actuacion, $actuacion_con_numedis);
                //$listado_emparejados[$actuacion['numedis']] = $actuacion;
              
                if ($this->Migraactuaciones->save($actuacion)) {
                    $listado_emparejados[$actuacion['numedis']] = $actuacion;
                    //$contador_correctos++;
                }else{
                    $listado_errores_save[$actuacion['numedis']] = $actuacion;
                }

            }else{

                $listado_no_encontrados[$actuacion['numedis']] = $actuacion;
                //$contador_errores++;
            }
        }
        //debug($listado_no_encontrados);debug(count($listado_no_encontrados));exit();
        $this->set(compact('listado_errores_save','listado_no_encontrados'
            ,'listado_emparejados'
            ));
        $this->set('_serialize', ['listado_emparejados']);        

    }

    public function enlazaExpedientesView()
    {

        $this->loadModel('Migraexpedientes');
        $expedientes = $this->Migraexpedientes->find('list', [
                'keyField' => 'id',
                'valueField' => 'numedis'
            ]);
        $expedientes_array = $expedientes->toArray();
        $actuaciones = $this->Migraactuaciones->find('all');
        
        $this->set(compact('expedientes_array','actuaciones'
            
            ));
        

    }
}
