<h1><i class="fa fa-suitcase">   Panel de Gestión de Comisiones...</i>
<?= $this->Html->link('', '#', [     
                                    'class'=> 'btn btn-xs modal-btn btn-info fa fa-plus pull-right',
                                    'id'=>'add_comision',
                                    'data-container'=>"body",
                                    'data-toggle'=>"popover",
                                    'data-placement'=>"left",
                                    'data-content'=>"Añade una nueva comisión..."]) ?>
</h1>

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
          <div class="x_title">
            <h2>Últimas comisiones</h2>
            <div class="clearfix"></div>
          </div>

          <div class="x_content">
  
                    <?php foreach ($ultimas_comisiones as $comision): ?>
                        <a href="comisions/view/<?= $comision->id; ?>">
                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                           
                                <div class="icon"> 
                                 <i class="fa fa-caret-square-o-right"></i>
                                </div>
                           
                            <div class="count"><?= $this->Time->format($comision->fecha, "dd/MM/yyyy", null) ?></div>
                                <h3><?= h($comision->tipo) ?>
                                <button class="btn btn-primary" type="button">
                                  <span class="badge"> <?= count($comision->pasacomisions);?> </span>
                                </button>
                                </h3>
                            </div>
                          </div>
                        </a>
                    <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Si la comisión ya está creada pica en ella para acceder para gestionar los casos y los asistentes. Si no está creada, <strong>puedes crearla desde aquí...</strong>
        </h2>
        
        <?= $this->Element('menus/menu_panel');?>
        
        <div class="clearfix"></div>
      </div>

      <div class="x_content">

        <table id="datatable" class="table table-striped table-bordered" cellpadding="0" cellspacing="0">

            <thead>
                <tr>
                    <th></th>
                    <th>Fecha</th>
                    <th>Comisión de...</th>
                    <th>Observaciones </th>
                    <th></th>
                    
                </tr>
            </thead>
            <tbody>
                <?php foreach ($comisions as $comision): ?>
                <tr>
                    <td>
                        <?= $this->Html->link('', ['action' => 'view', $comision->id], ['class'=> 'btn btn-xs btn-success fa fa-caret-square-o-right btn btn-xs']) ?>
                    </td>
                    <td>
                        <?= $this->Time->format($comision->fecha, "dd/MM/yyyy", null) ?>
                    </td>
                    <td><?= h($comision->tipo) ?></td>
                    <td><?= h($comision->observaciones) ?></td>
                    <td>
                        <?= $this->Html->link('', ['action' => 'edit', $comision->id], ['class'=> 'fa fa-edit']); ?> 
                        <?= $this->Form->postLink('', ['controller' => 'Comisions', 'action' => 'delete', $comision->id], ['class'=> 'fa fa-trash', 'confirm' => '¿Realmente quieres eliminar esta comisión?. Si lo haces eliminarás todos los datos asociados a la misma... ¡Para siempre!']); ?> 
                    </td>
                    
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div>

<!-- MODAL Crear Comisión-->
<div id="modal_add_comision" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><strong>Crea una nueva comisión... </strong></h4>
            </div>
            <div class="modal-body">
                
                <?= $this->Form->create($nueva_comision,[
                                           // 'url' => ['controller' => 'Comisions', 'action' => 'index'], 
                                            'class'=>'form-horizontal form-label-left data-parsley-validate=""'
                                            ]); ?>

                    <?php

                            echo $this->Form->input('id', [
                                    'type' =>'hidden',
                                ]);
                        ?> 

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha de la comisión <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php

                            echo $this->Form->input('fecha', [
                                    'type'=>'text',
                                    //'dateFormat' => 'DMY',
                                    'class'=>'datepicker form-control col-md-7 col-xs-12',
                                    'label' => ['text' => ''],
                                    'placeholder' => '_ _ / _ _ / _ _ _ _'
                                    
                                ]);
                        ?> 
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo de comisión <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php

                            echo $this->Form->input('tipo', [
                                    'type' => 'radio',
                                            'options'=>[
                                                ['value'=>'RGC', 'text'=>'RGC'], ['value'=>'AUS', 'text'=>'AUS']],
                                            'templates' => [
                                                'radioWrapper' => '<div class="radio-inline screen-center screen-radio">{{label}}</div>'
                                            ], 
                                            'label' =>['text' => ''],
                                            //'label' => ["class" => "radio"]

                                ]);
                        ?> 
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Observaciones sobre esta comisión <span class="required">*</span></label>
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
 
            </div>
            <div class="modal-footer">
                <?= $this->Form->button('Guardar cambios ->', ['class' => 'btn btn-success']) ?>
                <?= $this->Html->link('Cerrar', ['action'=>'index'],['class' => 'btn btn-primary','data-dismiss'=>"modal"]) ?>
                
            </div>
               
                <?= $this->Form->end() ?>
        </div>
    </div>
</div>