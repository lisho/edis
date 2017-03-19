<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Avisos Controller
 *
 * @property \App\Model\Table\AvisosTable $Avisos
 */
class AvisosController extends AppController
{
    
    /**
    *
    * 
    * @return Devuelveun array con los avisos urgentes
    **/

    public function avisos_urgentes()
    {
        $hoy = date('Y-m-d');
        $this->paginate = [
            'contain' => ['Users'],
            'order' => [
                'Avisos.created' => 'desc'],
             'conditions' => [  'Avisos.importancia' => 'alta',
                                'Avisos.tipo' => 'aviso',
                                'Avisos.caduca >=' => $hoy]
        ];
//debug($hoy);exit();
        $avisos_urgentes = $this->paginate($this->Avisos);

        return $avisos_urgentes;
    }

    /**
    *
    * 
    * @return Devuelve los avisos y las noticias publicadas
    *       por el usuario logueado.
    **/

    public function mis_avisos()
    {
        $usuario = $this->Auth->user('id');
        $this->paginate = [
            'contain' => ['Users'],
            'order' => [
                'Avisos.created' => 'desc'],
             'conditions' => ['Avisos.user_id' => $usuario]
        ];

        $mis_avisos = $this->paginate($this->Avisos);

        return $mis_avisos;
    }

    /**
    *
    * 
    * @return Devuelve los avisos publicados.
    **/

    public function solo_avisos()
    {
        $this->paginate = [
            'contain' => ['Users'],
            'order' => [
                'Avisos.created' => 'desc'],
             'conditions' => ['Avisos.tipo' => 'aviso']
        ];

        $solo_avisos = $this->paginate($this->Avisos);

        return $solo_avisos;
    }

    /**
    *
    * 
    * @return Devuelve los avisos y las noticias publicadas
    *       por el usuario logueado.
    **/

    public function solo_noticias()
    {
        $this->paginate = [
            'contain' => ['Users'],
            'order' => [
                'Avisos.created' => 'desc'],
             'conditions' => ['Avisos.tipo' => 'noticia']
        ];

        $solo_noticias = $this->paginate($this->Avisos);

        return $solo_noticias;
    }

    /**
     * Novedades method
     *
     * @return \Cake\Network\Response|null
     */
    public function novedades()
    {
        //Si queremos solo la última por ajax pasamos el param='ultima' en el data del json
        if (isset($this->request->query['param']) && $this->request->query['param'] == 'ultima') {

            $novedades = $this->Avisos->find('all', [
                    'order' => [
                        'Avisos.created' => 'desc'],
                    'conditions' => ['Avisos.tipo' => 'novedades']
                ]);

            $ultima_novedad = $novedades->first();
//debug($ultima_novedad);exit();
            echo json_encode($ultima_novedad);
            $this->autoRender = false;
        }

        else {

            $this->paginate = [
                'order' => [
                    'Avisos.created' => 'desc'],
                 'conditions' => ['Avisos.tipo' => 'novedades']
            ];
            $novedades = $this->paginate($this->Avisos);
            $this->set(compact('novedades'));
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {

        $this->paginate = [
            'contain' => ['Users']
        ];
        
        $avisos = $this->paginate($this->Avisos);

        $avisos_urgentes = $this->avisos_urgentes();
        $mis_avisos = $this->mis_avisos();
        $solo_noticias = $this->solo_noticias();
        $solo_avisos = $this->solo_avisos();

        $this->set(compact('avisos','mis_avisos','avisos_urgentes', 'solo_noticias', 'solo_avisos'));
        $this->set('_serialize', ['avisos','mis_avisos','avisos_urgentes', 'solo_noticias', 'solo_avisos']);
    }

    /**
     * View method peticion por ajax
     *
     * @param string|null $id Aviso id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        
        $id = $this->request->query['id'];
        $aviso = $this->Avisos->get($id, [
            'contain' => ['Users']
        ]);
        echo json_encode($aviso);
        $this->autoRender = false;

    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        //debug($this->request->data);exit();

        $aviso = $this->Avisos->newEntity();
        if ($this->request->is('post')) {
            
            $cachos_fecha = preg_split("/[\/]+/", $this->request->data['caduca']);
            $this->request->data['caduca']=array(
                                'year'=>$cachos_fecha[2],
                                'month'=>$cachos_fecha[1],
                                'day' =>$cachos_fecha[0] 
                        );
            
            $aviso = $this->Avisos->patchEntity($aviso, $this->request->data);
            if ($this->Avisos->save($aviso)) {
                $this->Flash->success(__('The aviso has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The aviso could not be saved. Please, try again.'));
            }
        }
        $users = $this->Avisos->Users->find('list', ['limit' => 200]);
        $this->set(compact('aviso', 'users'));
        $this->set('_serialize', ['aviso']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Aviso id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $aviso = $this->Avisos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

            $cachos_fecha = preg_split("/[\/]+/", $this->request->data['caduca']);
            $this->request->data['caduca']=array(
                                'year'=>$cachos_fecha[2],
                                'month'=>$cachos_fecha[1],
                                'day' =>$cachos_fecha[0] 
                        );
            
            $aviso = $this->Avisos->patchEntity($aviso, $this->request->data);
            if ($this->Avisos->save($aviso)) {
                $this->Flash->success(__('The aviso has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The aviso could not be saved. Please, try again.'));
            }
        }
        
        $this->set(compact('aviso'));
        $this->set('_serialize', ['aviso']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Aviso id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $aviso = $this->Avisos->get($id);
        if ($this->Avisos->delete($aviso)) {
            $this->Flash->success(__('The aviso has been deleted.'));
        } else {
            $this->Flash->error(__('The aviso could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
