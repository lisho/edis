<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

use Cake\I18n\I18n;

I18n::locale('es_ES');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
      
        $this->loadComponent('Auth', [
                'authorize' => ['Controller'],
                'authenticate' => [
                    'Form' => [
                        'fields' => [
                            'username' => 'user',
                            'password' => 'password'
                            ]
                        ]
                    ],
                'loginAction' => [
                    'controller' => 'Users',
                    'action' => 'login'
                    ],
                'autrhError' => 'Debe introducir datos correctos...',
                'loginRedirect' => [
                    'controller' => 'Users',
                    'action' => 'home'
                    ],
                'logoutRedirect' => [
                    'controller' => 'Users',
                    'action' => 'login'
                    ],
                'authError' => '¿Crees que puedes entrar sin loguearte?... Pues NO!',
            ]);

    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event)
    {
        $this->Auth->allow(['index', 'view', 'display']);
         
        $this->set('auth', $this->Auth->user()); //Con esta linea pasamos $auth a las vistas.
        $this->set('ultimos_avisos', $this->ultimosAvisos(5)); //Con esta linea pasamos $auth a las vistas.

        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
 
    }

    public function isAuthorized($user)
    {
        return true;
    }

    /**
    *
    * 
    * @return Devuelve los avisos y las noticias publicadas
    *       por el usuario logueado.
    **/

    public function ultimosAvisos($num)
    {
        $this->loadModel('Avisos');
        $ultimos_avisos = $this->Avisos->find('all')
                    -> contain('Users')
                    -> limit($num)
                    -> order('Avisos.created DESC')
                    -> where(['Avisos.tipo' => 'aviso']);

        return $ultimos_avisos;

        //debug(Avisos::mis_avisos());exit();
        //return $this->ultimosAvisos($num);
    }

    /**
     * Listado de los Equipos segun el tipo que pasamos
     *
     * 
     */
        public function listadoEquipo($tipo=null)
    {
        $this->loadModel('Equipos');
        $listado = [];
        $listado = $this->Equipos->findByTipo($tipo);
        foreach ($listado as $l) {
            //debug($l);exit();
            $listado_tipo[$l->id] = $l->nombre;
        }

        return $listado_tipo;
    }
    
    /**
     * Listado de todos los tecnicos
     *
     * 
     */
        public function listadoTecnicos($expediente_id=null)
    {
        $this->loadModel('Tecnicos');
        $listado = [];
    
            $listado = $this->Tecnicos->find('all');
            foreach ($listado as $l) {
                //debug($l);exit();
                $listado_tecnicos[$l->id] = $l->nombre.' '. $l->apellidos;
                }

        return $listado_tecnicos;
    }

    /**
     * Listado de Posibles titulares de Prestacion
     *
     * Miembros de la unidad familiar mayores de 16 años
     */
        public function listadoMiembrosParrilla($expediente_id=null)
    {
        $this->loadModel('Participantes');
        $listado_parrilla = [];
    
            $listado = $this->Participantes->find('all',[
                                    'conditions' => ['expediente_id'=>$expediente_id],
                                    'order' => 'relation_id',
                                ]);

            foreach ($listado as $l) {

                if ($this->calcularEdad($l->nacimiento)>15 || $this->calcularEdad($l->nacimiento)===null) {
                    $listado_parrilla[$l->id] = $l->nombre.' '. $l->apellidos;
                }
            }

        return $listado_parrilla;
    }

    /**
     * Listado de las posibles relaciones entre los participantes
     *
     * 
     */
        public function listadoRelaciones($expediente_id=null)
    {
        $this->loadModel('Relations');
        $listado = [];
    
            $listado = $this->Relations->find('all');
            foreach ($listado as $l) {
                //debug($l);exit();
                $listado_relaciones[$l->id] = $l->nombre;
                }

        return $listado_relaciones;
    }

    /**
     * Calcular la EDAD
     *
     * Necesitamos pasar la fecha de nacimiento y nos devuelve un integral.
     */
        public function calcularEdad($nacimiento=null)
    {
        if ($nacimiento!=null) {
            $nac_format = $nacimiento->i18nFormat('yyyy-MM-dd');
            $fecha = time() - strtotime($nac_format);
            $edad = floor($fecha / 31556926);

            /*$dias = explode("/", $nacimiento, 3);
            $dias = mktime(0,0,0,$dias[1],$dias[0],$dias[2]);
            $edad = (int)((date('now')-$dias)/31556926 );*/
            return $edad;
        }        
    } 

    /**
     * Redimensionar foto proporcionalmente
     *
     * Necesitamos pasar la foto y nos devuelve la foto redimensionada.
     */
        public function redimensionar($file=null)
    {
          
        $nueva_anchura = 220; // Definimos el tamaño a 100 px 

          //Separamos las extenciones de archivos para definir el tipo de ext. 
        $extension = explode(".",$file); 
        $ext = count($extension)-1; 
        //Determinamos las extenciones permitidas. 
        if($extension[$ext] == "jpg" || $extension[$ext] == "jpeg") 
        { 
            $image = ImageCreateFromJPEG($file); 
        } 
        else if($extension[$ext] == "gif"){ 
            $image = ImageCreateFromGIF($file); 
        } 
        else if($extension[$ext] == "png"){ 
            $image = ImageCreateFromPNG($file); 
        } 
        else 
        { 
            echo "Error, extension no permitida"; 
        die(); 
        } 

        $thumb_name = substr($file,0,-4);//nombre del thumbnail 
        $width = imagesx($image);//ancho 
        $height = imagesy($image);//alto 

        
        $nueva_altura = ($nueva_anchura * $height) / $width ; // tamaño proporcional 

        if (function_exists("imagecreatetruecolor")) 
        { 
            $thumb = ImageCreateTrueColor($nueva_anchura, $nueva_altura);//Color Real 
        } 
        //En caso de no encontrar la funcion, la saca en calidad media 
        if (!$thumb) $thumb = ImageCreate($nueva_anchura, $nueva_altura); 

        ImageCopyResized($thumb, $image, 0, 0, 0, 0, $nueva_anchura, $nueva_altura, $width, $height); 
        //header("Content-type: image/jpeg"); 
        ImageJPEG($thumb, "".$thumb_name.".jpg", 99); 
        imagedestroy($image); 

        return $image; 
    }  

    /**
     * Ajustar una fecha para formatearla para Guardarla en la BD
     *
     * @return Fecha formateada en un array.
     */

    public function ajustarFecha($fecha=null)
    {
        $cachos_fecha_apertura = preg_split("/[\/]+/", $fecha);
            $fecha_ajustada=array(
                        'year'=>$cachos_fecha_apertura[2],
                        'month'=>$cachos_fecha_apertura[1],
                        'day' =>$cachos_fecha_apertura[0] 
                );
        return $fecha_ajustada;
    }

    /**
     * Contar las veces que se repiten los valores de un array
     *
     * @return array valor => veces que se repite
     */
    public function contarValoresArray($array=null)
    {
        
        $contar=array();
     
        foreach($array as $value)
        {
            if(isset($contar[$value]))
            {
                // si ya existe, le añadimos uno
                $contar[$value]+=1;
            }else{
                // si no existe lo añadimos al array
                $contar[$value]=1;
            }
        }
        return $contar;

    }

    /**
     * eliminar un valor de un array
     * 
     * @param $array, $valor y $useOldKeys (TRUE si queremos que mantenga las key)
     * @return array sin los valores eliminados
     */
    public function eliminarValoresArray($array=null, $valor=[], $useOldKeys = FALSE)
    {
    
    if (!is_array($valor)) {$valor[]=$valor; }
            
    foreach ($array as $key => $a) {
        if (in_array($a, $valor)) {unset($array[$key]);}
    }
  
    if(!$useOldKeys){
        $array = array_values($array);
    }

    return $array;

    }

    /**
     * Datos de las nóminas de un expediente
     *
     * @param $hs : Número de Historia Social.
     * @return array asociativo con todos los datos de las nóminas re-ordenados.
     * 
     */

    public function cruceNomina($hs=null)
    {
        $participantes_ultima_nomina = [];
        $count_nominas = [];
        $this->loadModel('Nominas');
        $mis_nominas = $this->Nominas->find('all', ['conditions' => [
                                'HS' => $hs,
                            ]
                        ]);

        if ($mis_nominas!=[]) {

            $mis_nominas_array = $mis_nominas->toArray();
            $cuentas_nomina = count($mis_nominas_array);
            $mi_ultima_nomina = end($mis_nominas_array);
            $ultima_nomina = $this->ultima();
            $ultima_nomina = $ultima_nomina[0];
//debug($ultima_nomina);exit();
            foreach ($mis_nominas as $nomina) {

                //explotamos la fecha de nómina en un array
                $n_descompuesto = explode(' ',$nomina->fechanomina);

                //sacamos meses y años de cobro y los colocamos en un array asociativo
                $n = $this->eliminarValoresArray($n_descompuesto, ['', 'de']);
                $lista_n[$n[1]][] = $n[0];
                
                //contamos las personas que cobran cada mes de cada año
                $count_nominas[$n[1]] = array_count_values($lista_n[$n[1]]);

                // Si es la ultima nomina, sacamos los datos para el array
                if ($nomina['fechanomina']===$mi_ultima_nomina['fechanomina']) {
                    $participantes_ultima_nomina[]=['dni'=>$nomina->dni,
                                                    'nombrecompleto' => $nomina->nombrecompleto,
                                                    'sexo' => $nomina->SEXO,
                                                    'nacionalidad' => $nomina->NACIONALIDAD,
                                                    'relacion_titular' => $nomina->relacion,
                                                ];
                    //$nombres_ultima_nomina[] = $nomina->nombrecompleto;
                } 
                
            }


            // Datos de uno de los usuarios de este expediente en la última nómina cargada.
            $m_n['ultima_nomina'] = $mi_ultima_nomina;
            $m_n['datos_ultima_nomina'] = $ultima_nomina; 
            $m_n['todas_mis_nominas'] = $mis_nominas_array;
            $m_n['meses_nomina'] = $count_nominas;
            $m_n['cuentas_nominas'] = $cuentas_nomina;
            $m_n['participantes_ultima_nomina'] = $participantes_ultima_nomina;
            $m_n['cuenta_paicipantes_ultima_nomina'] = count($m_n['participantes_ultima_nomina']);
            //$m_n['nombres_ultima_nomina'] = $nombres_ultima_nomina; 
            
        }
            
            return  $m_n;
    }


    /**
     * generarNomina method
     *
     * @param $mes $año
     * @return array con la nómina de ese mes
     * 
     */

    public function generarNomina($mes=null, $año=null)
    {
        $this->loadModel('Nominas');
        $fecha = getdate();
        $lista_nominas = $this->Nominas->find()
                    ->where(['fechanomina LIKE' => '%'.$mes.'%'])
                    ->andWhere(['fechanomina LIKE' => '%'.$año.'%']);

        $lista_nominas = $lista_nominas->toArray();

        return $lista_nominas;
    }


    /**
     * Desplegar la última nómina
     *
     * @param $mes_nomina 
     * @return array
     * 
     */

    public function ultima()
    {
        $this->loadModel('Nominas');
        $c = 1; // Contador para restar meses buscando la ultima nómina.
        $mes = array("enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");
        $fecha_actual = getdate();

        while (empty($ultima_nomina)) {
           $ultima_nomina = $this->generarNomina($mes[$fecha_actual['mon']-$c], $fecha_actual['year']);
           $c++;
        }
        return $ultima_nomina;
        $this->set(['lista_nominas'=>$ultima_nomina]);       

    }

     /**
     * 
     * Limpia espacios en blanco de la cadena que le pasemos.
     */

    public function limpiarEspacios($cadena=null)
    {
        $cadena = str_replace(' ', '', $cadena);
        return $cadena;
    }

}
