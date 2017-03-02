<h1><i class="fa fa-external-link"></i>  Traslado de usuarios entre expedientes</h1>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
 
                <?= $this->Element('menus/menu_panel');?> 

                <h2>Cambio de expediente de <?= $participante->nombre.' '.$participante->apellidos;?>. Selecciona una forma de trasladar al usuario:</h2>              
                <div class="clearfix"></div>

            </div>

            <div class="x_content">
        		<fieldset>
			        
			        <label><big>
			            <input type="radio" name="existe_expediente" class="desplegar_form_expediente" id="radio1" value="si" checked="checked"> Conozco el número de expediente EDIS al que quiero trasladar a este usuario.
			        </big></label>
			        
			    </fieldset>
            	<div id="formulario_traslado">
			           
				    <!--Formulario SIN crear un nuevo expediente -->

		    		<?php echo $this->Form->create(null, ['url' => ['controller' => 'Participantes', 'action' => 'edit', $participante->id]]); ?>
			    	
			    	<div class="bloque-formulario">	 

			    		<div class="form-group has-feedback">

				    		<label class="control-label col-md-3 col-sm-3 col-xs-12">Número de Expediente EDIS de destino para </br><?= $participante->nombre.' '.$participante->apellidos;?> <span class="required"></span></label>
						    <div class="col-md-6 col-sm-6 col-xs-12">
					    		<?php
			                        echo $this->Form->input('expediente_numedis', [
			                                'class'=>'form-control col-md-7 col-xs-12',
			                                'required' => 'required',
			                                'label' => ['text' => ''],
			                            ]);
			                    ?>
			                    
			                </div>
			            </div>  
			            </br></br>
			        	<div class="form-group has-feedback">
			                <label class="control-label col-md-3 col-sm-3 col-xs-12">Relación con el Titular del expediente de destino: <span class="required">*</span></label>
		                    <div class="col-md-6 col-sm-6 col-xs-12">
		                        <?php
		                            echo $this->Form->input('relation_id', [
		                                                            'type' => 'select',
		                                                            'class'=>'form-control col-md-7 col-xs-12',
		                                                            'default' => '',
		                                                            'required' => 'required',
		                                                            'label' => ['text' => ''],
		                                                            'options' => $listado_relaciones,
		                                                            'empty'   => 'Selecciona una relación con el titular...'
		                                                        ]);
		                        ?> 
		                    </div>
		                </div>

		                	</br></br></br>  
			                     <?= $this->Form->button('CAMBIAR DE EXPEDIENTE', ['class' => 'btn btn-success btn-lg', 'id'=>'crea_expediente' ]); ?>
			                
			       
			        </div>

                 	<?php echo $this->Form->end(); ?>   

		    	</div>

				<!--Formulario para crear un nuevo expediente -->
				<fieldset>
					<br>
			        <label><big>
			            <input type="radio" name="existe_expediente" class="desplegar_form_expediente" id="radio2" value="no" > Necesito crear un nuevo expediente para trasladar a este usuario. 
			        </big></label>
				</fieldset>
				<div id="formulario_nuevo_expediente" class="hidden">
				 	
				    <?= $this->Form->create($expediente,[
				                        'class'=>'form-horizontal form-label-left',
				                        'role'=>'form', 'id'=>'nuevo_expediente', 
				                        'data-toggle'=>'validator', 
				                        'novalidate'
				                        ]) ?>

			        <div class="bloque-formulario">
			        	<h3>Crea un nuevo expediente y asociarás automáticamente a <strong><?= $participante->nombre.' '.$participante->apellidos;?></strong> como titular.</h3>
			            <div id="numedis_recomentdado" class="text-center">
			                <h2>Número de Expediente EDIS asignado al nuevo expediente:
			                    <div id="ver_nuevo_numedis" class="btn btn-lg btn-primary"><b><?= $proximo_numedis; ?></b></div>
			                </h2>
			            </div>
			            
			            <div id="nuevo_numedis" class="form-group hidden">
			                <span id="label_propuesta_numedis" class="label label-info"><?= $proximo_numedis; ?></span>
			                <label class="control-label col-md-3 col-sm-3 col-xs-12">Número de Expediente EDIS <span class="required">*</span></label>
			                <div class="col-md-6 col-sm-6 col-xs-12">
			                    <?php
			                        echo $this->Form->input('numedis', [
			                                'class'=>'form-control col-md-7 col-xs-12',
			                                'id' => 'numedis',
			                                'required' =>'',
			                                'label' => ['text' => ''],
			                                'value' => $proximo_numedis
			                            ]);
			                    ?> 
			                </div>
			               <!-- <div id="resultados"></div> -->
			            </div>

			            <div class="form-group has-feedback">
			                <label class="control-label col-md-3 col-sm-3 col-xs-12">Número de Historia Social (SAUSS) <span class="required">*</span></label>
			                <div class="col-md-6 col-sm-6 col-xs-12">
			                    <?php
			                        echo $this->Form->input('numhs', [
			                                'class'=>'form-control col-md-7 col-xs-12',
			                                'required' =>'required',
			                                'label' => ['text' => '']
			                            ]);
			                    ?> 
			                </div>
			            </div>

			            <div class="form-group has-feedback">
			                <label class="control-label col-md-3 col-sm-3 col-xs-12">Domicilio <span class="required">*</span></label>
			                <div class="col-md-6 col-sm-6 col-xs-12">
			                    <?php
			                        echo $this->Form->input('domicilio', [
			                                'class'=>'form-control col-md-7 col-xs-12',
			                                'required' =>'required',
			                                'id' => 'domicilio',
			                                'label' => ['text' => '']
			                            ]);
			                    ?> 
			                </div>
			            </div>

			            <div class="form-group has-feedback">
			                <label class="control-label col-md-3 col-sm-3 col-xs-12">CEAS de Referencia <span class="required">*</span></label>
			                <div class="col-md-6 col-sm-6 col-xs-12">
			                    <?php
			                        echo $this->Form->input('ceas', [
			                                                        'type' => 'select',
			                                                        'class'=>'form-control col-md-7 col-xs-12',
			                                                        'default' => '',
			                                                        'id'=> 'ceas',
			                                                        'required' => 'required',
			                                                        'label' => ['text' => ''],
			                                                        'options' => $listado_ceas,
			                                                        'empty'   => 'Elije un CEAS',
			                                                        'value' => 'elige un CEAS...'
			                                                    ]);
			                    ?> 
			                </div>
			            </div>

			            <div class="form-group has-feedback">
			                <label class="control-label col-md-3 col-sm-3 col-xs-12">Coordinador de Caso (CC) <span class="required">*</span></label>
			                <div class="col-md-6 col-sm-6 col-xs-12">
			                    <?php
			                        echo $this->Form->input('tecnico_ceas', [
			                                                        'type' => 'select',
			                                                        'class'=>'form-control col-md-7 col-xs-12',
			                                                        'id' => 'tecnico_ceas',
			                                                        'default' => '',
			                                                        'required' => 'required',
			                                                        'label' => ['text' => ''],
			                                                        //'options' => $tecnicoList,
			                                                        'empty'   => '-----'
			                                                    ]);
			                    ?> 
			                </div>
			            </div>

			            <div class="form-group has-feedback">
			                <label class="control-label col-md-3 col-sm-3 col-xs-12">Técnico de Inclusión (TEDIS) <span class="required">*</span></label>
			                <div class="col-md-6 col-sm-6 col-xs-12">
			                    <?php
			                        echo $this->Form->input('tecnico_inclusion', [
			                                                        'type' => 'select',
			                                                        'class'=>'form-control col-md-7 col-xs-12',
			                                                        'id' => 'tecnico_inclusion',
			                                                        'default' => '',
			                                                        //'required' => 'required',
			                                                        'label' => ['text' => ''],
			                                                        'empty'   => '-----'
			                                                    ]);
			                    ?> 
			                </div>
			            </div>

			            <div class="form-group">
			                <label class="control-label col-md-3 col-sm-3 col-xs-12">Observaciones sobre este EXPEDIENTE <span class="required">*</span></label>
			                <div class="col-md-6 col-sm-6 col-xs-12">
			                    <?php
			                        echo $this->Form->input('observaciones', [
			                                'class'=>'editor form-control col-md-7 col-xs-12',
			                                //'required' => 'required',
			                                'label' => ['text' => '']
			                            ]);
			                    ?> 
			                </div>
			            </div>

			            <br><br>

			                <?= $this->Form->button('CREA UN NUEVO EXPEDIENTE Y TRASLADA AL USUARIO', ['class' => 'btn btn-success btn-lg', 'id'=>'crea_expediente' ]) ?>

			        </div> <!-- // FIN bloque-formulario-->

				    <?= $this->Form->end() ?>  
				 </div> <!-- END FORMULARIO Nuevo Expediente-->
			</div>
		</div>
	</div>
</div>



<script>

	$('.desplegar_form_expediente').click(function(event) {
		if ($('#radio1').is(':checked')) { 

			$('#formulario_nuevo_expediente').addClass('hidden');
			$('#formulario_traslado').removeClass('hidden');
		}
		else if ($('#radio2').is(':checked')){ 

			$('#formulario_nuevo_expediente').removeClass('hidden');
			$('#formulario_traslado').addClass('hidden');
		}
	});

</script>