<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Suspensions Controller
 *
 * @property \App\Model\Table\SuspensionsTable $Suspensions
 */
class SuspensionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $suspensions = $this->paginate($this->Suspensions);

        $this->set(compact('suspensions'));
        $this->set('_serialize', ['suspensions']);
    }

    /**
     * View method
     *
     * @param string|null $id Suspension id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $suspension = $this->Suspensions->get($id, [
            'contain' => []
        ]);

        $this->set('suspension', $suspension);
        $this->set('_serialize', ['suspension']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        
        $suspension = $this->Suspensions->newEntity();
        $cuenta_suspension=0;
        $cuenta_fallos=0;
        $lineas  = [];
        $keys = ['provincia','CCLL','CEAS','HS','UC','RGC','CLASIFICACION','MIEMBROS','dni','nombrecompleto','SEXO','EDAD','NACIONALIDAD','DOMICILIO','fechatramite','RESOLUCION','fechaefectos','relacion','fechanomina'];
                
        //verificamos que si se haya enviado un post.

        if ($this->request->is('post') && $this->request->data['suspension']['tmp_name']!='') {

            $csv = $this->request->data['suspension'];
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
                    $comprueba_suspension = $this->Suspensions->find('all', ['conditions' => [
                                'fechanomina' => $data['fechanomina'],
                                'nombrecompleto' => $data['nombrecompleto'],
                                'dni' => $data['dni'],
                                'relacion' => $data['relacion']
                            ]
                        ]);
//debug($comprueba_suspension);exit();
                    if (empty($comprueba_suspension->toArray())) {
                        $n = $this->Suspensions->newEntity();
                        $n = $this->Suspensions->patchEntity($n, $data);

                        if ($this->Suspensions->save($n)) {
                            $cuenta_suspension++;

                        } else {
                            $this->Flash->error(__('The suspension could not be saved. Please, try again.'));
                        }
                    } else {
                        $cuenta_fallos++;
                        $this->Flash->error('Error al cargar la suspension:'.$linea);
                    }  
            } 
                   
            $this->Flash->success(__('Se han cargado correctamente '.$cuenta_suspension.' nominas'));
            $this->Flash->error(__('No ha sido posible cargar '.$cuenta_fallos.' nominas porque ya existen en el sistema'));
        }
        
        $this->set(compact('suspension', 'lista_nominas'));
        $this->set('_serialize', ['suspension']);

    }

    /**
     * Edit method
     *
     * @param string|null $id Suspension id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $suspension = $this->Suspensions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $suspension = $this->Suspensions->patchEntity($suspension, $this->request->data);
            if ($this->Suspensions->save($suspension)) {
                $this->Flash->success(__('The suspension has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The suspension could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('suspension'));
        $this->set('_serialize', ['suspension']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Suspension id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $suspension = $this->Suspensions->get($id);
        if ($this->Suspensions->delete($suspension)) {
            $this->Flash->success(__('The suspension has been deleted.'));
        } else {
            $this->Flash->error(__('The suspension could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
