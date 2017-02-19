
<h1><i class="fa fa-folder-open"></i>  Expedientes</h1>

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <!-- Barra de Progreso-->
        <div class="progress">
          <div id="bar" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
            <span class="sr-only">0% Complete</span>
          </div>
        </div>

        <script>
            var progreso = 0;
            var idIterval = setInterval(function(){
              // Aumento en 10 el progeso
              progreso +=10;
              $('#bar').css('width', progreso + '%');
                 
              //Si llegó a 100 elimino el interval
              if(progreso == 100){
                clearInterval(idIterval);
                jQuery(document).ready(function($) {
                     $('.progress').addClass('hidden');
                });
               
              }
            },1000);
        </script>



        <h2>Lista completa de los Expedientes registrados en el sistema </h2>

        <?= $this->Element('menus/menu_panel');?>
        
        <div class="clearfix"></div>
      </div>

      <div class="x_content">

        <table id="datatable" class="table table-striped table-bordered" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    
                    <th>Exp. EDIS</th>
                    <th>Historia Social </th>
                    <th>Titular</th>
                    <th>CEAS </th>
                    <th>Domicilio</th>
                    <th>Parrilla</th>
                    <th class="visible-lg">Creado</th>
                    <th class="visible-lg">Modificado</th>
                    <th class="actions"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($expedientes as $expediente): ?>
                <tr>

                    <td class="text-center"><?= $this->Html->link('  '.$expediente->numedis, ['action' => 'view', $expediente->id], ['class' => 'btn btn-sm btn-success fa fa-folder-open', 'target' => '_blank']) ?></td>

                    <td><?= h($expediente->numhs) ?></td>
                    <td class="mayusculas">
                        
                        <?php foreach($expediente->participantes as $key => $participante): ?>
                            <?php if ($participante->relation_id == 1): ?>
                               <?php $indice =  $key;  ?>     
                            <?php endif; ?>
                        <?php endforeach;?>

                        <?= $this->Html->link($expediente['participantes'][$indice]['nombre'].' '.$expediente['participantes'][$indice]['apellidos'], [
                                                'controller'=>'Participantes', 
                                                'action' => 'view', 
                                                $expediente['participantes'][$indice]['id']
                                                ]) ?>                                             
                    </td>

                    <td><?= h($listado_ceas[$expediente->ceas]) ?></td>
                    
                    <td class="text-center">

                        <ul class="nav">    
                            <li class="">
                              <a href="javascript:;" class="dropdown-toggle menu_tabla" data-toggle="dropdown" aria-expanded="false">

                                <span class=" fa fa-home btn btn-xs btn-info"></span>

                              </a>
                              <ul class="dropdown-menu pull-right domicilio ">

                                    <li><h4><?= $expediente->domicilio; ?></h4> </li>

                              </ul>
                            </li>
                        </ul>
                    </td>
                    <td>
                        <ul class="nav">    
                            <li class="">
                              <a href="javascript:;" class="dropdown-toggle menu_tabla" data-toggle="dropdown" aria-expanded="false">

                                <span class=" fa fa-group btn btn-xs btn-info"></span>

                              </a>
                              <ul class="dropdown-menu pull-right parrilla ">
                                  <table class="table">
                                    <thead>
                                        <tr>
                                            <th>DNI/NIE</th>
                                            <th>Nombre y Apellidos</th>
                                            <th>Relacion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($expediente->participantes as $participante): ?>
                                             <tr>
                                                <td><?= $participante->dni; ?></td>
                                                <td class="mayusculas"><?= $participante->nombre." ".$participante->apellidos; ?></td>
                                                <td><?= $participante->relation->nombre; ?></td>
                                            </tr>
                                        <?php endforeach; ?>    
                                    </tbody>
                                  </table>
                              </ul>
                            </li>
                        </ul>
                    </td>
                    <td class="visible-lg"><?= $this->Time->format($expediente->created, "dd/MM/yyyy", null) ?></td>
                    <td class="visible-lg"><?= $this->Time->format($expediente->modified, "dd/MM/yyyy", null) ?></td>
                    
                    <td class="actions">

                        <ul class="nav">    
                            <li class="">
                              <a href="javascript:;" class="dropdown-toggle menu_tabla" data-toggle="dropdown" aria-expanded="false">

                                <span class=" fa fa-angle-down btn btn-xs btn-primary"></span>

                              </a>
                              <ul class="dropdown-menu pull-right actions ">

                                    <li><?= $this->Html->link('', ['action' => 'view', $expediente->id], ['class'=> 'btn btn-xs btn-success fa fa-folder-open']) ?></li>
                                    <li><?= $this->Html->link('', ['action' => 'edit', $expediente->id], ['class'=> 'fa fa-edit btn btn-xs btn-info']) ?></li>
                                    <li>
                                        <?php if ($auth['role'] === 'admin'): ?>    
                                            <?= $this->Form->postLink('', ['action' => 'delete', $expediente->id], ['class'=> 'btn btn-xs btn-danger fa fa-trash', 'confirm' => __('Realmente quieres borrar el registro: # {0}?', $expediente->nombre)]) ?>
                                        <?php endif; ?>       
                                    </li>

                              </ul>
                            </li>
                        </ul>

                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
