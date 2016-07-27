
<h1>Nuevo Equipo.</h1> 
<div class="row"> 
    <div class="col-md-12 col-sm-12 col-xs-12"> 
        <div class="x_panel"> 
            <div class="x_title"> 
                <h2>Crea un nuevo equipo técnico de referencia...</h2> 
                <?= $this->Element('menus/menu_panel');?>                 
                <div class="clearfix"></div> 
            </div> 
            <div class="x_content">     
 
                <!-- Formulario --> 
 
                <?= $this->Form->create($equipo,['class'=>'form-horizontal form-label-left']) ?> 
                 
 
                <fieldset> 
                                         
                    <div class="form-group"> 
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nombre del Equipo <span class="required">*</span></label> 
                        <div class="col-md-6 col-sm-6 col-xs-12"> 
                            <?php 
                                echo $this->Form->input('nombre', [ 
                                        'class'=>'form-control col-md-7 col-xs-12', 
                                        'required' => 'required', 
                                        'label' => ['text' => ''] 
                                    ]); 
                            ?>  
                        </div> 
                    </div> 
 
                    <div class="form-group"> 
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tipo de Equipo <span class="required">*</span></label> 
                        <div class="col-md-6 col-sm-6 col-xs-12"> 
                        <?php 
                            echo $this->Form->select('tipo', ['EDIS'=>'EDIS', 'CEAS'=> 'CEAS'], [ 
                                        'class'=>'form-control col-md-7 col-xs-12', 
                                        'required' => 'required', 
                                        'label' => ['text' => ''], 
                                        'default' => 'EDIS' 
                                    ]); 
                        ?>  
                        </div> 
                    </div> 
 
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Entidad de Referencia <span class="required">*</span></label> 
                    <div class="col-md-6 col-sm-6 col-xs-12"> 
                    <?php 
                        echo $this->Form->input('entidad', [ 
                                        'class'=>'form-control col-md-7 col-xs-12', 
                                        'required' => 'required', 
                                        'label' => ['text' => ''] 
                                    ]); 
                    ?> 
                    </div> 
                </fieldset> 
 
                <div class="ln_solid"></div> 
                <div class="form-group"> 
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"> 
                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success']) ?> 
                <?= $this->Html->link(__('Cancel'), ['action'=>'index'],['class' => 'btn btn-primary']) ?> 
                    </div> 
                </div> 
                
                <?= $this->Form->end() ?> 
                <!-- /Formulario --> 
            </div> 
        </div> 
    </div> 
</div>