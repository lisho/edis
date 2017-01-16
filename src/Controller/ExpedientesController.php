<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

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
        
        $expedientes = $this->Expedientes->find('all', [
            'contain' => ['Participantes'=>[
                                'conditions' => ['Participantes.relation_id'=>'1']
                ]
            ],
        ]);

/*
        $this->paginate = [
            'contain' => ['Participantes'=>[
                                'conditions' => ['Participantes.relation_id'=>'1']
                ]
            ],
        ];
        $expedientes = $this->paginate($this->Expedientes);
*/
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

        $archivos_tree=[];
        $listado_roles=[];
        $prestaciones_abiertas_rgc = [];

        $this->loadModel('Equipos');
        $listado_equipos = $this->Equipos->find('all')->toArray();

        $this->loadModel('Incidencias');
        $nueva_incidencia = $this->Incidencias->newEntity();

        $this->loadModel('Prestacions');
        $nueva_prestacion = $this->Prestacions->newEntity();

        $incidenciatipos = $this->Incidencias->Incidenciatipos->find('list', [  'keyField' => 'id',
                                                                                'valueField' => 'tipo'
                                                                                ]);
        $prestaciontipos = $this->Prestacions->Prestaciontipos->find('list', [  'keyField' => 'id',
                                                                                'valueField' => 'tipo'
                                                                                ]);
        $prestacionestados = $this->Prestacions->Prestacionestados->find('list', [  'keyField' => 'id',
                                                                                'valueField' => 'estado'
                                                                                ]);

        $expediente = $this->Expedientes->get($id, [
            'contain' => ['Participantes', 'Roles', 'Roles.Tecnicos','Roles.Tecnicos.Equipos', 'Participantes.Relations', 'Incidencias', 'Incidencias.Users', 'Incidencias.Incidenciatipos', 'Prestacions.Prestaciontipos', 'Prestacions.Prestacionestados','Prestacions.Participantes',
                'Pasacomisions.Comisions', 'Pasacomisions'=>[ 
                                                'sort'=>[
                                                    'Comisions.fecha'=> 'DESC']],
                                            'Prestacions'=>[ 
                                                'sort'=>[
                                                    'apertura'=> 'DESC']],
                                        ],
                                    ]);

        //Exytaemos los datos de los equipos y concretamos el Área de Acción Social

        $this->loadModel('Equipos');
        //$listado_equipos = $this->Equipos->find('all')->toArray();
        $datos_ceas = $this->Equipos->find('all')->Where(['id'=>$expediente->ceas])->toArray();
        $aas = $datos_ceas[0]['aas'];

        foreach ($expediente->participantes as $participante) {
            $listado_participantes[] = $participante->dni;
            $listado_nombres_parrilla[] = $participante->nombre.' '. $participante->apellidos;
        }

        //Pasamos los numeros de las prestaciones abiertas de rgc
        foreach ($expediente->prestacions as $prestacion) {
            if ($prestacion['prestaciontipo_id'] ==3 && $prestacion['prestacionestado_id'] ==5) {
                $prestaciones_abiertas_rgc[] = $prestacion->numprestacion;
            }
        }

        //Pasamos los id de los tecnicos que deberían estar asignados al expediente.

        foreach ($expediente->roles as $rol) {
            if ($rol->rol ==='CC') {
                $listado_tecnicos[$rol['tecnico']['id']] = $rol['tecnico']['nombre'].' '.$rol['tecnico']['apellidos'];
                if ($rol['tecnico']['equipo_id'] ==$expediente['ceas']) {
                    $listado_roles['CC']['correcto'][] = $rol['tecnico']['id'];
                }else{$listado_roles['CC']['incorrecto'][] = $rol['tecnico']['id'];}
                
            } elseif ($rol->rol ==='tedis'){
                $listado_tecnicos[$rol['tecnico']['id']] = $rol['tecnico']['nombre'].' '.$rol['tecnico']['apellidos'];
                if ($rol['tecnico']['equipo']['aas'] == $aas ) {
                   $listado_roles['tedis']['correcto'][] = $rol['tecnico']['id'];
                }else{ $listado_roles['tedis']['incorrecto'][] = $rol['tecnico']['id'];}
                
            }
        }

//debug ($listado_tecnicos);exit();

        //*****************************************************//
        // Creamos un array con todos los datos de las nóminas //
        // de este expediente                                  //
        //*****************************************************//


            $datos_nominas = $this->cruceNomina($expediente['numhs']);

        //*****************************************************//
        //                                                     //
        //*****************************************************//


        //Añadimos la edad al array de datos del expediente
            foreach ($expediente->participantes as $p) {
                $edad = $this->calcularEdad($p['nacimiento']);
                $p['edad'] = $edad;
            }
             
            //Si creamos un nuevo usuario en el expediente...

                if (isset($this->request->data['participantes'])) {
                    $data = $this->request->data['participantes'];
                    $this->addParticipante($data,$expediente);
                } elseif (isset($this->request->data['incidencias'])) {
                    $data = $this->request->data['incidencias'];
                    $this->addIncidencia($data,$expediente,$nueva_incidencia);
                }   elseif (isset($this->request->data['prestacions'])) {
                    $data = $this->request->data['prestacions'];
                    $this->addPrestacion($data,$expediente,$nueva_prestacion);
                }
                    
            // FIN creación de nuevo usuario/participante.

        $listado_ceas = $this->listadoEquipo('ceas');        
        $listado_relaciones = $this->listadoRelaciones();
        unset($listado_relaciones['1']); // Quitamos la opcion Titular del desplegable.
        $listado_posibles_titulares_prestacion = $this->listadoMiembrosParrilla($id);
        //$listado_prestaciones = $this->listadoTiposPrestacion();       

        //*************************************************//
        // Ceeamos el arbol de Archivos de este expediente //
        //*************************************************//
        $archivos=$this->archivosTree($expediente->numedis, $expediente->id);

        $this->set(compact('expediente', 'participante', 'listado_ceas', 'listado_relaciones', 'nueva_incidencia','incidenciatipos', 'archivos', 'nueva_prestacion', 'prestaciontipos', 'listado_posibles_titulares_prestacion', 'prestacionestados','datos_nominas','listado_participantes', 'listado_nombres_parrilla','prestaciones_abiertas_rgc', 'aas', 'listado_tecnicos', 'listado_roles'));
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

                // Carpetas del expediente ...
                if (!file_exists(WWW_ROOT . 'docs/'.$expediente->numedis)) {
                    $dir = new Folder(WWW_ROOT . 'docs/'.$expediente->numedis, true, 0755);
                    $this->Flash->success(__('Se ha creado correctamente la carpeta de documentos de este expediente.'));
                } else {
                    $this->Flash->error(__('La carpeta del expediente no se ha creado porque ya exite. Comprueba que es la correcta.'));
                }     
                

//debug($dir);exit();


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
                $this->Flash->success(__('Los cambios en el expediente se han completado correctamente.'));
                
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
     * Delete method
     *
     * @param string|null $expediente $archivo $directorio
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function deleteArchivo($archivo=null, $expediente=null, $expediente_id= null, $directorio='')
    {
       //debug($_POST);exit();
        if ($directorio==='') {
            $file = WWW_ROOT . 'docs/'.$expediente.'/'.$archivo;
        } else {
            $file = WWW_ROOT . 'docs/'.$expediente.'/'.$directorio.'/'.$archivo;
        }

        $archivo = new File($file);
       
        if ($archivo->delete()) {
            $this->Flash->success(__('El archivo se ha borrado correctamente.'));
        } else {
            $this->Flash->error(__('No se ha podido eliminar el archivo. Inténtalo de nuevo.'));
        }
        //return $this->redirect($this->referer());
        return $this->redirect(['action' => 'view', $expediente_id]);
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
    public function addParticipante($data,$expediente)
    {
        //debug($data);debug($expediente);debug($participante);exit();  

        $this->loadModel('Participantes');
        $participante = $this->Participantes->newEntity();  
                
        $data['id']='';
        $data['foto']='';
        $data['expediente_id']=$expediente['id'];
        
            if (isset($data['nacimiento']) && $data['nacimiento']!='') {
                 $cachos_fecha = preg_split("/[\/]+/", $data['nacimiento']);
                 $data['nacimiento']=array(
                                'year'=>$cachos_fecha[2],
                                'month'=>$cachos_fecha[1],
                                'day' =>$cachos_fecha[0] 
                        );
            } else {$data['nacimiento']=null;}
       
        $participante = $this->Participantes->patchEntity($participante, $data);    
        //debug($data);exit();
        if ($this->Participantes->save($participante)) {
            $this->Flash->success('Se ha añadido correctamente un nuevo miembro a la parrilla familiar del expediente'.$expediente['numedis']);
            
            return $this->redirect(['action' => 'view',$expediente['id']]);
            
        } else {
            $this->Flash->error(__('Lo siento. No ha sido posible incluir a esa persona en el sistema. Por favor revisa los datos.'));
        }

    }
    
    /**
     * AddIncidencia method
     *
     * Crea una nueva incidencia asociada a este expediente.
     *
     * Necesitamos pasarle:
     *  1. Array con los datos del expediente, al menos id y numedis
     *  2. Array con el request->data del formulario.
     *   Redirecciona a la vista del expediente.
     */
    public function addIncidencia($data,$expediente,$nueva_incidencia)
    {
        
        $cachos_fecha = preg_split("/[\/]+/", $data['fecha']);
        $data['id']='';

            if ( $data['fecha']!='') {
                 $data['fecha']=array(
                                'year'=>$cachos_fecha[2],
                                'month'=>$cachos_fecha[1],
                                'day' =>$cachos_fecha[0] 
                        );
            }
       
        $nueva_incidencia = $this->Incidencias->patchEntity($nueva_incidencia, $data);    
        //debug($nueva_incidencia);exit();
        if ($this->Incidencias->save($nueva_incidencia)) {
            $this->Flash->success('Se ha añadido correctamente una actuación a este expediente');
            
            return $this->redirect(['action' => 'view',$expediente['id']]);
            
        } else {
            $this->Flash->error(__('Lo siento. No ha sido posible registrar la actuación en el sistema. Por favor revisa los datos.'));
        }

    }

    /**
     * AddIncidencia method
     *
     * Crea una nueva incidencia asociada a este expediente.
     *
     * Necesitamos pasarle:
     *  1. Array con los datos del expediente, al menos id y numedis
     *  2. Array con el request->data del formulario.
     *   Redirecciona a la vista del expediente.
     */
    public function addPrestacion($data,$expediente,$nueva_prestacion)
    {
        
        $cachos_fecha = preg_split("/[\/]+/", $data['apertura']);
        $data['id']='';
        
        if (!isset($data['expediente_id'])) {
            $data['expediente_id']=$expediente->id;
        } 
        
            if ( $data['apertura']!='') {
                 $data['apertura']=array(
                                'year'=>$cachos_fecha[2],
                                'month'=>$cachos_fecha[1],
                                'day' =>$cachos_fecha[0] 
                        );
            }
       
        $nueva_prestacion = $this->Prestacions->patchEntity($nueva_prestacion, $data);    
        //debug($nueva_prestacion);exit();

        if ($this->Prestacions->save($nueva_prestacion)) {
            $this->Flash->success('Se ha añadido correctamente una nueva prestación a este expediente');
            
            //return $this->redirect(['action' => 'view',$expediente['id']]);
            return $this->redirect($this->referer());
            
        } else {
            $this->Flash->error(__('Lo siento. No ha sido posible crear una nueva prestación asociada a este expediente. Por favor revisa los datos.'));
        }

    }

    /**
     * AddArchivos method
     *
     * Subir un nuevo archivo asociado a este expediente.
     *
     */
    public function addArchivos($expediente=null, $directorio='')
    {
        if ($directorio!='') {$directorio='/'.$directorio;}
        
        $archivos=$this->request->data;

        if (!file_exists(WWW_ROOT . 'docs/'.$expediente.$directorio)) {
                    $dir = new Folder(WWW_ROOT . 'docs/'.$expediente.$directorio, true, 0755);
                    $this->Flash->success(__('La carpeta de documentos de este expediente no existía y se ha creado correctamente.'));
                }

        foreach ($archivos['add_files'] as $file) {
                    
                if (file_exists(WWW_ROOT . 'docs/'.$expediente.$directorio.'/'.$file['name'])) {
                   
                    $this->Flash->error(__('No es posible guardar el archivo'.$file['name'].' porque ya existe en este expediente. Cambia el nombre o borra el archivo existente antes de subir el nuevo.'));
                   

                } else {
                    
                    move_uploaded_file($file['tmp_name'], WWW_ROOT . 'docs/'.$expediente.$directorio. DS . $file['name']);
                    $this->Flash->success(__('Se ha guardado correctamente el archivo '.$file['name']));
                   
                    //debug($file).exit();   
                }           
        }
        return $this->redirect($this->referer());
        $this->autoRender = false;

    }

    /**
     * AddCarpeta method
     *
     * Añade una nueva carpeta asociada a este expediente.
     *
     */
    public function addCarpeta($expediente=null)
    {
        
        
        $nombre_carpeta = $this->request->data['nombre_carpeta'];
        //$folder = new Folder(WWW_ROOT . 'docs/'.$expediente.DS.$nombre_carpeta, true, 0755);
        $folder = new Folder();
        //debug($dir);exit();

        if (!file_exists(WWW_ROOT . 'docs/'.$expediente.DS.$nombre_carpeta)) {
                $folder->create(WWW_ROOT . 'docs/'.$expediente.DS.$nombre_carpeta);
                $this->Flash->success(__('La carpeta '.$nombre_carpeta.' no existía en este expediente y se ha creado correctamente.'));
        } else
        {
            $this->Flash->error(__('No es posible crerar la carpeta. Comprueba que no existe en este expediente o inténtalo con otro nombre.'));
        }
        return $this->redirect($this->referer());
        $this->autoRender = false;

    }

    /**
     * deleteCarpeta method
     *
     * Borra una carpeta asociada a este expediente.
     *
     */
    public function deleteCarpeta($expediente=null, $nombre_carpeta=null)
    {        
        
        //debug($expediente);exit();
        $folder = new Folder(WWW_ROOT . 'docs/'.$expediente.DS.$nombre_carpeta);
            
            if ($folder->delete()) {
                $this->Flash->success(__('La carpeta '.$nombre_carpeta.' y todos los archivos que contenía se ha borrado correctamente.'));
            }else
            {
                $this->Flash->error(__('No ha sido posible eliminar la carpeta. Por favor vuelve a intentarlo.'));
            }
        
        return $this->redirect($this->referer());
        $this->autoRender = false;

    }


     /**
     * archivosTree method
     *
     * Crea un array con los directorios y archivos que contiene la carpetacon el
     * número de expediente edis.
     *
     * Necesitamos pasarle:
     *      - Número de expediente edis.
     *   Redirecciona a la vista del expediente.
     */

    public function archivosTree($expediente=null,$expediente_id=null)
    {

        $root = WWW_ROOT . 'docs/'.$expediente.'/';
        $longitud_nombre_carpeta = strlen($root);
        $archivos_tree['/'] = [];
        $dir = new Folder($root);
        $archivos = $dir->tree($root);

        //$archivos = Folder::tree($root);
        
        foreach ($archivos[0] as $directorio) {
            $directorio = substr($directorio,$longitud_nombre_carpeta);
            if($directorio===false){$directorio='/';};
            $archivos_tree[$directorio] = [];
        }

        foreach ($archivos[1] as $archivo) {
            $file = new File($archivo);
            $file_info = $file->info();
            $change = $file->lastChange();
            $change = date('d/m/Y H:m', $change);
            $file_info['change'] = $change;
            
            $folder = substr($file_info['dirname'],$longitud_nombre_carpeta);
            if ($folder === false) {$folder = '/';}
            
            $archivos_tree[$folder][] = $file_info;

        }

        return $archivos_tree;
        $this->autoRender = false;
    }

    /**
     * Ir a Un expediente pasando el numero de historia social
     *
     */

    public function viewExpedientePorHs($hs=null)
    {

        $expediente = $this->Expedientes->find()
                                -> where(['numhs' => $hs]);

        //$expediente = $expediente -> toArray();
        $expediente = $expediente -> first();
        //debug($expediente['id']);exit();
        if (!empty($expediente)) {
            return $this->redirect(['action' => 'view',$expediente->id]);
        }
        else {
            $this->Flash->error(__('No existe este expediente. Debes crearlo antes de acceder.'));
            return $this->redirect($this->referer());

        }
       $this->autoRender = false;
    }

}
