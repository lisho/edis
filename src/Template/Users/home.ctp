<script>
  
    function mis_pasos(pasos, comision) {
      $('#badge'+comision).text(pasos); 
      console.log ('pasos:'+pasos);
      console.log ('comision:'+comision);
    }

    function insertar_fecha(f, identificador) {

      var fecha = new Date(f);
      var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };

      fecha = fecha.toLocaleDateString("es-ES", options);

      $('#fecha_'+identificador). html('<big class="check_grande">'+fecha+'</big>');
    }



</script>

<!--
*************************** BOTONERA SUPERIOR  ***********************************
-->

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

<!--
*************************** BLOQUE DE CONTENIDO SUPERIOR  ***********************************
-->


  <div class="col-md-6 col-sm-12 col-xs-12"> <!-- Inicio Bloque de últimas comisiones-->

    <div class="x_panel" id="nomina"> <!--/ Panel de ultimas comisiones-->
        <div class="x_title"> 
            <big><i class="icono-fa fa fa-briefcase"></i> Mis expedientes en las últimas comisiones </big>
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
                <?php 
                    $pasos = 0; 
                    $validada = 'no-validada';
                    if($comision['validada'] == true){
                      $validada = 'validada';
                    }
                  ?>

                  <article class="media event">

                     <div class="sombra">
                        <a class="pull-left date date-grande text-center">
                          <!--<i class="icono-fa fa fa-briefcase aero"></i>-->
                          <big><b class=""><?= $comision->tipo; ?></b></big>
                          <span class="badge <?= $validada;?>" id='badge<?= $comision->id; ?>'></span>
                        </a>
                                               
                        <div class="media-body">
                          <a id='fecha_<?= $comision->id; ?>' class="title" href="javascript:;" data-toggle="collapse" data-target="#collapse<?= $comision->id; ?>" aria-expanded="false" aria-controls="collapsecollapse<?= $comision->id; ?>">
                            <big></big> </a>
                        </div>
                      </div> 

                      <div class="collapse" id="collapse<?= $comision->id; ?>" >
                     			<!-- Iteramos cada PASO por comisión -->
                     			<?php foreach ($comision->pasacomisions as $paso): ?>
                     				<!-- en cada iteración miramos si existe nuestro rol asociado a ese expediente -->
                     				<?php if (!empty($paso->expediente->roles)): ?>

                                 <!-- Si aparece nuestro rol imprimimos la tarjeta -->
                                <div class="tarjeta sombra">	
                                  
                                  <?php $pasos++; ?>
                     							<h2>
                                      <i class="fa fa-folder-open"></i>
                     								 <strong><?= $this->Html->link('Expediente: '.$paso->expediente->numedis,['controller' => 'Expedientes', 'action'=>'view', $paso->expediente->id], ['class' => 'texto_blanco', 'target' => '_blank']);?></strong>
                     							</h2>

                                  <p><b>Observaciones:</b> <?= $paso->observaciones; ?></p>
                                  <p><b>Prestaciones abiertas en edisemos:</b></p>

                     							<ul> 
                       							<?php if($comision->tipo == 'AUS'): ?>
                                        <button type="button" class="btn btn-primary pull-right">citar</button>
                                    <?php endif; ?>
                                    
                                    <!-- Si existe el rol iteramos las prestaciones abiertas y las pintamos -->
                      								<?php foreach ($paso->expediente->prestacions as $prestacion): ?>	
                     									<li><?= $prestacion->numprestacion; ?> -> <?= $prestacion->participante->nombre.' '.$prestacion->participante->apellidos ; ?></li>
                     								<?php endforeach; ?>

                     							</ul>
                         				</div> <!--// FIN Tarjeta -->
                              
                       			<?php endif; ?> <!--// FIN IF de busqueda de rol para imprimir tarjeta -->
                     	    
                     			<?php endforeach; ?> <!--/ FIN de la comisión -->
                          
                      </div> <!-- Fin Collapse -->
                    </article>

                    <script> 
                          var p = '<?= $pasos; ?>';
                          mis_pasos(p,'<?= $comision->id; ?>'); 
                          var f = "<?= $comision->fecha->i18nFormat('yyyy-MM-dd'); ?>";
                          insertar_fecha(f, '<?= $comision->id; ?>');
                    </script>

            	   <?php endforeach; ?>  <!-- END FOREACH Comisiones --> 

               	<div class="clearfix"></div>   

            </div> <!--/ FIN related -->
        </div> <!--/ FIN content -->
    </div><!--/ FIN Panel Nóminas -->
	
  </div>



  <div class="col-md-6 col-sm-12 col-xs-12"> <!-- Inicio Bloque de Cámbios de la Última Comisión-->

    <div class="x_panel" id="nomina"> <!--/ Panel de ultimas comisiones-->
        <div class="x_title"> 
            <big><i class="icono-fa fa fa-money"></i> Cambios detectados en mis expedientes (entre <?= $ultima_nomina; ?> y <?= $penultima_nomina; ?>)</big>
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
                <?php foreach ($mis_cambios as $key => $cambio): ?>
                  <?php 
                    $pasos = 0; 

                    switch ($key) {
                      case 'domicilio':
                        $tipo_cambio = 'Cambios de domicilio <small>(existen diferencias entre los domicilios de las 2 nóminas)</small>';
                        $ico ='<i class="fa fa-home"></i>';
                        break;
                      case 'nuevo_expediente':
                        $tipo_cambio = 'Nuevos expedientes <small>(aparece nuevo en nómina este mes)</small>';
                        $ico ='<i class="fa fa-plus-circle"></i>';
                        break;
                      case 'bajas_nomina':
                        $tipo_cambio = 'Bajas en nómina detectadas <small>(desarapece de nómina resecto al més anterior)</small>';
                        $ico ='<i class="fa fa-minus-circle"></i>';
                        break;
                    }

                  ?>

                  <article class="media event">

                    <div class="sombra">
                      <a class="pull-left date date-grande text-center">
                        <!--<i class="icono-fa fa fa-briefcase aero"></i>-->
                        <big><b class=""><?= $ico; ?></b></big>
                      </a>                                           

                      <div class="media-body">
                        <a id='tipo<?= $key; ?>' class="title" href="javascript:;" data-toggle="collapse" data-target="#collapse<?= $key; ?>" aria-expanded="false" aria-controls="collapsecollapse<?= $key; ?>">
                          <span class="badge badge-grande" id='badge<?= $key; ?>'></span>
                          <big><big><?= $tipo_cambio;?></big></big> </a>
                      </div>  
                    </div>
                        
                    
                    <div class="collapse col-md-12 col-sm-12 col-xs-12" id="collapse<?= $key; ?>" >
                    
                        <!-- Iteramos cada tipo de cambio -->
                        <?php foreach ($cambio as $rgc => $c): ?>
                          <!-- en cada iteración miramos si existe nuestro rol asociado a ese expediente -->
                          <?php if (!empty($c)): ?>

                               <!-- Si aparece nuestro rol imprimimos la tarjeta -->
                              <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="tarjeta sombra">  

                                  <?php $pasos++; ?>
                                  <h2>
                                    <i class="fa fa-folder-open"></i>
                                    <strong><?= $this->Html->link($c['datos_bd']['numedis'],['controller' => 'Expedientes', 'action'=>'view', $c['datos_bd']['expediente_id']], ['class' => 'texto_blanco', 'target' => '_blank']);?></strong>

                                  </h2>

                                  <?php if ($key == 'domicilio'): ?>
                                       
                                      <?php $hs= '---'; ?>
                                      <?php if (!empty($c['nuevo']['HS'])): ?>
                                             <?php $hs = $c['nuevo']['HS'];?>
                                      <?php endif; ?>
                                      
                                      <p class="pull-right"><b>HS:</b> <?= $hs; ?> </p>
                                      <p><b>Nº RGC:</b> <?= $rgc; ?></p>

                                      <p><b>Titular de RGC:</b> </p><p>
                                        <p class="text-center"><?= $c['nuevo']['titular']['dni']; ?></p>
                                        <p class="text-center"><big><strong><?= $c['nuevo']['titular']['nombre']; ?></strong></big></p>
                                      </p>
                                      <p><b>Ha cambiado de dirección a:</b></p>
                                        <p class="text-success text-center"><?= $c['nuevo']['domicilio']; ?></p>
                                      <p><b>procedente de :</b></p>
                                        <p class="text-center"><?= $c['antiguo']['domicilio']; ?></p>

                                      <?php $cambia_ceas = "No hay cambio de CEAS"; ?>  
                                      <?php if ($c['antiguo']['ceas'] != $c['nuevo']['ceas']): ?>
                                          <?php $cambia_ceas = "Cambia del ".$c['antiguo']['ceas']." al <b class='verde'> ".$c['nuevo']['ceas']."</b>"; ?>   
                                      <?php endif; ?>

                                      <p class="well text-center"><?= $cambia_ceas;?></p>

                                  <?php else: ?> 

                                      <?php $hs= '---'; ?>
                                      <?php if (!empty($c['HS'])): ?>
                                             <?php $hs = $c['HS'];?>
                                      <?php endif; ?>
                                      
                                      <p class="pull-right"><b>HS:</b> <?= $hs; ?> </p>
                                      <p><b>Nº RGC:</b> <?= $rgc; ?></p>

                                      <p><b>Titular de RGC:</b> </p>
                                        <p class="text-success text-center"><?= $c['titular']['dni']; ?></p> 
                                        <p class="text-success text-center">
                                          <big><strong>
                                            <?= $c['titular']['nombre']; ?>
                                          </strong></big>
                                        </p>

                                      <p><b>Domicilio:</b></p>
                                      <p class="text-success text-center"><?= $c['domicilio']; ?></p>
                                      <p class="text-success text-center"><?= $c['ceas'];?></p>

                                  <?php endif; ?>

                                </div>  
                              </div> <!--// FIN Tarjeta -->
                            
                          <?php endif; ?> <!--// FIN IF de busqueda de rol para imprimir tarjeta -->
                        
                        <?php endforeach; ?> <!--/ FIN de la comisión -->
                      
                    </div> <!-- Fin Collapse -->
                          
                    </article>

                    <script> 
                          var p = '<?= $pasos; ?>';
                          mis_pasos(p,'<?= $key; ?>'); 
                          
                    </script>

              <?php endforeach; ?>  <!-- END FOREACH Comisiones --> 
                <div class="clearfix"></div>   
            </div> 

        </div> 
    </div><!--/ FIN Panel Nóminas -->
  
  </div>



 <!--// Inicio Modal_NOVEDADES-->

    <div id="modal_entrar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h1>Últimas novedades</h1>
                    <h2 id="fecha_novedades" class="pull-right"></h2>
                </div>
                <div class="modal-body modal-body-tecnico">
                  <h2 id="titulo"></h2>
                  <div id="novedades"></div>
                    
                </div>

                <!-- <div class="modal-footer modal-footer-tecnico"></div> -->  

            </div>
        </div>
    </div>


<script>
 
  $(function() {


        $('#modal_entrar').modal();

        $.ajax({
          url: url_json+"avisos/novedades",
          //type: 'POST',
          dataType: 'json',
          data: {param: 'ultima'},
          success : function(json){

            var fecha = new Date(json.created);
            var options = { year: 'numeric', month: 'long', day: 'numeric' };
            fecha = fecha.toLocaleDateString('es-ES', options);
            $('#fecha_novedades').text(fecha);
            $('#titulo').html(json.titulo);
            $('#novedades').html(json.description);
          }
        })
        .done(function() {
          console.log("success");
        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
        });

  });



</script> 

