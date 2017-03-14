


    <ul class="nav ">    
        <li class="">
        <h1><i class="fa fa-folder-open"></i>  Mis Expedientes <small><small>
          <a href="javascript:;" class="dropdown-toggle menu_tabla" data-toggle="dropdown" aria-expanded="false">

            <i class="fa fa-question-circle icono-titulo-fa pull-right"></i>

          </a>
        
          <?= $this->element('leyendas/mis_expedientes'); ?>
        </small></small></h1>  
        </li>
    </ul>
    

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Lista de los expedientes en los que aparece como técnico <?= $auth['nombre'].' '. $auth['apellidos']?> </h2>
        
        <?= $this->Element('menus/menu_panel');?>

        <div class="clearfix"></div>
      </div>

      <div class="x_content">
        
        <table id="datatable" class="table table-striped table-bordered" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    
                    <th>Exp. EDIS</th>
                    <th>ATFIS</th>
                    <th>RGC</th>
                    <th>AUS</th>
                    <th>HS </th>
                    <th>Titular HS</th>
                    <th>CEAS </th>
                    <th>Domicilio</th>
                    <th>Parrilla</th>
                    <th>Mi Rol</th>
                    
                    <!-- <th>Modificado</th> -->
                    <th class="actions"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($expedientes as $expediente): ?>

                    <?php 

                        $cobrando='default';
                        //debug($expediente->expediente->numhs);

                        if(in_array($expediente->expediente->numhs, $hs_en_nomina)){
                            $cobrando = 'success';
                            
                        } else{
                            foreach ($expediente->expediente->participantes as $p){
                                if(in_array($p->dni, $dni_en_nomina)){
                                    $cobrando = 'success';
                                }
                            }
                        }

                        $c_p = '';
/*
                        $clases_por_prestaciones=[];
                        
                        if (isset($mis_pestaciones[$expediente['expediente_id']]['ATFIS'])){ $clases_por_prestaciones[]='atfis'; }
                        if (isset($mis_pestaciones[$expediente['expediente_id']]['RGC'])){ $clases_por_prestaciones[]='rgc'; }
                        if (isset($mis_pestaciones[$expediente['expediente_id']]['AUS'])){ $clases_por_prestaciones[]='aus'; }
                        
                        foreach ($clases_por_prestaciones as $clase) {$c_p = $c_p.' '.$clase; }
*/
                        if ($cobrando == 'success'){ $c_p = 'cobrando negrita text-sombra'; }
                        //debug($c_p);exit();
                    ?>


                <tr class="<?= $c_p;?>">

                    <td class="text-center"><?= $this->Html->link(' '.$expediente->expediente->numedis, ['controller'=>'expedientes', 'action' => 'view', $expediente->expediente->id], ['class' => 'btn btn-sm btn-'.$cobrando.' fa fa-folder-open', 'target' => '_blank']) ?>
                        <?php if ($cobrando == 'success'){ echo '<span class="hidden">cobrando</span>'; } ?>
                    </td>

                    <td class="text-center">
                        
                        <?php 
                            if (isset($mis_pestaciones[$expediente['expediente_id']]['ATFIS'])){ 
                                
                                foreach ($mis_pestaciones[$expediente['expediente_id']]['ATFIS'] as $atfis) {
                                    echo '<big><i class="fa fa-check-circle-o verde"></i></big><span class="hidden">atfis</span>'; 
                                }  
                            }
                        ?>
                    </td>
                    <td class="text-center">

                        <?php 
                            if (isset($mis_pestaciones[$expediente['expediente_id']]['RGC'])){ 
                                
                                foreach ($mis_pestaciones[$expediente['expediente_id']]['RGC'] as $atfis) {

                                    if ($atfis->prestacionestado_id == 1){echo '<big><i class="fa fa-check-circle-o amarillo"></i></big><span class="hidden">rgc</span>'; }
                                    else if ($atfis->prestacionestado_id == 5){echo '<big><i class="fa fa-check-circle-o verde"></i></big><span class="hidden">rgc</span>'; }
                                    
                                }  
                            }
                        ?>
                        
                    </td>
                    <td class="text-center">

                        <?php 
                            if (isset($mis_pestaciones[$expediente['expediente_id']]['AUS'])){ 
                                
                                foreach ($mis_pestaciones[$expediente['expediente_id']]['AUS'] as $atfis) {
                                    echo '<big><i class="fa fa-check-circle-o verde"></i></big><span class="hidden">aus</span>'; 
                                }  
                            }
                        ?>
                        
                    </td>
                    <td><?= h($expediente->expediente->numhs) ?></td>
                    <td>
                        <!-- Iteramos los participantes de cada expediente e imprimimos el titulas de la HS-->
                        <?php foreach ($expediente->expediente->participantes as $participante): ?>
                            <?php if ($participante['relation_id']==1): ?>
                                <?= ucwords($participante['nombre'].' '.$participante['apellidos']) ?>
                            <?php endif ?>
                        <?php endforeach; ?><!--// FIN iteración de los participantes-->
                    </td>
                    <td><?= h($listado_ceas[$expediente->expediente->ceas]) ?></td>
                    <td>                        
                        <ul class="nav">    
                            <li class="">
                              <a href="javascript:;" class="dropdown-toggle menu_tabla" data-toggle="dropdown" aria-expanded="false">

                                <span class=" fa fa-home btn btn-xs btn-info"></span>

                              </a>
                              <ul class="dropdown-menu pull-right domicilio ">

                                    <li><h4><?= h($expediente->expediente->domicilio); ?></h4> </li>

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
                                        <?php foreach($expediente->expediente->participantes as $participante): ?>

                                            <?php $clase_desactivado=''; ?>
                                            <?php if ($participante->desactivado == true): ?>
                                                  <?php $clase_desactivado = 'disabled'; ?>     
                                            <?php endif; ?>

                                             <tr class="<?=$clase_desactivado;?>">
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
                    <td><?= strtoupper($expediente->rol) ?></td>
                    
                    <!-- <td><?= $this->Time->format($expediente->expediente->created, "dd/MM/yyyy", null) ?></td>
                    <td><?= $this->Time->format($expediente->expediente->modified, "dd/MM/yyyy", null) ?></td> -->
                    
                    <td class="actions">
                        <!--
                        <?= $this->Html->link('', ['controller'=>'expedientes', 'action' => 'view', $expediente->expediente->id], ['class'=> 'fa fa-folder-open btn btn-xs btn-success']) ?>
                        -->
                        <?= $this->Html->link('', ['controller'=>'expedientes', 'action' => 'edit', $expediente->expediente->id], ['class'=> 'fa fa-edit btn btn-xs btn-info']) ?>
                        
                        <?php if ($auth['role'] === 'admin'): ?>    
                            <?= $this->Form->postLink('', ['controller'=>'expedientes', 'action' => 'delete', $expediente->expediente->id], ['class'=> 'fa fa-trash btn btn-xs btn-danger', 'confirm' => __('Realmente quieres borrar el registro: # {0}?', $expediente->expediente->nombre)]) ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
 
    </div>
</div>

