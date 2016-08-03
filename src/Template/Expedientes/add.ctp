<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Expedientes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Participantes'), ['controller' => 'Participantes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Participante'), ['controller' => 'Participantes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add']) ?></li>
    </ul>
</nav>


<h1>Nuevo Expediente.</h1>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Crea un nuevo expediente en el sistema...</h2>
                <?= $this->Element('menus/menu_panel');?>                
                <div class="clearfix"></div>
            </div>
            <div class="x_content">    

                <!-- Formulario -->

                <?= $this->Form->create($expediente,['class'=>'form-horizontal form-label-left data-parsley-validate=""']) ?>

    <fieldset>
        
        <div class="form-group has-feedback">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Número de Expediente EDIS <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <?php
                    echo $this->Form->input('numedis', [
                            'class'=>'form-control col-md-7 col-xs-12',
                            'required' =>'required',
                            'label' => ['text' => '']
                        ]);
                ?> 
            </div>
        </div>

        <div class="form-group has-feedback">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Número de Expediente RGC <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <?php
                    echo $this->Form->input('numrgc', [
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
                                                    'empty'   => 'Elije un Ceas'
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
                                                    'empty'   => 'Elije un Coordinador de Caso'
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
                                                    'required' => 'required',
                                                    'label' => ['text' => ''],
                                                    'empty'   => 'Elije un Técnico de Inclusión'
                                                ]);
                ?> 
            </div>
        </div>











        
        <?php
            
            echo $this->Form->input('ceas', [
                                                    'type' => 'select',
                                                    'class'=>'form-control col-md-7 col-xs-12',
                                                    'default' => '',
                                                    'required' => 'required',
                                                    'label' => ['text' => ''],
                                                    'options' => $listado_ceas,
                                                ]);
            
            echo $this->Form->input('role.0.tecnico.id', [
                                                    'type' => 'select',
                                                    'class'=>'form-control col-md-7 col-xs-12',
                                                    'default' => '',
                                                    'required' => 'required',
                                                    'label' => ['text' => ''],
                                                    'multiple' => true,
                                                    //'options' => $tecnicoList,
                                                ]);

            //echo $this->Form->input('Roles.tecnico_id', ['type'=>'select', ]);
            echo $this->Form->input('Roles.rol');
            echo $this->Form->input('Roles.observaciones');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
