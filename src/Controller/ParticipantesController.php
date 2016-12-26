<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * Participantes Controller
 *
 * @property \App\Model\Table\ParticipantesTable $Participantes
 */
class ParticipantesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => [  'Expedientes']
        ];

        $participantes = $this->paginate($this->Participantes);

        $this->set(compact('participantes'));
        $this->set('_serialize', ['participantes']);
    }

    /**
     * View method
     *
     * @param string|null $id Participante id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $participante = $this->Participantes->get($id, [
            'contain' => [  'Expedientes',
                            'Expedientes.Participantes',
                            'Expedientes.Participantes.Relations']
        ]);

        //Añadimos la edad al array de datos del expediente
        
        $edad = $this->calcularEdad($participante['nacimiento']);
        $participante['edad'] = $edad;

         //Añadimos la edad al array de datos de los miembros de la parrilla
        foreach ($participante['expediente']['participantes'] as $p) {
            $edad = $this->calcularEdad($p['nacimiento']);
            $p['edad'] = $edad;
        }
            
        $this->set('participante', $participante);
        $this->set('_serialize', ['participante']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        
        $participante = $this->Participantes->newEntity();

        if ($this->request->is('post')) {
            
            $participante = $this->Participantes->patchEntity($participante, $this->request->data, [
                        'associated' => [
                                'Relations'
                        ]
                        ]);
            if ($this->Participantes->save($participante)) {

                $this->Flash->success(__('The participante has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('No ha sido posible guardar el nuevo participante. Por favor revisa los datos.');
            }
        }
        
        $relaciones = $this->Participantes->Relations->find('list', ['limit' => 20]);
        $this->set(compact('participante','relaciones'));
        $this->set('_serialize', ['participante']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Participante id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $participante = $this->Participantes->get($id, [
            'contain' => ['Relations']
        ]);
        
        $old_foto=$participante['foto'];
                   
        if ($this->request->is(['patch', 'post', 'put'])) {

//debug( $this->request->data);exit();                      

            switch ($this->request->data['photo']['type']) {
                case 'image/jpeg':
                    $ext = '.jpg';
                    break;
                case 'image/png':
                    $ext = '.png';
                    break;           
                default:
                    # code...
                    break;
            }
//debug( $old_foto);exit();                      

            if (!empty($this->request->data['photo']['tmp_name'])
                    && is_uploaded_file($this->request->data['photo']['tmp_name'])) 
                {
                    if ($old_foto != []){
                        $file = new File(IMAGES.'participantes_fotos/'.$old_foto);
                        $file->delete();
                        $file->close();
                    }

                    $filename=$this->request->data['photo'];
//debug($filename);exit();
                   
                    move_uploaded_file($filename['tmp_name'], IMAGES.'participantes_fotos'. DS . $participante['dni'].$ext);
                     //redimensionamos la foto antes de guardarla.
                    $filename=$this->redimensionar(IMAGES.'participantes_fotos'. DS . $participante['dni'].$ext);
                    $this->request->data['foto'] = $this->request->data['dni'].$ext;
                }

            if (empty($this->request->data['nacimiento'])) {
                $this->request->data['nacimiento']="";
            } else {
                $cachos_fecha = preg_split("/[\/]+/", $this->request->data['nacimiento']);
                $this->request->data['nacimiento']=array(
                                'year'=>$cachos_fecha[2],
                                'month'=>$cachos_fecha[1],
                                'day' =>$cachos_fecha[0] 
                        );
            }
            
//debug($this->request->data);exit();
            $participante = $this->Participantes->patchEntity($participante, $this->request->data, [
                    'associated' => [
                                'Relations'
                        ]
                ]);
            if ($this->Participantes->save($participante)) {

                // ****  Añadimos el archivo FOTO a la carpeta *******//    
                if ($this->request->data['photo']['name']!='') {
                        $filename=$this->request->data['photo'];
                        move_uploaded_file($filename['tmp_name'], IMAGES.'participante_fotos/'. DS . $participante['dni'].$ext);
                    }    
                   

                $this->Flash->success(__('Se han editado correctamente los datos de  '.$participante['nombre'].' '.$participante['apellidos'].'.'));
                return $this->redirect(['action' => 'view',$participante->id]);
            } else {
                $this->Flash->error(__('No hga sido posible guardar los cambios. Por favor inténtalo de nuevo.'));
            }
        }
        $expedientes = $this->Participantes->Expedientes->find('list', ['limit' => 200]);
        $relaciones = $this->Participantes->Relations->find('list', ['limit' => 20]);
        $this->set(compact('participante', 'expedientes', 'relaciones'));
        $this->set('_serialize', ['participante']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Participante id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $participante = $this->Participantes->get($id);
        if ($this->Participantes->delete($participante)) {
            $this->Flash->success(__('The participante has been deleted.'));
        } else {
            $this->Flash->error(__('The participante could not be deleted. Please, try again.'));
        }
        return $this->redirect(['controller' => 'Expedientes','action' => 'view', $participante['expediente_id']]);
    }


    /*
    * BUSCADOR DE ALUMNOS;
    *
    * 
    */  

    public function searchjson()
    {
        $term=null;
        if (!empty($this->request->query['term'])) {
            $term=$this->request->query['term'];
            $terms=explode(' ', trim($term));
            $terms=array_diff($terms, array(''));


            $participantes = $this->Participantes->find('all')
                        ->contain(['Expedientes'])
                        -> where(['CONCAT(dni," ", nombre," ", apellidos) LIKE' => '%' . implode(" ", $terms) . '%'])
                        -> orWhere(['CONCAT(dni," ", apellidos," ", nombre) LIKE' => '%' . implode(" ", $terms) . '%'])
                        ;
                        
            //debug($conditions);exit();
        }
        //debug($participantes);exit();
        echo json_encode($participantes);
        $this->autoRender = false;
    }

    /**
     * Edit method
     *
     * @param string|null $id Participante id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function editNacimiento($id = null)
    {
        
        //debug($this->request->data);exit();
        $nacimiento = $this->request->data['nacimiento'];
        $cachos_fecha = preg_split("/[\/]+/", $nacimiento);

            if ( $nacimiento!='') {
                 $nacimiento=array(
                                'year'=>$cachos_fecha[2],
                                'month'=>$cachos_fecha[1],
                                'day' =>$cachos_fecha[0] 
                        );
            }
        $this->request->data['nacimiento']= $nacimiento;
        $participante = $this->Participantes->get($id, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $participante = $this->Participantes->patchEntity($participante, $this->request->data);
            
            if ($this->Participantes->save($participante)) {
                $this->Flash->success(__('Se ha guardado correctamente la edad de '.$participante->nombre.' '.$participante->apellidos));
                
                return $this->redirect($this->referer());
            } else {
                $this->Flash->error(__('La edad del participante no se ha guardado correctamente. Por favor, revisa el formato e inténtalo de nuevo.'));
                return $this->redirect($this->referer());
            }
        }
        $this->autoRender = false;
    }

}
