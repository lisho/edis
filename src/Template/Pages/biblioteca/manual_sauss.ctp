
<?php	
	//$this->layout = 'frontend';
?>


<h1><i class="fa fa-coffee"></i>  Funcionalidades en SAUSS para Equipos de 2º nivel- EDIS</h1>

<div class="col-md-12 col-sm-12 col-xs-12"> 

      <div class="x_panel"> <!-- Panel de datos de expediente-->
              <div class="x_title"> 
                  <h2><i class=" fa fa-book">  Documentación </i></h2> 
                  <ul class="nav navbar-right panel_toolbox"> 
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> 
                    </li> 
                    <li class="dropdown"> 
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a> 
                      <ul class="dropdown-menu" role="menu"> 
                        <li><a href="#">Settings 1</a> 
                        </li> 
                        <li><a href="#">Settings 2</a> 
                        </li> 
                      </ul> 
                    </li> 
                    <li><a class="close-link"><i class="fa fa-close"></i></a> 
                    </li> 
                  </ul> 
                  <div class="clearfix"></div> 
              </div> 
       
              <div class="x_content">       

                  <ul>
                        <?php $options=['target' => '_blank'];?>

                        <li><i class="fa fa-file-pdf-o"></i><?= $this->Html->link('    Manual Sauss. Guia de uso Módulo para Equipos de Inclusión Social.(v.01)', '/webroot/sauss/docs/Guía_de_uso_Apoyo de Inclusión Social_Técnico_EDIS_v01.pdf', $options); ?></li>
                        <li><i class="fa fa-file-word-o"></i><?= $this->Html->link('    Nuevas funcionalidades en SAUSS para los Equipos Multidisciplinares Específicos. ', '/webroot/sauss/docs/NUEVAS FUNCIONALIDADES EN SAUSS PARA LOS EQUIPOS MULTIDISCIPLINARES ESPECIFICOS.docx', $options); ?></li>
                        <li><i class="fa fa-file-pdf-o"></i><?= $this->Html->link('    Resumen de Prestación/Actuación CEAS - EDIS . ', '/webroot/sauss/docs/presentacion.pdf', $options); ?> </li>
                        <li><i class="fa fa-file-pdf-o"></i><?= $this->Html->link('    Indicaciones para derivación de CEAS a Equipos de segundo nivel y para la grabación de prestaciones/actuaciones y valoraciones específicas de estos equipos.', '/webroot/sauss/docs/funcionalidades.pdf', $options); ?> </li>
                        <li><i class="fa fa-file-picture-o"></i><?= $this->Html->link('    Caso práctico Formación SAUSS.', '/webroot/sauss/docs/casopractico.jpg', $options); ?> </li>

                  </ul>

                  <br>
                  <div class="text-center">
                        <a href="https://saussfor.jcyl.es/formacion/" title="" target="_blank" class="btn btn-lg btn-primary">Acceder al SAUUS de Pruebas</a>
                        <p>Usuario: FORAYLE01</p>
                        <p>Contraseña: FORAYLE01</p>
                  </div>
                  
              </div>
      </div>  

</div>

<div class="col-md-12 col-sm-12 col-xs-12"> 

      <div class="x_panel"> <!-- Panel de datos de expediente-->
              <div class="x_title"> 
                  <h2><i class=" fa fa-sitemap">  Funcionalidades SAUSS CEAS </i></h2> 
                  <ul class="nav navbar-right panel_toolbox"> 
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> 
                    </li> 
                    <li class="dropdown"> 
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a> 
                      <ul class="dropdown-menu" role="menu"> 
                        <li><a href="#">Settings 1</a> 
                        </li> 
                        <li><a href="#">Settings 2</a> 
                        </li> 
                      </ul> 
                    </li> 
                    <li><a class="close-link"><i class="fa fa-close"></i></a> 
                    </li> 
                  </ul> 
                  <div class="clearfix"></div> 
              </div> 
       
              <div class="x_content">       

                  <h2>Flujo de la prestación 401035 - Asesoramiento a CEAS para la Inclusión Social.</h2>
                 <?= $this->Html->image('../sauss/diagrama1.png', ['class'=> 'img-responsive']); ?> <hr>

                 <h2>Flujo de la prestación 401036 - Desivación para la VALORACIÓN de situación de Inclusión Social.</h2>
                 <?= $this->Html->image('../sauss/diagrama2.png', ['class'=> 'img-responsive']); ?> <hr>
                 
                 <h2>Flujo de la prestación 401023 - Derivación para el APOYO TECNICO personal y familiar para la Inclusión Social.</h2>
                 <?= $this->Html->image('../sauss/diagrama3.png', ['class'=> 'img-responsive']); ?> <hr>

                  <h2>Prestaciones específicas de los EDIS en SAUSS.</h2>
                 <?= $this->Html->image('../sauss/resumen.png', ['class'=> 'img-responsive']); ?> <hr>

              </div>

      </div>  

</div>