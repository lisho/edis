<h1><i class="fa fa-files-o"></i>  Informes

</h1>

<div class="col-md-12 col-sm-12 col-xs-12"> 
    <div class="x_panel"> 
        <div class="x_title"> 
            <h2><i class="icono-titulo-fa fa fa-folder-open"><?= '  '.h($expediente->numedis) ?></i> 

                <?= $this->Html->link('', ['controller'=>'Informes', 
                                            'action' => 'add',
                                            $expediente->id], 
                                            [
                                                'class'=> 'fa fa-plus-square text-info icono-titulo-fa pull-right', 
                                                'id'=>'informes',
                                                'data-container'=>"body",
                                                'data-toggle'=>"popover",
                                                'data-placement'=>"top",
                                                'data-content'=>"Genera un nuevo informe en formato 'borrador'."]) ?> 

                <?= $this->Html->link('', ['controller'=>'Expedientes', 
                                            'action' => 'view',
                                            $expediente->id], 
                                            [
                                                'class'=> 'fa fa-backward text-info icono-titulo-fa pull-right', 
                                                'id'=>'volver',
                                                'data-container'=>"body",
                                                'data-toggle'=>"popover",
                                                'data-placement'=>"top",
                                                'data-content'=>"Volver al expediente  ".$expediente->numedis]) ?> 
            </h2> 
            
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
         
            <div class="row"> 
                   
            </div>         

            <div class="related"> 
                <h4><?= 'Miembros de este Equipo:' ?></h4> 
                <?php if (!empty($informes)): ?> 
                <table id="datatable" class="table table-striped table-bordered" cellpadding="0" cellspacing="0">
                    <thead>
                    <tr> 
                        <th></th>
                        <th><?= 'Tipo de informe'?></th>
                        <th><?= __('Fecha de emisión') ?></th> 
                        <th><?= __('Creado por') ?></th> 
                        <th><?= __('Fecha de Creación') ?></th> 
                        <th><?= __('Última modificación') ?></th> 
                        
                        <th class="actions"><?= __('Actions') ?></th> 
                    </tr> 
                    </thead>
                    <body>
                    <?php foreach ($informes as $informe): ?> 
                    <tr> 
                        <td class="text-center">
                            <?php if ($informe->estado=='borrador'): ?>
                                <i class="fa fa-pencil-square icono-fa warning" id= 'borrador<?= $informe->id?>',
                                                data-container="body",
                                                data-toggle="popover",
                                                data-placement="right",
                                                data-content="Este informe está en estado de 'borrador'."></i>
                            <?php elseif ($informe->estado=='valido'): ?>
                                 <i class="fa fa-check-square icono-fa success" id= 'valido<?= $informe->id?>',
                                                data-container="body",
                                                data-toggle="popover",
                                                data-placement="right",
                                                data-content="Este informe ya ha sido validado."></i>
                            <?php endif; ?>

                        </td> 
                        <td class="text-center"><?= 'Informe de '.h($informe->tipo) ?></td> 
                        <td class="text-center"><?= $this->Time->format($informe->fecha, "dd/MM/yyyy", null) ?> </td> 
                        <td class="text-center"><?= h($informe->user->nombre.' '.$informe->user->apellidos) ?></td> 

                        <td class="text-center"><?= $this->Time->format($informe->created, "dd/MM/yyyy 'a las' HH:mm", null) ?> </td> 
                        <td class="text-center"><?= $this->Time->format($informe->modified, "dd/MM/yyyy 'a las' HH:mm", null) ?> </td> 

                        <td class="actions"> 
                            <?= $this->Html->link('', [ 'action' => 'edit', $informe->id], ['class'=> 'btn btn-xs btn-success fa fa-edit']) ?> 
                            <?= $this->Form->postLink('', ['action' => 'delete', $informe->id], ['class'=> 'btn btn-xs btn-danger fa fa-trash', 'confirm' => __('¿Estás seguro/a de que quieres eliminar este informe?')]) ?> 
                        </td> 
                    </tr> 
                    <?php endforeach; ?> 
                    </body>
                </table> 
 
                <?php endif; ?> 
 
            </div> 
        </div> 
    </div>
</div>
