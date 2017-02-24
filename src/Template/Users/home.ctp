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
	          	<div class="col-md-2 col-sm-6 col-xs-12 text-center">
	          		<?= $this->Html->link('<button type="button" class="btn btn button_home text-center"
	          	 													id="ir_mis_expedientes",
                                                                    data-container="body",
                                                                    data-toggle="popover",
                                                                    data-placement="bottom",
                                                                    data-content="Accede al modulo de administracion">
					          				<h1><i class="fa fa-search"></i>
						          			<p ></p></h1>
						          		</button>', 
	          	 		['controller'=> 'Expedientes', 'action'=>'administracion'],['escape' => false]); ?>

	          	</div>
	          	<div class="col-md-2 col-sm-6 col-xs-12 text-center">
	          		<button type="button" class="btn button_home"><h2>prueba</h2></button>
	          	</div>
	          	<div class="col-md-2 col-sm-6 col-xs-12 text-center">
	          		<button type="button" class="btn button_home"><h2>prueba</h2></button>
	          	</div>
	          	<div class="col-md-2 col-sm-6 col-xs-12 text-center">
	          		<button type="button" class="btn button_home"><h2>prueba</h2></button>
	          	</div>
		    </div>	
		    </div>
        </div>
    </div>
</div>
