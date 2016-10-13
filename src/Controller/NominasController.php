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
    public function view($id = null)
    {
        $nomina = $this->Nominas->get($id, [
            'contain' => []
        ]);

        $this->set('nomina', $nomina);
        $this->set('_serialize', ['nomina']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lista_nominas= $this->listaNominas();
        $nomina = $this->Nominas->newEntity();
        $cuenta_nominas=0;
        $lineas  = [];
        $keys = ['CCLL','CEAS','HS','RGC','CLASIFICACION','MIEMBROS','dni','nombrecompleto','SEXO','EDAD','NACIONALIDAD','DOMICILIO','fechatramite','RESOLUCION','fechaefectos','relacion','fechanomina'];
        
        //verificamos que si se haya enviado un post.

        if ($this->request->is('post') && $this->request->data['nomina']['tmp_name']!='') {

            $csv = $this->request->data['nomina'];

                
            //si es correcto, entonces damos permisos de lectura para subir
            $filename = $csv['tmp_name'];
            $lineas = file($filename);
            unset($lineas[0], $lineas[1], $lineas[2]);

            foreach ($lineas as $linea_num => $linea){        
                $data = [];
                $datos = [];   

                    //abrimos condición, solo entrará en la condición a partir de la segunda pasada del bucle.
                    /* La funcion explode nos ayuda a delimitar los campos, por lo tanto irá 
                    leyendo hasta que encuentre un ; */
                    
                    //$linea = str_replace('"',"",$linea);

                    $datos = explode(';',$linea);
                    $data = array_combine($keys,$datos);

                    foreach ($data as $k => $d) { $data[$k] = trim($d);}
                    $data['fechatramite'] = $this->ajustarFecha($data['fechatramite']);
                    $data['fechaefectos'] = $this->ajustarFecha($data['fechaefectos']);                
                    //debug($data);exit(); 

                $n = $this->Nominas->newEntity();
                $n = $this->Nominas->patchEntity($n, $data);

                if ($this->Nominas->save($n)) {
                    $cuenta_nominas++;

                } else {
                    $this->Flash->error(__('The nomina could not be saved. Please, try again.'));
                }
            } 
                   
            $this->Flash->success(__('Se han cargado correctamente '.$cuenta_nominas.' nominas'));
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
     * Buscar Nominas method
     *
     * @param $mes_nomina 
     * @return array
     * 
     */
    public function listaNominas($id = null)
    {
        
        $lista_nominas = $this->Nominas->find('all', [ 'order'=>'HS DESC',
                                                        //'limit'=> 1000
            ]);
//debug($lista_nominas->toArray());exit();                          
        return $lista_nominas;
        //return $this->redirect($this->referer());
        $this->autoRender = false;

    }

}
