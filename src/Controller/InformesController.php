<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * Informes Controller
 *
 * @property \App\Model\Table\InformesTable $Informes
 */
class InformesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index($expediente_id = null)
    {
        $this->paginate = [
            'contain' => ['Users', 'Expedientes'],
            'order' => ['Informes.fecha' => 'desc'],
            'conditions' => ['expediente_id' => $expediente_id,]
        ];

        $this->loadModel('Expedientes');
        $expediente = $this->Expedientes->get($expediente_id);

        $informes = $this->paginate($this->Informes);
//debug($expediente_numedis);exit();
        $this->set(compact('informes', 'expediente'));
        $this->set('_serialize', ['informes']);
    }

    /**
     * View method
     *
     * @param string|null $id Informe id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $informe = $this->Informes->get($id, [
            'contain' => ['Users', 'Expedientes']
        ]);

        $this->set('informe', $informe);
        $this->set('_serialize', ['informe']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($expediente_id = null)
    {
        $informe = $this->Informes->newEntity();
        if ($this->request->is('post')) {

            $cachos_fecha = preg_split("/[\/]+/", $this->request->data['fecha']);
            $this->request->data['fecha']=array(
                                'year'=>$cachos_fecha[2],
                                'month'=>$cachos_fecha[1],
                                'day' =>$cachos_fecha[0] 
                        );

            $informe = $this->Informes->patchEntity($informe, $this->request->data);
            //debug($this->request->data);exit();
            if ($this->Informes->save($informe)) {
                $this->Flash->success(__('Has creado un nuevo borrador de informe correctamente.'));

                return $this->redirect(['action' => 'index', $expediente_id]);
            } else {
                $this->Flash->error(__('No ha sido posible crear un nuevo borrador de informe Por favor, inténtalo de menos.'));
            }
        }
        //$users = $this->Informes->Users->find('list', ['limit' => 200]);
        //$expedientes = $this->Informes->Expedientes->find('list', ['limit' => 200]);
        $expediente = $this->Informes->Expedientes->get($expediente_id);
        $this->set(compact('informe', 'expediente'));
        $this->set('_serialize', ['informe']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Informe id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $informe = $this->Informes->get($id, [
            'contain' => ['Expedientes','Expedientes.Participantes','Users']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {


            $cachos_fecha = preg_split("/[\/]+/", $this->request->data['fecha']);
            $this->request->data['fecha']=array(
                                'year'=>$cachos_fecha[2],
                                'month'=>$cachos_fecha[1],
                                'day' =>$cachos_fecha[0] 
                        );

            $informe = $this->Informes->patchEntity($informe, $this->request->data);
            if ($this->Informes->save($informe)) {
                $this->Flash->success(__('Los cambios se han guardado correctamente.'));

                return $this->redirect(['action' => 'index', $informe->expediente_id]);
            } else {
                $this->Flash->error(__('No ha sido posible guardar los cambios. Por favor inténtalo de nuevo.'));
            }
        }
        //$users = $this->Informes->Users->find('list', ['limit' => 200]);
        //$expedientes = $this->Informes->Expedientes->find('list', ['limit' => 200]);
        //$expediente = $this->Informes->Expedientes->get($expediente_id);
        $this->set(compact('informe', 'expediente'));
        $this->set('_serialize', ['informe']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Informe id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $informe = $this->Informes->get($id);
        if ($this->Informes->delete($informe)) {
            $this->Flash->success(__('The informe has been deleted.'));
        } else {
            $this->Flash->error(__('The informe could not be deleted. Please, try again.'));
        }

        return $this->redirect($this->referer());
    }

/***********************************************
**
** GENERANDO DE INFORMES
**
**
************************************************/

    public function informe($id=null, $validar=null)
    {
        
        $informe = $this->Informes->get($id, [
            'contain' => ['Users', 'Expedientes.Participantes.Relations', 'Users.Equipos.Tecnicos', 'Expedientes.Prestacions.Participantes'],
            //'conditions' => ['Expedientes.Prestacions.prestaciontipo_id' => 3]
        ]);

        $prestaciones = $informe->expediente->prestacions;
        $prestacion_rgc = '';
        $tedis='';

        foreach ($prestaciones as $prestacion) {
            if ($prestacion->prestaciontipo_id==3 && $prestacion->prestacionestado_id == 5) {
                $prestacion_rgc=$prestacion;
            }elseif ($prestacion->prestaciontipo_id==3 && $prestacion->prestacionestado_id == 1) {
                $prestacion_rgc=$prestacion;
            }
        }
//debug($informe);exit();
        $this->loadModel('Equipos');
        $ceas = $this->Equipos->get($informe->expediente->ceas);
        $tecnicos = $informe->user->equipo->tecnicos;
        foreach ($tecnicos as $tecnico) {
            if (strtoupper($tecnico->nombre) == $informe->user->nombre) {
                $tedis = $tecnico;
            }
        }
//debug($tedis);exit();
        
//debug($tedis);exit();
//debug($prestacion_rgc);exit();
        /**
         * Creamos el PDF
         */
        $fecha = $informe->fecha;
        //debug($fecha);exit();

        $this->viewBuilder()->options([
                'pdfConfig' => [
                    'orientation' => 'portrait',
                    'layout' => 'informe_template',
                    'filename' => 'informe_'.$informe->tipo.'_'.$fecha->i18nFormat("dd-MM-yyyy").'pdf'
                ]
            ]);

        $logo= IMAGES."logo_concejalia.png";
        
//debug($comision);exit();
        $datos_informe = $this->set(compact('informe','ceas', 'prestacion_rgc', 'tedis'));
        if ($validar=="validar") {
            return $datos_informe;
        }
    }



    public function valida($id=null)
    {

            $CakePdf = new \CakePdf\Pdf\CakePdf();
            $CakePdf->templatePath('Informes/pdf');
            $CakePdf->template('informe', 'default');
            $CakePdf->viewVars($this->informe($id,"validar")->viewVars);
//debug($this->informe($id,"validar")->viewVars);exit();
            //debug($this->acta($id,"validar")->viewVars['comision']['fecha']->i18nFormat("dd-MM-yyyy"));exit();
            // Get the PDF string returned
            //$pdf = $CakePdf->output();
            // Or write it to file directly

            /*
            ** Creamos la carpeta INFORMES si no está creada en el expediente.
            */
            $expediente_numedis = $this->informe($id,"validar")->viewVars['informe']['expediente']['numedis'];
            $tipo_informe = $this->informe($id,"validar")->viewVars['informe']['fecha'];
            $fecha_informe = $this->informe($id,"validar")->viewVars['informe']['fecha']->i18nFormat("dd-MM-yyyy");
            
            $root = DOCS.$expediente_numedis;
//debug($root);exit();
             if (!file_exists($root.DS.'informes')) {
                $dir = new Folder($root.DS.'informes', true, 0755);
                $this->Flash->success(__('Se ha creado correctamente la carpeta de informes de este expediente que no exixtía.'));
            } 

            $nombre_archivo = $this->informe($id,"validar")->viewVars['informe']['tipo']."_".$fecha_informe;
            $pdf = $CakePdf->write($root.DS.'informes' . DS . $nombre_archivo.'.pdf');
            
            /*
            ** VALIDAMOS el expediente
            */
            $informe = $this->Informes->get($id, [
                'contain' => [],
            ]);

            $informe = $this->Informes->patchEntity($informe, ['estado'=>'valido']);
            if ($this->Informes->save($informe)) {
                $this->Flash->success(__('Se ha validado el informe correctamente.'));
                return $this->redirect(['action' => 'index', $this->informe($id,"validar")->viewVars['informe']['expediente']['id']]);
            } else {
                $this->Flash->error(__('No ha sido posible validar el informe. Por favor inténtalo de nuevo.'));
            }

            $this->autoRender = false;
    }
}
