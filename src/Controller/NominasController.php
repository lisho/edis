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

        $this->loadModel('Suspensions');
        /* Generamos al última y la penúltima nómina*/
/*
        while (empty($ultima_nomina)) {
            
            $ultima_nomina = $this->generarNomina($mes[$fecha_actual['mon']-$c], $fecha_actual['year']); 
            $penultima_nomina = $this->generarNomina($mes[$fecha_actual['mon']-($c+1)], $fecha_actual['year']);          
            $c++;
        }    
        
*/
        $mes_revisar = $fecha_actual['mon']-$c;
        $year_revisar = $fecha_actual['year'];

        while (empty($ultima_nomina)) {

            if ($mes_revisar<1) { // corregimos los cambios de año
                $c = 1;
                $mes_revisar=12;
                $year_revisar--;
            }

            $ultima_nomina = $this->generarNomina($mes[$mes_revisar-$c], $year_revisar);
            $penultima_nomina = $this->generarNomina($mes[$mes_revisar-($c+1)], $year_revisar); 
            $c++;

        }


        /* Ordenamos los datos para comparar las 2 nóminas */
            $datos_penultima_nomina['nomina']= $penultima_nomina[0]['fechanomina'];
            $datos_ultima_nomina['nomina']= $ultima_nomina[0]['fechanomina'];

        
        foreach ($penultima_nomina as $penultima) {
        //debug($penultima);exit();
           $datos_penultima_nomina['RGC'][] = $penultima['RGC'];
           $datos_penultima_nomina['dni'][] = $penultima['dni'];
           //$datos_penultima_nomina['HS'][$penultima['HS']][] = $penultima['nombrecompleto'];
           $datos_penultima_nomina[$penultima['RGC']]['titular'] = $penultima['nombrecompleto'];
           $datos_penultima_nomina[$penultima['RGC']]['HS'] = $penultima['HS'];
           $datos_penultima_nomina[$penultima['RGC']]['domicilio'] = $penultima['DOMICILIO'];
           $datos_penultima_nomina[$penultima['RGC']]['ceas'] = $penultima['CEAS'];
       }

        foreach ($ultima_nomina as $ultima) {
           $datos_ultima_nomina['RGC'][] = $ultima['RGC'];
           $datos_ultima_nomina['dni'][] = $ultima['dni'];
           //$datos_ultima_nomina['HS'][$ultima['HS']][] = $ultima['nombrecompleto'];
           $datos_ultima_nomina[$ultima['RGC']]['titular'] = $ultima['nombrecompleto'];
           $datos_ultima_nomina[$ultima['RGC']]['HS'] = $ultima['HS'];
           $datos_ultima_nomina[$ultima['RGC']]['domicilio'] = $ultima['DOMICILIO'];
           $datos_ultima_nomina[$ultima['RGC']]['ceas'] = $ultima['CEAS'];
       }

       /*****************************
        * ** Numeros de RGC que antes estaban y ahora no están (bajas en nómina).
        * ** Números de RGC que antes no estaban y ahora sí (nuevos).
        * ** DNIs Nuevos
        * ** DNIs que ya no están.
        *****************************
        */


       foreach ($ultima_nomina as $ultima) {

           if (in_array($ultima['RGC'], $datos_penultima_nomina['RGC'])) {      
                /* Comprobamos si hay cambios en el domicilio de cada número de RGC*/
               if ($datos_penultima_nomina[$ultima->RGC]['domicilio'] != $ultima->DOMICILIO) {
                        $anterior['domicilios'][$ultima['RGC']] = $datos_penultima_nomina[$ultima['RGC']]['domicilio'];
                        $cambios['domicilios'][$ultima['RGC']] = $datos_ultima_nomina[$ultima['RGC']]['domicilio'];

                    if ($datos_penultima_nomina[$ultima->RGC]['ceas'] != $ultima->CEAS) {
                        $anterior['ceas'][$ultima['RGC']] = $datos_penultima_nomina[$ultima['RGC']]['ceas'];
                        $cambios['ceas'][$ultima['RGC']] = $datos_ultima_nomina[$ultima['RGC']]['ceas'];
                    }   
                }

           }else{
                $cambios['nuevos_rgc'][] = $ultima['RGC'];
           }
           
       }

       foreach ($penultima_nomina as $penultima) {
           if (!in_array($penultima['RGC'], $datos_ultima_nomina['RGC'])) {
               $cambios['bajas_nomina'][] = $penultima['RGC'];
           }
       }

        $bajas = array_unique($cambios['bajas_nomina']);
        $nuevos = array_unique($cambios['nuevos_rgc']);
    /*   
        debug($anterior);
        debug($cambios);
        debug(count($bajas));
        debug($bajas);
        debug(count($nuevos));
        debug($nuevos);
        debug($datos_penultima_nomina);
        
        exit();
    */

        $this->set(['lista_nominas'=>$ultima_nomina, 
                    'penultima_nomina'=>$datos_penultima_nomina,
                    'ultima_nomina' =>$datos_ultima_nomina,
                    'anterior' => $anterior, 'cambios'=>$cambios, 'bajas' => $bajas, 'nuevos' => $nuevos]);
        
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
}
