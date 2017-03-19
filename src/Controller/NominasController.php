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
        $comparaNominas = $this->llamaComparaNominas();

        //debug($comparaNominas);exit();

        $this->set([//'lista_nominas'=>$ultima_nomina, 
                    'penultima_nomina'=>$comparaNominas['penultima_nomina'],
                    'ultima_nomina' =>$comparaNominas['ultima_nomina'],
                    //'anterior' => $anterior, 
                    'cambios'=>$comparaNominas['cambios'], 
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

