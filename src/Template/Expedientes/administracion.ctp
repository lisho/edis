<h1><i class="fa fa-database"></i>  Administracion EDIS</h1>
       
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">

      	<!-- Barra de Progreso-->
        <?= $this->Element('herramientas/barra_progreso'); ?>

        <h2>Burcador de Usuarios: </h2>

        <?= $this->Element('menus/menu_panel');?>
        
        <div class="clearfix"></div>
      </div>

      	<div class="x_content">

	      	<div class="bloque-formulario">

		      	<div class="row">		
		      		
		      		<div class="col-md-1 col-sm-1 col-xs-1">
		      			<i class="fa fa-search icono-titulo-fa"></i>
		      		</div>	

		      		<div class="col-md-11 col-sm-11 col-xs-11">
			      		<!-- Buscador de Usuarios -->	
			  		    <div class="input-group">
			                <input id="s-admin" type="text" class="form-control" placeholder="Buscar a..." autocomplete="off">
			                <span class="input-group-btn">
			                  <button class="btn btn-default " type="button"><i class="fa"></i></button>
			                </span>
			            </div>
			        </div>
			    </div>	
	      	</div>	

      		<div id="datos_invisible" class="col-md-12 col-sm-12 col-xs-12 hidden">
      			<div class="x_panel sombra">
      				<div class="x_content">
		      			<div id="datos-expediente">

			      			<h1 id="numedis" class="titulo"></h1><hr>

			      			<div class="row">
			      				<div class="col-md-9 col-sm-7 col-xs-12">
					      			<h2 id ="domicilio"><i class="fa fa-home"></i>  Domicilio: <big><strong><span></span></strong></big></h2>
					      			<h2 id ="ceas"><i class="fa fa-building-o"></i>  CEAS de Referencia: <big><strong><span></span></strong></big></h2>
				      			</div>
				      			<div class="col-md-3 col-sm-5 col-xs-12 text-right">
				      			


				      			<?= $this->Html->link('  Incidencia', '#',['class' => 'btn btn-primary btn-lg fa fa-edit btn_modal_incidencia', 'id'=>"btn_modal_incidencia"]) ?>
				      			
				      			</div>
			      			</div>
			      			

			      			<div id="tedis">
			      				<h2><i class="fa fa-user"></i>  Tedis de Referencia: </h2>
			      				<big><strong><ul></ul></strong></big>
			      			</div>
			      			<div id="parrilla">
			      				<h2><i class="fa fa-group"></i>   Parrilla familiar: </h2>
			      				<div id="datos_parrilla">
			      					
			      				</div>
			      			</div>
		      				
		      			</div>
		      			<div id="incidencias">
		      				<br>
		      				<h2><strong><i class="fa fa-pencil-square-o"></i>   Mis incidencias anteriores:</strong> </h2>
		      				<div id="datos_incidencias"></div>
		      			</div>
		      			
		      		</div>
	      		</div>
      		</div>

		</div> <!-- END Contenido-->
	</div> <!-- END Panel-->

</div>


<!-- INICIO MODAL Para modificar el telefono-->

    <div id="modal_editar_telefono" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 id="" class="modal-title" id="myModalLabel">Modifica el telefono para: </h4>
                    <h4 id="editar_telefono" class="modal-title" id=""></h4>
                </div>
                <div class="modal-body">
                		<input type="text" class="form-control" id="numero_telefono">
     
                </div>
                <div class="modal-footer">
                    
                    <?= $this->Html->link('Guardar cambios', ['#'],['class' => 'btn btn-success','data-dismiss'=>"modal", 'id'=>"boton_cambiar_telefono"]) ?>
                    
                </div>
            </div>
        </div>
    </div>         


<!-- INICIO MODAL añadir incidenc-->

    <div id="modal_add_incidencia" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 id="" class="modal-title" id="myModalLabel">Modifica el telefono para: </h4>
                    <h4 id="editar_telefono" class="modal-title" id=""></h4>
                </div>
                <div class="modal-body">
	                <form class="form-horizontal form-label-left" accept-charset="utf-8">

	                     <div class="form-group">
	                        <label class="control-label">Fecha</label>
	                        <div class="">
	                            <?php

	                                echo $this->Form->input('fecha', [
	                                        'type'=>'text',
	                                        'default' => date('d/m/Y'),
	                                        'dateFormat' => 'DMY',
	                                        'class'=>'datepicker form-control col-md-7 col-xs-12',
	                                        //'required' => 'required',
	                                        'label' => ['text' => ''],
	                                        'placeholder' => '_ _ / _ _ / _ _ _ _'
	                                        //'templates'=>['dateWidget' => '{{day}}{{month}}{{year}}']
	                                    ]);
	                            ?> 
	                        </div>
	                    </div>                   
	                    <div class="form-group">
	                        <label class="control-label">Tipo <span class="required">*</span></label>
	                        <div class="">
	                            <?php
	                                echo $this->Form->input('incidenciatipo_id', [
	                                        'type' => 'select',
	                                        'id' => 'tipos_incidencia',
	                                        'class'=>'form-control col-md-7 col-xs-12',
	                                        'default' => '',
	                                        'required' => 'required',
	                                        'label' => ['text' => ''],
	                                        'options' => [],
	                                        'empty'   => 'Selecciona un tipo de incidencia...'
	                                    ]);
	                            ?> 
	                        </div>
	                    </div>

	                    <div class="form-group">
	                        <label class="control-label">Descripción <span class="required">*</span></label>
	                        <div class="">
	                            <?php
	                                echo $this->Form->textarea('descripcion', [
	                                    'class'=>'editor form-control col-md-7 col-xs-12',
	                                    'id' => 'descripcion',
	                                    //'required' => 'required',
	                                    'label' => ['text' => '']
	                                ]);
	                            ?> 
	                        </div>
	                    </div>

	                    <?php $this->Form->input('expediente_id', ['type'=>'hidden', 'value'=>'']);?>
	                    <?php $this->Form->input('user_id', ['type'=>'hidden', 'value'=>$auth['id']]);?>

	                </form>
                </div>
                <div class="modal-footer">
                    
                    <?= $this->Html->link('Guardar cambios', ['#'],['class' => 'btn btn-success','data-dismiss'=>"modal", 'id'=>"boton_add_incidencia"]) ?>
                    
                </div>
            </div>
        </div>
    </div>   



    <script>
    	
    	$(function() {
    			// --> ************** BUSCADOR DE ADMINISTRACION *************************************************************************

    		var rol = '<?= $auth["role"]; ?>';

			$('#s-admin').autocomplete ({
				minLength: 3,
				select:function(event, ui){
					$('#s-admin').val(ui.item.label);
				},

				source:function(request, response){
					$.ajax({
						url:url_json+"expedientes/administracion",
						data:{
							term:request.term
						},
						dataType: "json",
						success: function(data){
							response($.map(data,function(el,index){
								return{
									value:el.nombre+' '+el.apellidos,
									nombre:el.nombre,
									apellidos:el.apellidos,
									dni: el.dni,
									id: el.id,
									expediente:el.expediente
								};
							}));
						}
					});
				}

			}).data("ui-autocomplete")._renderItem = function(ul, item){
				return $("<li style='display:block'></li>")
				.addClass('fa fa-arrow-circle-right')
				.data("item.autocomplete", item)
				.append("<a id = "+item.dni+" href='#'>"+" "+item.dni +" - "+ item.nombre +" "+ item.apellidos + "</a>")
				.click(function() {
					var id = item.id;
					var cabecera_parrilla = '<table id="datatable" class="table table-striped table-bordered" cellpadding="0" cellspacing="0"><thead><tr><th>DNI/NIE</th><th>Nombre</th><th>Relacion</th><th>Teléfono</th><th></th></tr></thead><tbody></tbody></table>';
					$('#datos_invisible').hide('drop').fadeIn('slow').removeClass('hidden');

					// Cargamos el resto de los datos después de hacer click en el nombre

					$.ajax({
						
						url:url_json+"expedientes/datosAdministracion",
						data: {id:id},
						dataType: "json",
						success : function(json){

							var numedis = json.expediente.numedis;
							if (rol != 'auxiliar') {
								$('#numedis').html('').append('Expediente: <a href="view/'+json.expediente.id+'" title="" target="_blank">'+numedis+'</a>');
							} else {
								$('#numedis').html('').append('Expediente: '+numedis);
							}

							$('#domicilio span').html('').append(json.expediente.domicilio);

							// Ajax para obteber el CEAS y la ZAS.

							$.ajax({
								type: "POST",
									url: url_json+"equipos/datosceas",
									data: "ceas="+json.expediente.ceas,
									cache: false,
									success: function(ceas) {
										$('#ceas span').html('').append(ceas.nombre);
										//console.log(ceas);
									}
							});

							// Mostrar la Parrilla

							$('#datos_parrilla').html('').append(cabecera_parrilla);

							$.each(json.expediente.participantes, function(i, val) {
								 $('<tr><td>'+json.expediente.participantes[i].dni
								 			+'</td><td><strong><big>'
								 			+json.expediente.participantes[i].nombre+' '
								 			+json.expediente.participantes[i].apellidos
								 			+'</big><strong></td><td>'+json.expediente.participantes[i].relation.nombre
								 			+'</td><td id="casilla_telefono'+i+'" class="warning"><strong><big>'+json.expediente.participantes[i].telefono
								 			+'</big><strong></td><td class="text-center"><a href="#" id = "'+json.expediente.participantes[i].dni+'" class="btn btn-xs btn-info btn-modal btn_modal_telefono" data-i="'+i+'""><i class="glyphicon glyphicon-phone-alt"></i></a></td></tr>').appendTo('#datos_parrilla table tbody');

							});

							// Mostrar Tedis

							$('#tedis ul').html('');
							$.each(json.expediente.roles, function(i, val) {

								if (json.expediente.roles[i].rol == "tedis") {
									$('<p class="success">'+json.expediente.roles[i].tecnico.nombre+' '+json.expediente.roles[i].tecnico.apellidos+'</p>').appendTo('#tedis ul')
								}
							});

							// Mostrar las Incidencias
								
							mostrar_incidencias(json.expediente.incidencias, rol);

							// Boton MODAL CAMBIAR TELEFONO

							$('.btn_modal_telefono').click(function() {

							 	// Editar el telefono
							 	z = $(this).attr("data-i");
							 	$('#modal_editar_telefono').modal();
							 	$('#editar_telefono').html(""). append('<strong>'
							 			+json.expediente.participantes[z].nombre+' '
							 			+json.expediente.participantes[z].apellidos+'</strong>');
							 	var telefono = $('#casilla_telefono'+z).text();
							 	$('#numero_telefono').val(telefono);
							 	
							 	$('#boton_cambiar_telefono').click(function() {

							 		var nuevo_telefono = $('#numero_telefono').val();
							 		//var telefono = $('#numero_telefono').val();
							 		//console.log(telefono);
									$.ajax({
										type: "POST",
											url: url_json+"participantes/editTelefono",
											data: {id:json.expediente.participantes[z].id,
													telefono:nuevo_telefono},
											cache: false,
											success: function() {
												//console.log(data);
												//json.expediente.participantes[i].telefono = telefono;
												$('#casilla_telefono'+z).html('<strong><big>'+nuevo_telefono+'</strong></big>');
											}
									});
							 	});
							});

							// Boton MODAL CAMBIAR Incidencia

							$('#btn_modal_incidencia').click(function() {

								$('#modal_add_incidencia').modal();

								$('#tipos_incidencia').val('');
								//$('#descripcion').attr('value','');
								$('.jqte_editor').text("");

								$('#boton_add_incidencia').click(function(e) {
									e.preventDefault();
									//e.stopPropagation();
									e.stopImmediatePropagation();
									var fecha = $('#fecha').val();
									var tipo = $('#tipos_incidencia').val();
									var descripcion = $('#descripcion').val();
									var user = '<?php echo $auth["id"]; ?>';

									$.ajax({
										type: "POST",
											url: url_json+"incidencias/add_json",
											data: {	fecha:fecha,
													incidenciatipo_id:tipo,
													descripcion:descripcion,
													user_id:'<?php echo $auth["id"]; ?>',
													expediente_id:json.expediente.id
												},
											dataType: "json",
											cache: false,
											success: function(incidencias) {

												mostrar_incidencias(incidencias, rol);
												$('.modal').modal('hide');
												
											}
									});

								});

								//console.log(telefono);
							});



						} //-->END SUCCESS
						
					}); //-->END AJAX

				})
				.appendTo(ul);	
			}; // --> Fin Buscador	

		// ---- Cargamos los datos del select de los tipos de incidencia ----
			$.ajax({
				type: "POST",
					url: url_json+"incidenciatipos/listaTipos",
					data: [],
					cache: false,
					success: function(lista) {
						//console.log(listaTipos);
						$.each(JSON.parse(lista), function(index, val) {
							//$('<option value="index">val</option>').appendTo('select #tipos_incidencia')
							$('#tipos_incidencia').append('<option value="' + index + '">' + val + '</option>');
						});
						
						//item.expediente.participantes[i].telefono = telefono;
						//$('#casilla_telefono'+z).html('<strong><big>'+nuevo_telefono+'</strong></big>');

					}
			});
    	});

		function mostrar_incidencias(expediente, rol) {
			$('#datos_incidencias').html('');

			$.each(expediente, function(index, val) {
				var user_id = '<?php echo $auth["id"]; ?>';
				if (rol == 'auxiliar') {

					if (val.user_id == user_id) {
						//formateamos la fecha:
						var options = {weekday: "long", year: "numeric", month: "long", day: "numeric"};
						var fecha = new Date(val.fecha);
						fecha = fecha.toLocaleDateString("es-ES", options);

						//$('#datos_incidencias').html(fecha);

						$('<blockquote><h2>'+val.incidenciatipo.tipo+'   <small>-  <strong>'+fecha+'</strong></small></h2>'
							+'<blockquote>'+val.descripcion+'</blockquote>'
							+'</blockquote>')
							.appendTo('#datos_incidencias');
						 //console.log(item.expediente.incidencias[index].);
					}

				} else {

					//formateamos la fecha:
					var options = {weekday: "long", year: "numeric", month: "long", day: "numeric"};
					var fecha = new Date(val.fecha);
					fecha = fecha.toLocaleDateString("es-ES", options);

					//$('#datos_incidencias').html(fecha);

					$('<blockquote><h2>'+val.incidenciatipo.tipo+'   <small>-  <strong>'+fecha+'</strong></small></h2>'
						+'<blockquote>'+val.descripcion+'</blockquote>'
						+'</blockquote>')
						.appendTo('#datos_incidencias');
					 //console.log(item.expediente.incidencias[index].);
				}

			});
		}

    </script>