<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\I18n\Date;

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

        return $this->redirect(['action' => 'errores']);
    }

    /**
     * 
     * Detectar errores en los expedientes
     */

    public function errores()
    {
        $tedis = [];

        $migraexpediente = $this->Migraexpedientes->find('all', [
            'contain' => ['Migrausuarios']
        ]);

        //$m_e = $migraexpediente->toArray();

        foreach ($migraexpediente as $k => $expediente) {
            
            if (!preg_match('/[0-9]{4}/',$expediente['numedis'])) {
        
               $numedis_error[] = $expediente;        
            }

            if ($expediente['numedis']>4999 && $expediente['numedis']<5999) {
                $posibles_arraigos[]=$expediente;
                //$this->delete($expediente->id);
            }

            if (empty($expediente['migrausuarios'])) {
                $expedientes_vacios[]=$expediente;
                //$this->delete($expediente->id);
            }

            if (!isset($tedis[$expediente['tedis']])) {
                $tedis[$expediente['tedis']]['val']=0;
            }
            $tedis[$expediente['tedis']]['val']++;
        }

    
//debug($tedis);exit();

        $this->set(compact('numedis_error','tedis', 'posibles_arraigos', 'expedientes_vacios'));
        $this->set('_serialize', ['migraexpediente']);
    }

    /**
     * 
     * Detectar expedientes vacíos
     */

    public function expedientesVacios()
    {
        $tedis = [];

        $migraexpediente = $this->Migraexpedientes->find()
                -> contain(['Migrausuarios'])
                -> toArray();
                


        //$m_e = $migraexpediente->toArray();

        foreach ($migraexpediente as $k => $expediente) {
            
            if (empty($expediente->migrausuarios)) {
        
               $expedientes_vacios[$expediente->id] = $expediente;        
            }
        }

        debug($expedientes_vacios);
        debug(count($migraexpediente));
        debug(count($expedientes_vacios));exit();

    
//debug($tedis);exit();

        $this->set(compact('numedis_error','tedis'));
        $this->set('_serialize', ['migraexpediente']);
    }

    /**
     * 
     * Migrar los roles de la base vieja: TEDIS y CC
     */

    public function migraRoles()
    {
        
        $lista_cc = [
            '' => 1,
            'MARIA JOSE VALBUENA GONZALEZ' =>  36,
            'CRISTINA GABILANES FERNANDEZ-LLAMAZARES' => 25,
            'MARIA SOLEDAD RODRIGUEZ FERMANDEZ' => 16,
            'NATIVIDAD PALACIOS IBAN' => 28,
            'MARIA CONCEPCION GONZALEZ PEREZ' => 17,
            'GUSTAVO SALVADOR RODRIGUEZ FERNANDEZ' => 31,
            'MARIA VICTORIA GONZALEZ ALVAREZ' => 20,
            'YOLANDA FERNANDEZ LOPEZ' => 29,
            'ZEUDI ALONSO DA SILVA' => 15,
            'ELISA DEL CAMPO GONZALEZ' => 35,
            'ALICIA GONZALEZ GONZALEZ' => 33,
            'ISABEL GARCIA FERNANDEZ' => 16,
            'MARTA BARRIENTOS PRADA' => 32,
            'MARIA TERESA LOPEZ GONZALEZ' => 23,
            'ANA MARIA FIDALGO MESA' => 4,
            'LAURA FREIRE MARTINEZ' => 26,
            'ROSA MARTA MORAL TOME' => 22,
            'MARIA RODRIGUEZ GARCIA' => 24,
            'MARIA ZEUDI ALONSO DA SILVA' => 15,
            'BEATRIZ BLANCO GUTIERREZ' => 37,
            'MARIA TERESA CUEVAS RODRIGUEZ' => 34,
            'MARIA DOLORES SANTOS ALVAREZ' => 33,
            'MARIA ESPERANZA GARCIA LOPEZ' => 39,
            'ANA EVA GAY ALONSO' => 34
        ];

        $lista_tedis = [
            'MARIA PAZ BRAVO' => 1,
            'MARIA ANGELES ARIAS' => 6,
            'MERCEDES MARNE' => 8,
            'LUIS ALBERTO GONZALEZ' => 2,
            'ROSAURA SANCHEZ' => 3,
            'PENDIENTE DE ASIGNAR' => 1,
            'HELENA MARSA NAVARRO' => 5,
            'NIEVES ALVAREZ CASTAÑEDA' => 7,
            'NO DERIVADO' => 40,
            '' => 1
        ];

        $this->loadModel("Expedientes");
        $expedientes = $this->Migraexpedientes->find()
                                                ->contain(['Migrausuarios'=> function ($q) {
                                                            return $q
                                                                ->where(['relacion' => 'solicitante']);
                                                        }
                                                    ])
                                                ->toArray();


   
/*
        $participantes = $this->Participantes->find()
                                                ->select(['id', 'dni'])
                                                ->toArray();
*/
        $cc = [];
        $tedis = [];
        $i=1;

        $this->loadModel("Participantes");
        $this->loadModel("Roles");
        $this->loadModel("Nominas");
        $this->loadModel("Prestacions");

        foreach ($expedientes as $expediente) {
/*
            if (!in_array($expediente['cc'], $cc)) {
                $cc[]=$expediente['CC'];
            }else {
                echo "CC REPETIDO";
            }

            if (!in_array($expediente['tedis'], $tedis)) {
                $tedis[]=$expediente['tedis'];
            }else {
                echo "TEDIS REPETIDO";
            }
        

            $roles[$i]['expediente_id'] =  $expediente['id'];
            $roles[$i]['tecnico_id'] =  $lista_tedis[$expediente['tedis']];
            $roles[$i]['cc_id'] =  $lista_cc[$expediente['cc']];
*/    
            
//****************
            $rgc[$i]['expediente_id'] = $expediente['id'];
            $rgc[$i]['numprestacion'] = $expediente['rgc'];
            $rgc[$i]['prestaciontipo_id'] = 3;
            $rgc[$i]['prestacionestado_id'] = 5;
            $rgc[$i]['observaciones'] = '';
            $rgc[$i]['apertura'] = '0000-00-00';
            $rgc[$i]['cierre'] = NULL;

                //Buscamos el titular de la prestacion en la nomina
                $titular = $this->Nominas->find()                                
                                            ->select(['RGC', 'dni', 'fechaefectos'])
                                            ->where(['fechanomina'=>'Enero      de 2017',
                                                        'relacion' => 'TITULAR',
                                                        'RGC'=> $expediente['rgc']
                                                        ])
                                            ->first();

                $titular_id =$this->Participantes->findByDni($titular['dni'])
                                                   ->select(['id','dni'])
                                                   ->first();

//debug($titular); 
//debug($titular_id); 

            $rgc[$i]['participante_id'] = $titular_id['id'];
            $rgc[$i]['fechaefectos'] = $titular['fechaefectos'];

            $i++;
         
        }
//debug($rgc);exit(); 

$a = 0;
$b = 0;

        foreach ($rgc as $prestacion) {
            
            $data = [   'id' => '',
                            'expediente_id' => $prestacion['expediente_id'],
                            'numprestacion' => $prestacion['numprestacion'],
                            'prestaciontipo_id' => $prestacion['prestaciontipo_id'],
                            'prestacionestado_id' => $prestacion['prestacionestado_id'],
                            'observaciones' => $prestacion['observaciones'],
                            'apertura' => $prestacion['fechaefectos'],
                            'cierre' => $prestacion['cierre'],
                            'participante_id' => $prestacion['participante_id']
                        ];
    
            if ($prestacion['numprestacion']!='') {

                if ($prestacion['participante_id']==null) {
                    // Buscamos el titular del expediente porque no tenemos el de la prestación
                    $t =$this->Participantes->find()
                                                   ->select(['id','dni'])
                                                   ->contain(['Expedientes'])
                                                   ->where(['Expedientes.id'=>$prestacion['expediente_id'],
                                                            'relation_id'=>1])
                                                   ->first();

                    $data = [ 'id' => '',
                            'expediente_id' => $prestacion['expediente_id'],
                            'numprestacion' => $prestacion['numprestacion'],
                            'prestaciontipo_id' => $prestacion['prestaciontipo_id'],
                            'prestacionestado_id' => 6,
                            'observaciones' => $prestacion['observaciones'],
                            'apertura' => new Date('0000-00-00'),
                            'cierre' =>  new Date('0000-00-00'),
                            'participante_id' => $t['id'],
                            ];
                    
                    $pres = $this->Prestacions->newEntity();
                    $pres = $this->Prestacions->patchEntity($pres, $data);

                    if ($this->Prestacions->save($pres)) {
                        echo "<p>CREADA la prestación ".$prestacion['numprestacion']." cerrada</p>";
                    }else {
                        echo "<p>Error al crear la prestación ".$prestacion['numprestacion']." cerrada</p>";
                    }

                } else {

                    $pres = $this->Prestacions->newEntity();
                    $pres = $this->Prestacions->patchEntity($pres, $data);

                    if ($this->Prestacions->save($pres)) {
                        echo "<p>CREADA la prestación ".$prestacion['numprestacion']." abierta</p>";
                    }else {
                        echo "<p>Error al crear la prestación ".$prestacion['numprestacion']." abierta</p>";
                    }
                }
            } 
        }

//echo "Expedientes cerrados: ".$a.'</br>';
//echo "Expedientes abiertos: ".$b;
//exit();
//exit();   
//debug($rgc); exit();
//debug($participantes); exit();
//debug($nomina); exit();           
//debug($expedientes); exit();   
 
 /*      foreach ($roles as $rol) {
           
            $role = $this->Roles->newEntity();
            $cc = [ 'id' =>'',
                    'expediente_id'=>$rol['expediente_id'],
                    'tecnico_id' => $rol['cc_id'],
                    'rol' => 'CC',
                    'observaciones' => ''
                    ];
            $role = $this->Roles->patchEntity($role, $cc);
            if ($this->Roles->save($role)) {
                echo "<p>CREADO el rol del expediente con id".$rol['expediente_id']." como CC</p>";
            }else {
                echo "<p>Error al crear el rol del expediente con id".$rol['expediente_id']." como CC</p>";
            }

            $role2 = $this->Roles->newEntity();
            $tedis = [ 'id' =>'',
                    'expediente_id'=>$rol['expediente_id'],
                    'tecnico_id' => $rol['tecnico_id'],
                    'rol' => 'tedis',
                    'observaciones' => ''
                    ];
            $role2 = $this->Roles->patchEntity($role2, $tedis);
            if ($this->Roles->save($role2)) {
                echo "<p>CREADO el rol del expediente con id".$rol['expediente_id']." como TEDIS</p>";
            }else {
                echo "<p>Error al crear el rol del expediente con id".$rol['expediente_id']." como TEDIS</p>";
            }
        } */ 

        //debug($roles);
        //debug($rgc);
        //debug($tedis);
        //debug($cc);
        $this->autoRender = false;
    }

}
