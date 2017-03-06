<h2>Bienvenido a la app</h2>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
          <div class="x_title">
            
			<h1>MESA DE TRABAJO <small>DE <?= $auth['nombre'].' '.$auth['apellidos'];?></small></h1>

            <div class="clearfix"></div>
          </div>

          <div class="x_content ">
  			<div class="col-md-12 col-sm-12 col-xs-12">
          	<div class="row">
	          	
	        <?php if ($auth['role']!='auxiliar'): ?> 
	          	<div class="col-md-2 col-sm-6 col-xs-12 text-center">

	          	 <?= $this->Html->link('<button type="button" class="btn btn button_home text-center"
	          	 													id="ir_comisiones",
                                                                    data-container="body",
                                                                    data-toggle="popover",
                                                                    data-placement="bottom",
                                                                    data-content="Accede a la Gestión de las Comisiones.">
					          				<h1><i class="fa fa-briefcase"></i>
						          			<p ></p></h1>
						          		</button>', 
	          	 		['controller'=> 'Comisions', 'action'=>'index'],['escape' => false]); ?>


	          	</div>
	          	<div class="col-md-2 col-sm-6 col-xs-12 text-center">
	          		<?= $this->Html->link('<button type="button" class="btn btn button_home text-center"
	          	 													id="ir_mis_expedientes",
                                                                    data-container="body",
                                                                    data-toggle="popover",
                                                                    data-placement="bottom",
                                                                    data-content="Mis Expedientes.">
					          				<h1><i class="fa fa-folder"></i>
						          			<p ></p></h1>
						          		</button>', 
	          	 		['controller'=> 'Roles', 'action'=>'mis_roles'],['escape' => false]); ?>

	          	</div>   	
	        <?php endif; ?>
	          	<div class="col-md-2 col-sm-6 col-xs-12 text-center">
	          		<?= $this->Html->link('<button type="button" class="btn btn button_home text-center"
	          	 													id="buscar_administracion",
                                                                    data-container="body",
                                                                    data-toggle="popover",
                                                                    data-placement="bottom",
                                                                    data-content="Accede al modulo de administracion">
					          				<h1><i class="fa fa-search"></i>
						          			<p ></p></h1>
						          		</button>', 
	          	 		['controller'=> 'Expedientes', 'action'=>'administracion'],['escape' => false]); ?>

	          	</div>


	        <?php if ($auth['role']!='auxiliar'): ?> 	          	
	          	<div class="col-md-2 col-sm-6 col-xs-12 text-center">
	          		<button type="button" class="btn button_home"><h2>prueba</h2></button>
	          	</div>
	          	<div class="col-md-2 col-sm-6 col-xs-12 text-center">
	          		<button type="button" class="btn button_home"><h2>prueba</h2></button>
	          	</div>
	          	<div class="col-md-2 col-sm-6 col-xs-12 text-center">
	          		<button type="button" class="btn button_home"><h2>prueba</h2></button>
	          	</div>
	        <?php endif; ?> 

		    </div>	
		    </div>
        </div>
    </div>
</div>

<div class="col-md-6 col-sm-12 col-xs-12">

    <div class="x_panel" id="nomina"> <!--/ Panel de NOMINAS-->
        <div class="x_title"> 
            <big><i class="icono-fa fa fa-briefcase"></i> Mis expedientes en las últimas comisiones (en construcción...)</big>
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

            <div class="clearfix"></div> 
            <div class="related"> 

            	<!-- Iteramos cada comisión -->
               	<?php foreach ($mis_ultimas_comisiones as $comision): ?>

               		<h2><?= $this->Html->link('Comisión de '. $comision->tipo . ' ('. $comision->fecha .').',['controller' => 'Comisions', 'action'=>'view', $comision->id]);?></h2>
               			<!-- Iteramos cada PASO por comisión -->
               			<?php foreach ($comision->pasacomisions as $paso): ?>
               				<!-- en cada iteración miramos si existe nuestro rol asociado a ese expediente -->
               				<?php if (!empty($paso->expediente->roles)): ?>
               					
           						<li>
           							<big>
           								<?= $this->Html->link($paso->expediente->numedis,['controller' => 'Expedientes', 'action'=>'view', $paso->expediente->id]);?>
           							</big>
           						</li>
           							<ul>
           								<!-- Si existe el rol iteramos las prestaciones abiertas y las pintamos -->
           								<?php foreach ($paso->expediente->prestacions as $prestacion): ?>	
           									<li><?= $prestacion->numprestacion; ?> -> <?= $prestacion->participante->nombre.' '.$prestacion->participante->apellidos ; ?></li>
           								<?php endforeach; ?>
           							</ul>
               					 
               				<?php endif; ?>
               	
               			<?php endforeach; ?>

               	<?php endforeach; ?>  <!-- END FOREACH Comisiones--> 
               	<div class="clearfix"></div>   
            </div> 

        </div> 
    </div><!--/ FIN Panel Nóminas-->
	
</div>

<!--
                    <?= $this->element('nominas/comparar_ultima_nomina',[   'datos_nominas'=>$datos_nominas,
                                                                            'expediente'=>$expediente,
                                                                            'listado_participantes'=>$listado_participantes,
                                                                            'listado_nombres_parrilla' => $listado_nombres_parrilla,
                                                                            'participante' => $participante

                                                                        ]);
                                                                    ?> 
                                                                    --> 