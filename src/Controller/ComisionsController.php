<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Comisions Controller
 *
 * @property \App\Model\Table\ComisionsTable $Comisions
 */
class ComisionsController extends AppController{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'order'=>['fecha'=>'DESC']
        ];
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
        /*
        ** Variables iniciales
        */

        $listado_ceas = $this->listadoEquipo('CEAS');
        $secretario=[];
        $posibles_secretarios=[];

        /*
        ** Variables para NUEVAS ENTIDADES
        */

        $this->loadModel('Prestacions');      
        $nueva_prestacion = $this->Prestacions->newEntity(); // Crear nueva prestación

        $this->loadModel('Pasacomisions');      
        $nuevo_pasacomision = $this->Pasacomisions->newEntity(); // Crear nuevo paso por prestación
        
        /*
        ** Redirigimos las entradas POST de la CREACIÓN de elementos
        */

        if ($this->request->is('post')) {
                    if (isset($this->request->data['prestacions'])) {
                        $data = $this->request->data['prestacions'];
                        $this->addPrestacion($data,$data['expediente_id'],$nueva_prestacion);
                    }
                    elseif (isset($this->request->data['pasacomision'])) {
                        $data = $this->request->data['pasacomision'];
                        $this->addPasacomision($data, $id, $nuevo_pasacomision);
                    } 
                    
                }

        /*
        ** Datos de la comisión
        */

        $comision = $this->Comisions->get($id, [
            'contain' => ['Asistentecomisions', 'Pasacomisions', 'Asistentecomisions.Tecnicos.Equipos', 'Pasacomisions.Expedientes','Pasacomisions.Expedientes.Participantes', 'Pasacomisions.Expedientes.Prestacions', 'Pasacomisions.Expedientes.Prestacions.Prestaciontipos', 'Pasacomisions.Expedientes.Prestacions.Prestacionestados', 'Pasacomisions.Expedientes.Prestacions.Participantes']
        ]);

        /*
        ** Pasamos los posibles Estados de la comisión (hemos cargado el modelo al principio)
        */

        $estados_comision = $this->Prestacions->Prestacionestados->find('list', [   'keyField' => 'id',
                                                                                    'valueField' => 'estado']
                                                                                );
        $estados_comision = $estados_comision->toArray();
//debug($estados_comision->toArray());exit();

        /*
        ** Armamos los Arrais secretario y posibles_secretarios
        */

        foreach ($comision->asistentecomisions as $asistente) {
            $asistentes[]=$asistente->tecnico_id; 
            if ($asistente->tecnico->equipo->tipo === "EDIS" && $asistente->rol ==="asistente") {
                $posibles_secretarios[$asistente->id]=$asistente->tecnico->nombre.' '.$asistente->tecnico->apellidos;
            }
            if ($asistente->rol ==="secretario") {
                    $secretario[$asistente->id]=$asistente->tecnico->nombre.' '.$asistente->tecnico->apellidos;
                }                           
        }

        /*
        ** Ordenamos los Pasos por comisión agrupados por CEAS
        */

        foreach ($comision->pasacomisions as $exp) {
            $expedientes_ordenados[$exp->expediente->ceas][]=$exp;  
            $listado_posibles_titulares_prestacion [$exp->expediente->id]= $this->listadoMiembrosParrilla($exp->expediente->id);
        }

        /*
        ** Armamos un array con los posibles asistentes a la comisión
        */

        $this->loadModel('Tecnicos');
        $tecnicos = $this->Tecnicos->find('all', ['contain' => ['Asistentecomisions', 'Equipos'],
                                                    ]);

        //$listado_posibles_titulares_prestacion = $this->listadoMiembrosParrilla($id);  
              
        $this->set(compact('comision', 'tecnicos', 'asistentes', 'listado_ceas', 'nuevo_pasacomision', 'posibles_secretarios','secretario', 'expedientes_ordenados', 'el_asistente', 'nueva_prestacion', 'listado_posibles_titulares_prestacion', 'estados_comision'));
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
            $this->Flash->success(__('La comisión ha sido eliminada.'));
        } else {
            $this->Flash->error(__('No se ha podido eliminar la comisión. Por favor inténtalo de nuevo.'));
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

    /************************************************************
    **
    ** ACIONES CON ACTAS
    **
    *************************************************************/

    public function acta($id=null, $validar=null)
    {
        
        $listado_ceas = $this->listadoEquipo('CEAS');
        $secretario='';
        $posibles_secretarios=[];
        $this->loadModel('Pasacomisions');      
        $nuevo_pasacomision = $this->Pasacomisions->newEntity();
        
        $comision = $this->Comisions->get($id, [
            'contain' => ['Asistentecomisions', 'Pasacomisions', 'Asistentecomisions.Tecnicos.Equipos', 'Pasacomisions.Expedientes','Pasacomisions.Expedientes.Participantes', 'Pasacomisions.Expedientes.Prestacions', 'Pasacomisions.Expedientes.Prestacions.Prestaciontipos', 'Pasacomisions.Expedientes.Prestacions.Prestacionestados', 'Pasacomisions.Expedientes.Prestacions.Participantes']
        ]);

        foreach ($comision->asistentecomisions as $asistente) {
            $asistentes[]=$asistente->tecnico_id; 
            if ($asistente->tecnico->equipo->tipo === "EDIS" && $asistente->rol ==="asistente") {
                $posibles_secretarios[$asistente->id]=$asistente->tecnico->nombre.' '.$asistente->tecnico->apellidos;
            }
            if ($asistente->rol ==="secretario") {
                    $secretario[$asistente->id]=$asistente->tecnico->nombre.' '.$asistente->tecnico->apellidos;
                    $el_secretario= $asistente->tecnico;
                }                           
        }

        // Ordenamos los Pasos por comisión por CEAS

        foreach ($comision->pasacomisions as $exp) {
            $expedientes_ordenados[$exp->expediente->ceas][]=$exp;  
        }

        $this->loadModel('Tecnicos');
        $tecnicos = $this->Tecnicos->find('all', ['contain' => ['Asistentecomisions', 'Equipos'],
                                                    ]);

        if ($this->request->is('post')) {
                    $data = $this->request->data['pasacomision'];
                    $this->addPasacomision($data, $id, $nuevo_pasacomision);
                }
        /**
         * Creamos el PDF
         */

        $this->viewBuilder()->options([
                'pdfConfig' => [
                    'orientation' => 'portrait',
                    'filename' => 'acta_'.$id.'pdf'
                ]
            ]);

        //$this->file_put_contents(WWW_ROOT . "docs/archivo.pdf", $acta_completa);

        $logo= IMAGES."logo_concejalia.png";
        //$acta_completa = $file = new File(APP_DIR.'/Template/Comisions/pdf/acta.ctp');
        
//debug($comision);exit();
        $datos_acta = $this->set(compact('comision', 'tecnicos', 'asistentes', 'listado_ceas', 'nuevo_pasacomision', 'posibles_secretarios','secretario', 'expedientes_ordenados', 'logo', 'el_secretario'));
        if ($validar=="validar") {
            return $datos_acta;
        }

        $this->set('_serialize', ['comision']);
    }



    public function valida($id=null)
    {

            $CakePdf = new \CakePdf\Pdf\CakePdf();
            $CakePdf->templatePath('Comisions/pdf');
            $CakePdf->template('acta', 'default');
            $CakePdf->viewVars($this->acta($id,"validar")->viewVars);
            //debug($this->acta($id,"validar")->viewVars['comision']['fecha']->i18nFormat("dd-MM-yyyy"));exit();
            // Get the PDF string returned
            //$pdf = $CakePdf->output();
            // Or write it to file directly
            $fecha_acta = $this->acta($id,"validar")->viewVars['comision']['fecha']->i18nFormat("dd-MM-yyyy");
            //ebug($fecha_acta);exit();

            $nombre_archivo = $this->acta($id,"validar")->viewVars['comision']['tipo']."_".$fecha_acta;
            $pdf = $CakePdf->write(DOCS.'actas' . DS . $nombre_archivo.'.pdf');
            
            return $this->redirect($this->referer());
            $this->autoRender = false;
    }

}
