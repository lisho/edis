<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Nominas Controller
 *
 * @property \App\Model\Table\NominasTable $Nominas
 */
class NominasController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $nominas = $this->paginate($this->Nominas);

        $this->set(compact('nominas'));
        $this->set('_serialize', ['nominas']);
    }

    /**
     * View method
     *
     * @param string|null $id Nomina id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        $nomina = [];
        $posibles_nominas = $this->posiblesNominas();
//debug($this->request);exit();

        if ($this->request->is('post')) {

            $n = $this->request->data['n'];        
            $mes = $posibles_nominas[$n][0];
            $ano = $posibles_nominas[$n][1];

            if ($mes!=null && $año=!null) {
                $nomina = $this->generarNomina($mes, $ano);
            }
        }
        //debug($nomina);exit();
        $this->set(compact('posibles_nominas', 'nomina'));
        $this->set('_serialize', ['nomina']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $nomina = $this->Nominas->newEntity();
        $cuenta_nominas=0;
        $cuenta_fallos=0;
        $lineas  = [];
        $keys = ['CCLL','CEAS','HS','RGC','CLASIFICACION','MIEMBROS','dni','nombrecompleto','SEXO','EDAD','NACIONALIDAD','DOMICILIO','fechatramite','RESOLUCION','fechaefectos','relacion','fechanomina'];
        
        //verificamos que se haya enviado un post.

        if ($this->request->is('post') && $this->request->data['nomina']['tmp_name']!='') {

            $csv = $this->request->data['nomina'];
            $filename = $csv['tmp_name'];
            $lineas = file($filename);
            unset($lineas[0], $lineas[1], $lineas[2]);

            foreach ($lineas as $linea_num => $linea){        
                $data = [];
                $datos = [];   

                    $datos = explode(';',$linea);
                    $data = array_combine($keys,$datos);

                    foreach ($data as $k => $d) { $data[$k] = trim($d);}
                    $data['fechatramite'] = $this->ajustarFecha($data['fechatramite']);
                    $data['fechaefectos'] = $this->ajustarFecha($data['fechaefectos']);  
                    $comprueba_nomina = $this->Nominas->find('all', ['conditions' => [
                                'fechanomina' => $data['fechanomina'],
                                'nombrecompleto' => $data['nombrecompleto'],
                                'dni' => $data['dni'],
                                'HS' => $data['HS']
                                //'relacion' => $data['relacion']
                            ]
                        ]);

                    if (empty($comprueba_nomina->toArray())) {
                        $n = $this->Nominas->newEntity();
                        $n = $this->Nominas->patchEntity($n, $data);

                        if ($this->Nominas->save($n)) {
                            $cuenta_nominas++;

                        } else {
                            $this->Flash->error(__('The nomina could not be saved. Please, try again.'));
                        }
                    } else {
                        $cuenta_fallos++;
                        $this->Flash->error('Error al cargar la nomina:'.$linea);
                    }  
            } 
                   
            $this->Flash->success(__('Se han cargado correctamente '.$cuenta_nominas.' nominas'));
            $this->Flash->error(__('No ha sido posible cargar '.$cuenta_fallos.' nominas porque ya existen en el sistema'));
        }
        
        $this->set(compact('nomina', 'lista_nominas'));
        $this->set('_serialize', ['nomina']);

    }

    /**
     * Edit method
     *
     * @param string|null $id Nomina id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $nomina = $this->Nominas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $nomina = $this->Nominas->patchEntity($nomina, $this->request->data);
            if ($this->Nominas->save($nomina)) {
                $this->Flash->success(__('The nomina has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The nomina could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('nomina'));
        $this->set('_serialize', ['nomina']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Nomina id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $nomina = $this->Nominas->get($id);
        if ($this->Nominas->delete($nomina)) {
            $this->Flash->success(__('The nomina has been deleted.'));
        } else {
            $this->Flash->error(__('The nomina could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


     /**
     * Posibles nóminas
     *
     * @return array las posibles nóminas que se han cargado
     * 
     */

    public function posiblesNominas()
    {
        $lista_nominas = $this->Nominas->find()
            -> select(['fechanomina']);
        $lista_nominas = array_unique( $lista_nominas->toArray());

        foreach ($lista_nominas  as $nomina) {
            $n = explode(" ", $nomina['fechanomina']);
            $n = $this->eliminarValoresArray($n,["",'de']);
            $nominas['opciones'][] = $n[0].' de '.$n[1];
            $nominas[] = $n;
        }

        return $nominas;
       
    }

    /**
     * Compara la última nómina con la penúltima
     *
     * @param none
     * @return array
     * 
     */

    public function comparaNominas()
    {
        $c = 1; // Contador para restar meses buscando la ultima nómina.
        $mes = array("enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");
        $fecha_actual = getdate();
        $cambios=[];
        $this->loadModel('Expedientes');
        $this->loadModel('Participantes');

        $mes_revisar = $fecha_actual['mon'];
        $year_revisar = $fecha_actual['year'];


    /******************** Generamos al última y la penúltima nómina *******************/

        while (empty($ultima_nomina)) {

            if ($mes_revisar==2) { // corregimos los cambios de año si estamos en febrero
                
                $ultima_nomina = $this->generarNomina($mes[0], $year_revisar);                      
                $mes_revisar=12;
                $year_revisar--;
            }
            elseif ($mes_revisar==1) {  // corregimos los cambios de año si estamos en enero
                
                $ultima_nomina = $this->generarNomina($mes[11], $year_revisar);
                $mes_revisar=11;
                
            }
            else {
                
                $ultima_nomina = $this->generarNomina($mes[$mes_revisar--], $year_revisar);                
                //$mes_revisar--;
            }

        }
             $penultima_nomina = $this->generarNomina($mes[$mes_revisar-1], $year_revisar);  

         
    /********************* Ordenamos los datos para comparar las 2 nóminas ************************/
            
        // Fechas de las nominas

            $datos_penultima_nomina['nomina']= $penultima_nomina[0]['fechanomina'];
            $datos_ultima_nomina['nomina']= $ultima_nomina[0]['fechanomina'];

        //Datos de la Pénúltima nómina

        foreach ($penultima_nomina as $penultima) {

            $rgc = $penultima['RGC'];

            $datos_penultima_nomina['expedientes'][$rgc]['miembros'][]= $penultima['dni'];
            if ($penultima['relacion'] == 'TITULAR') {
            //   $datos_penultima_nomina[$penultima[$rgc]]['HS'] = $penultima['HS'];
                $datos_penultima_nomina['expedientes'][$rgc]['hs'] = $penultima['HS'];
                $datos_penultima_nomina['expedientes'][$rgc]['domicilio'] = $penultima['DOMICILIO'];
                $datos_penultima_nomina['expedientes'][$rgc]['ceas'] = $penultima['CEAS'];
                $datos_penultima_nomina['expedientes'][$rgc]['titular']['dni'] = $penultima['dni'];
                $datos_penultima_nomina['expedientes'][$rgc]['titular']['nombre'] = $penultima['nombrecompleto'];
                $datos_penultima_nomina['expedientes'][$rgc]['clasificacion'] = $penultima['CLASIFICACION'];
            }
        }

        //Datos de la Última nómina

        foreach ($ultima_nomina as $ultima) {

            $rgc = $ultima['RGC'];

            $datos_ultima_nomina['expedientes'][$rgc]['miembros'][]= $ultima['dni'];

            if ($ultima['relacion'] == 'TITULAR') {
               $datos_ultima_nomina['expedientes'][$rgc]['titular']['dni'] = $ultima['dni'];
               $datos_ultima_nomina['expedientes'][$rgc]['titular']['nombre'] = $ultima['nombrecompleto'];
               $datos_ultima_nomina['expedientes'][$rgc]['HS'] = $ultima['HS'];
               $datos_ultima_nomina['expedientes'][$rgc]['domicilio'] = $ultima['DOMICILIO'];
               $datos_ultima_nomina['expedientes'][$rgc]['ceas'] = $ultima['CEAS'];
               $datos_ultima_nomina['expedientes'][$rgc]['clasificacion'] = $ultima['CLASIFICACION'];
            } 

        }

        /*****************************
        * ** Numeros de RGC que antes estaban y ahora no están (bajas en nómina).
        * ** Números de RGC que antes no estaban y ahora sí (nuevos).
        * ** DNIs Nuevos
        * ** DNIs que ya no están.
        *****************************
        */
//debug($ultima_nomina);exit();

       foreach ($datos_ultima_nomina['expedientes'] as $rgc => $ultima) {

            if (!isset($datos_penultima_nomina['expedientes'][$rgc])) {   /* Si no existe el expediente en la nomina anterior lo guardamos en cambios como nuevo_expediente*/   

               
                $cambios['nuevo_expediente'][$rgc] = $ultima;

            }else{  /* Si existe comprobamos si hay cambios en el domicilio de cada número de RGC*/
               
                if ($ultima['domicilio'] != $datos_penultima_nomina['expedientes'][$rgc]['domicilio']) { //-> Sólo revisamos los que no coincide el domicilio
                  $cambios['domicilio'][$rgc]['nuevo'] = $ultima;
                  $cambios['domicilio'][$rgc]['antiguo'] = $datos_penultima_nomina['expedientes'][$rgc];
                    }

                
           } //-> END ELSE de revisión del cambio de domicilio         
       } //-> END FOREACH

        foreach ($datos_penultima_nomina['expedientes'] as $rgc => $penultima) {
           if (!isset($datos_ultima_nomina['expedientes'][$rgc])) {
               $cambios['bajas_nomina'][$rgc] = $penultima;
               $cambios['bajas_nomina'][$rgc]['titular']['dni'] = $datos_penultima_nomina['expedientes'][$rgc]['titular']['dni'];
               $cambios['bajas_nomina'][$rgc]['titular']['nombre'] = $datos_penultima_nomina['expedientes'][$rgc]['titular']['nombre'];
           }
       }

//debug(count($cambios['domicilio']));
//debug(count($cambios['nuevo_expediente']));
//debug(count($cambios['bajas_nomina']));
//debug($cambios);exit();


/****************************COMPLETAMOS LOS DATOS CON NUESTRA BASE DE DATOS*************************************/


/**** COMPLETAMOS LOS DATOS DE LOS CAMBIOS DE DOMICILIO CON LOS DE NUESTRA BASE DE DATOS ****/

        foreach ($cambios['domicilio'] as $rgc => $datos) {

                $datos_bd = $this->Expedientes->find('all', [
                                            'conditions' => ['numhs' => $datos['nuevo']['HS']],
                                            'contain' => ['Roles.Tecnicos']
                                        ])->first();

            if (!empty($datos_bd)) { // Si lo encontramos por la HS añadimos los Datos
                $cambios['domicilio'][$rgc]['datos_bd']['expediente_id'] = $datos_bd['id'];
                $cambios['domicilio'][$rgc]['datos_bd']['numedis'] = $datos_bd['numedis'];
                $cambios['domicilio'][$rgc]['datos_bd']['rol'] = $datos_bd['roles'];
                
            }else { // Si no lo encontramos por la HS lo intentamos por los DNI
                
                $datos_bd = '';

                foreach ($datos['nuevo']['miembros'] as $dni) {
                   
                    if ($dni!='') {

                        $datos_bd = $this->Participantes->find('all', [
                                                    'conditions' => ['dni' => $dni],
                                                    'contain' => ['Expedientes.Roles.Tecnicos']
                                                ])->first(); 
                    } 

                    if ($datos_bd!='') {break;}
                }
//debug($datos_bd);exit(); 
                    $cambios['domicilio'][$rgc]['datos_bd']['expediente_id'] = $datos_bd['expediente_id'];
                    $cambios['domicilio'][$rgc]['datos_bd']['numedis'] = $datos_bd['expediente']['numedis'];
                    $cambios['domicilio'][$rgc]['datos_bd']['rol'] = $datos_bd['expediente']['roles'];
                    $cambios['domicilio'][$rgc]['datos_bd']['clasificacion'] = $datos_bd['expediente']['clasificacion'];
            }  //--> END ELSE Busqueda por DNI 
        }  //--> END FOREACH 

//debug($cambios);exit();
/**** COMPLETAMOS LOS DATOS DE LOS NUEVOS EXPEDIENTES CON LOS DE NUESTRA BASE DE DATOS ****/

        foreach ($cambios['nuevo_expediente'] as $rgc => $datos) {

            $datos_bd = $this->Expedientes->find('all', [
                                            'conditions' => ['numhs' => $datos['HS']],
                                            'contain' => ['Roles.Tecnicos']
                                        ])->first();

            if (!empty($datos_bd)) { // Si lo encontramos por la HS añadimos los Datos
                $cambios['nuevo_expediente'][$rgc]['datos_bd']['expediente_id'] = $datos_bd['id'];
                $cambios['nuevo_expediente'][$rgc]['datos_bd']['numedis'] = $datos_bd['numedis'];
                $cambios['nuevo_expediente'][$rgc]['datos_bd']['rol'] = $datos_bd['roles'];
                
            }else { // Si no lo encontramos por la HS lo intentamos por los DNI
                
                $datos_bd = '';

                foreach ($datos['miembros'] as $dni) {
                   
                    if ($dni!='') {

                        $datos_bd = $this->Participantes->find('all', [
                                                    'conditions' => ['dni' => $dni],
                                                    'contain' => ['Expedientes.Roles.Tecnicos']
                                                ])->first(); 
                    } 

                    if ($datos_bd!='') {break;}
                }

                    $cambios['nuevo_expediente'][$rgc]['datos_bd']['expediente_id'] = $datos_bd['expediente']['id'];
                    $cambios['nuevo_expediente'][$rgc]['datos_bd']['numedis'] = $datos_bd['expediente']['numedis'];
                    $cambios['nuevo_expediente'][$rgc]['datos_bd']['rol'] = $datos_bd['expediente']['roles'];
            }  //--> END ELSE Busqueda por DNI 
        }  //--> END FOREACH 


/**** COMPLETAMOS LOS DATOS DE LOS EXPEDIENTES QUE CAUSAN BAJA CON LOS DE NUESTRA BASE DE DATOS ****/

        foreach ($cambios['bajas_nomina'] as $rgc => $datos) {

            $datos_bd = $this->Expedientes->find('all', [
                                            'conditions' => ['numhs' => $datos['hs']],
                                            'contain' => ['Roles.Tecnicos']
                                        ])->first();
 
            if (!empty($datos_bd)) { // Si lo encontramos por la HS añadimos los Datos
                $cambios['bajas_nomina'][$rgc]['datos_bd']['expediente_id'] = $datos_bd['id'];
                $cambios['bajas_nomina'][$rgc]['datos_bd']['numedis'] = $datos_bd['numedis'];
                $cambios['bajas_nomina'][$rgc]['datos_bd']['rol'] = $datos_bd['roles'];
                
            }else { // Si no lo encontramos por la HS lo intentamos por los DNI
                
                $datos_bd = '';

                foreach ($datos['miembros'] as $dni) {
                   
                    if ($dni!='') {

                        $datos_bd = $this->Participantes->find('all', [
                                                    'conditions' => ['dni' => $dni],
                                                    'contain' => ['Expedientes.Roles.Tecnicos']
                                                ])->first(); 
                    } 

                    if ($datos_bd!='') {break;}
                }

                    $cambios['bajas_nomina'][$rgc]['datos_bd']['expediente_id'] = $datos_bd['expediente']['id'];
                    $cambios['bajas_nomina'][$rgc]['datos_bd']['numedis'] = $datos_bd['expediente']['numedis'];
                    $cambios['bajas_nomina'][$rgc]['datos_bd']['rol'] = $datos_bd['expediente']['roles'];
            }  //--> END ELSE Busqueda por DNI 
        }  //--> END FOREACH 


/*******************************END COMPLETAMOS LOS DATOS CON NUESTRA BASE DE DATOS************************************/



        $this->set([//'lista_nominas'=>$ultima_nomina, 
                    'penultima_nomina'=>$datos_penultima_nomina['nomina'],
                    'ultima_nomina' =>$datos_ultima_nomina['nomina'],
                    //'anterior' => $anterior, 
                    'cambios'=>$cambios, 
                    //'bajas' => $bajas, 
                    //'nuevos' => $nuevos
                    ]);
        
        //debug($ultima_nomina);exit();
    }


    /**
     * Desplegar la última nómina
     *
     * @param $mes_nomina 
     * @return array
     * 
     */

    public function ultimaNomina()
    {
        $c = 1; // Contador para restar meses buscando la ultima nómina.
        $mes = array("enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");
        $fecha_actual = getdate();
        //debug($fecha_actual);exit();
        $mes_revisar = $fecha_actual['mon']-$c;
        $year_revisar = $fecha_actual['year'];

        while (empty($ultima_nomina)) {

            if ($mes_revisar<1) { // corregimos los cambios de año
                $c = 1;
                $mes_revisar=12;
                $year_revisar--;
            }

            $ultima_nomina = $this->generarNomina($mes[$mes_revisar-$c], $year_revisar);
            $c++;

        }

        $this->set(['lista_nominas'=>$ultima_nomina]);       
    }

    /**
     * Buscar datos entre los expedientes edis de la base
     *
     * @param $hs, $dni 
     * @return array
     * 
     */
}

