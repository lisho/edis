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
        $datos_array_incorrectos = [];
        $keys = ['dni','sexo','nombre','apellidos','telefono','otrosdatos','numedis','observaciones','relacion','nacimiento','nacionalidad'];
        

        //verificamos que se haya enviado un post.

        if ($this->request->is('post') && $this->request->data['migrausuario']['tmp_name']!='') {
//generamos un array con las filas del archivo, pero eliminando la primera linea
            $csv = $this->request->data['migrausuario'];
            $filename = $csv['tmp_name'];
            $lineas = file($filename);
            unset($lineas[0] 
                    );
//colocamos los usuarios en un array y detectamos los errores de migracion

            foreach ($lineas as $linea_num => $linea){        
                $data = [];
                $datos = [];   

                    $datos = explode('|',$linea);
                    
                    if (count($datos)!=11) { $datos_array_incorrectos[$linea_num] = $datos;}
                    else {$datos_array[$linea_num] = $datos;} // Cargamos $datos_array con los correctos.
            }

/*****************************************************************************
**                                                                          **
** recorremos los errores detectados comenzamos a montar el array corregido **    
**                                                                          **
******************************************************************************/


            foreach ($datos_array_incorrectos as $key => $dato_incorrecto) {                
           
                if ( !isset($datos_array_corregido[$key]) && !isset($datos_array_corregido[$key-1])) {
                   $datos_array_corregido[$key]= $dato_incorrecto;
              
                   
                    if (isset($datos_array_incorrectos[$key+1])) {
                        $k = $key+1;

                        foreach ($datos_array_incorrectos[$k] as $c => $d) {
             
                            if ($c ==0){
                                $datos_array_corregido[$key][count($datos_array_corregido[$key])-1]=$datos_array_corregido[$key][count($datos_array_corregido[$key])-1].' '.$d;
                            }else{
                                $datos_array_corregido[$key][count($datos_array_corregido[$key])]=$d;
                            }
                            
                            if (count($datos_array_corregido[$key])<10) {
                                 $k = $k++;
                            }                 
                        }
                       unset($datos_array_incorrectos[$key+1]);
                    }
                }           
            }



            foreach ($datos_array_corregido as $key => $datos) {
                if (count($datos)==11) {
                    $datos_array[$key] = $datos; // Completamos $datos_array con los correctos.
                } else{
                    $datos_a_mano[$key] = $datos; // cargamos en $datos_a_mano con los que siguen incorrectos.
                }
            }

//******** FIN MOntaje de  $datos_array ***************//

/*********************************************************************************
**                                                                              **
** $datos_array, añadimos las claves, comprobamos si existe y cargamos en la BD **    
**                                                                              **
**********************************************************************************/

            foreach ($datos_array as $key => $dato_array) {

                    $data = array_combine($keys,$dato_array);

                    foreach ($data as $k => $d) { $data[$k] = trim($d);}
                    if($data['nacimiento']){$data['nacimiento'] = $this->ajustarFecha($data['nacimiento']);}else{$data['nacimiento']=null;}
                    
                    $comprueba_usuario = $this->Migrausuarios->find('all', ['conditions' => [
                                'dni' => $data['dni'],
                                'nombre' => $data['nombre'],
                                'numedis' => $data['numedis'],
                                'relacion' => $data['relacion']
                            ]
                        ]);

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

        if (isset($datos_a_mano)) {$datos_array_incorrectos = $datos_a_mano;}
        
        $this->set(compact('migrausuario', 'datos_array_incorrectos'));
        $this->set('_serialize', ['migrausuario']);
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

        $migrausuario = $this->Migrausuarios->find('all', [
            'contain' => []
        ]);

        foreach ($migrausuario as $k => $usuario) {
            
            if (!preg_match('/(([X-Z]{1})(\d{7})([A-Z]{1}))|((\d{8})([A-Z]{1}))|((\d{4})-(\d{1}))/',$usuario['dni'])) {
        
               
                if ($usuario->numedis >4999 && $usuario->numedis<5999) {
                    $posibles_arraigos[]=$usuario; //array con arraigos
                }else {
                    $dni_error[] = $usuario; //array con errores en el dni
                }  

        //Listado de errores una vez se corrijan los espacios en blanco

            $usuario['dni']=$this-> limpiarEspacios($usuario['dni']);  

            if (!preg_match('/(([X-Z]{1})(\d{7})([A-Z]{1}))|((\d{8})([A-Z]{1}))|((\d{4})-(\d{1}))/',$usuario['dni']) && !($usuario->numedis >4999 && $usuario->numedis<5999)) {
                    $dni_sinespacios[] = $usuario; //array con errores en el dni despues de eliminar los errores por espacios en blanco y los arraigos.
                }        
            }

        }

//debug($tedis);exit();

        $this->set(compact('dni_error','posibles_arraigos','dni_sinespacios'));
        $this->set('_serialize', ['dni_error','posibles_arraigos','dni_sinespacios']);
    }


    /**
     * 
     * asigna expediente_id a los usuarios
     */

    public function enlazaExpedientes()
    {
        set_time_limit(300);

        $listado_no_encontrados = []; // usuarios cuyo numedis no esta en expedientes
        $listado_emparejados = [];
        $listado_errores_save = [];
        $this->loadModel('Migraexpedientes');
        $expedientes = $this->Migraexpedientes->find('list', [
                'keyField' => 'numedis',
                'valueField' => 'id'
            ]);

        $usuarios = $this->Migrausuarios->find('all');
        $expedientes_array = $expedientes->toArray();

//debug(count($expedientes_array));exit();
//debug($expedientes->toArray());

        foreach ($usuarios as $usuario) {
            
            if (array_key_exists($usuario['numedis'],$expedientes_array)) {


                $usuario_con_numedis['migraexpedientes_id'] = $expedientes_array[$usuario->numedis];
                $usuario = $this->Migrausuarios->patchEntity($usuario, $usuario_con_numedis);

                if ($this->Migrausuarios->save($usuario)) {
                    $listado_emparejados[$usuario['numedis']] = $usuario;
                    //$contador_correctos++;
                }else{
                    $listado_errores_save[$usuario['numedis']] = $usuario;
                }

            }else{

                $listado_no_encontrados[$usuario['numedis']] = $usuario;
                //$contador_errores++;
            }
        }
        //debug($listado_no_encontrados);debug(count($listado_no_encontrados));exit();
        $this->set(compact('listado_errores_save','listado_no_encontrados'
            ,'listado_emparejados'
            ));
        $this->set('_serialize', ['listado_emparejados']);        

    }

        /**
     * 
     * Detectar errores en los expedientes
     */

    public function enlazaExpedientesView()
    {

        $this->loadModel('Migraexpedientes');
        $expedientes = $this->Migraexpedientes->find('list', [
                'keyField' => 'id',
                'valueField' => 'numedis'
            ]);
        $expedientes_array = $expedientes->toArray();
        $usuarios = $this->Migrausuarios->find('all');
        
        $this->set(compact('expedientes_array','usuarios'));
    }
}
