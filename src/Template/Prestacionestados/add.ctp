

<h1><i class="fa fa-pencil-square-o"></i>  Gestión de Estados de las Prestaciones.</h1>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Crea un Estado para las prestaciones</h2>
                <?= $this->Element('menus/menu_panel');?>                
                <div class="clearfix"></div>
            </div>
            <div class="x_content">    

                <!-- Formulario -->

                <?= $this->Form->create($prestacionestado,['class'=>'form-horizontal form-label-left data-parsley-validate=""']) ?>
                

                <fieldset>
                                        
                    <div class="form-group has-feedback">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Estado <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php
                                echo $this->Form->input('estado', [
                                        'class'=>'form-control col-md-7 col-xs-12',
                                        'required' =>'required',
                                        'label' => ['text' => '']
                                    ]);
                            ?> 
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripción <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php
                                echo $this->Form->input('descripcion', [
                                        'class'=>'form-control col-md-7 col-xs-12',
                                        //'required' => 'required',
                                        'label' => ['text' => '']
                                    ]);
                            ?> 
                        </div>
                    </div>

                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success']) ?>
                <?= $this->Html->link(__('Cancel'), ['action'=>'add'],['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
               
                <?= $this->Form->end() ?>
                <!-- /END Formulario -->
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Listado de los posibles Estados de las Prestaciones</h2>
                <?= $this->Element('menus/menu_panel');?>                
                <div class="clearfix"></div>
            </div>
            <div class="x_content">    
                <table id="datatable" class="table table-striped table-bordered" cellpadding="0" cellspacing="0">
                    <thead>
                        <tr>
                            
                            <th>id</th>
                            <th>Estado </th>
                            <th>Descripción</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($estados_de_prestacion as $estado): ?>
                        <tr>
                            <td><?= h($estado->id) ?></td>
                            <td><?= h($estado->estado) ?></td>
                            <td><?= h($estado->descripcion) ?></td>
                            
                            <td class="actions">
                                <? // $this->Html->link('', ['action' => 'view', $estado->id], ['class'=> 'btn btn-xs btn-success fa fa-folder-open']) ?>
                                <?= $this->Html->link('', ['action' => 'edit', $estado->id], ['class'=> 'fa fa-edit btn btn-xs btn-info']) ?>
                             <?php if ($auth['role'] === 'admin'): ?>    
                                <?= $this->Form->postLink('', ['action' => 'delete', $estado->id], ['class'=> 'btn btn-xs btn-danger fa fa-trash', 'confirm' => __('¿Realmente quieres borrar este estado de prestación?')]) ?>
                            <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>