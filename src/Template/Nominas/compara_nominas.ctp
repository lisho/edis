

<h1><i class="fa fa-money"></i> Cambios detectados en la Última Nómina <small> ( Comparativa entre <?= $penultima_nomina.' y '.$ultima_nomina; ?> ) </small> </h1>

<!-- Barra de Progreso -->  
<?= $this->element ('herramientas/barra_progreso'); ?>

<div class="col-md-12 col-sm-12 col-xs-12"> 
    <div class="x_panel"> 
        <div class="x_title"> 
            <h2><i class="fa fa-home"></i>  Cambios de domicilio detectados <?= count($cambios['domicilio']);?></h2> 
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
                               
            <?php foreach ($cambios['domicilio'] as $num_rgc => $calles): ?> 
            <div class="col-md-6 col-sm-12 col-xs-12">     
                <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title">Expediente RGC: <b> <?= $num_rgc; ?></b></h3>
                      </div>
                      <div class="panel-body panel-body-cambios">
                        <h3><?= $calles['nuevo']['titular']['nombre'];?></h3>
                        <p>Historia Social: <?= $calles['nuevo']['HS'];?></p>
                        <p>Expediente EDIS:
                            <?php if (!isset($calles['datos_bd']['numedis'])): ?>
                                   <big><i class="fa fa-warning text-danger"></i></big>
                            <?php else: ?>
                                <?= $this->Html->link($calles['datos_bd']['numedis'], ['controller'=>'Expedientes', 'action' => 'view', $calles['datos_bd']['expediente_id']], [     
                                    'class'=> 'btn btn-info btn-xs','target' => '_blank',
                                    'id'=>'add_comision'.$num_rgc,
                                    'data-container'=>"body",
                                    'data-toggle'=>"popover",
                                    'data-placement'=>"top",
                                    'data-content'=>"Accede a este expediente..."]) ?>
                            <?php endif; ?></p>
                        <p>Clasificación: <b><?= $calles['nuevo']['clasificacion'];?></b></p>
                        <p>Ha cambiado de domicilio a <b> <?= $calles['nuevo']['domicilio'];?> </b> </p>
                        <p>procedente de <b><?= $calles['antiguo']['domicilio'];?></b></p>

                        <?php if ($calles['antiguo']['ceas']!=$calles['nuevo']['ceas']): ?>
                            <p class="success-text">y pasará del <?= $calles['antiguo']['ceas']; ?> al <?= $calles['nuevo']['ceas']; ?> </p>
                        <?php else: ?>
                            pero <i class="rojo">no hay cambio de CEAS</i>.
                        <?php endif; ?>

                      </div>
                      <div class="panel-footer panel-footer-cambios"> TEDIS de Referencia: 
                          <?php if (!isset($calles['datos_bd']['rol']) || empty($calles['datos_bd']['rol'])): ?>
                                <big><i class="fa fa-warning text-danger"></i></big>
                          <?php else: ?>
                                <?php foreach($calles['datos_bd']['rol'] as $tedis): ?>
                                    <?php if($tedis['rol']=='tedis'){ echo $tedis['tecnico']['nombre'].' '.$tedis['tecnico']['apellidos'];} ?>
                                <?php endforeach; ?>            
                          <?php endif; ?>


                       </div>
                </div>
            </div>

            <?php endforeach; ?>     
        </div> 
    </div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12"> 
    <div class="x_panel"> 
        <div class="x_title"> 
            <h2><i class="fa fa-folder-open"></i>  Nuevos Expedientes (Inicios de cobro, reanudaciones y traslados desde otro municipio). <?= count($cambios['nuevo_expediente']);?> </h2> 
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
            <h3>Nuevos expedientes en nómina:  </h3>
                                
            <?php foreach ($cambios['nuevo_expediente'] as $num_rgc => $datos): ?> 
            <div class="col-md-6 col-sm-12 col-xs-12">     
                <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title">Expediente RGC: <b> <?= $num_rgc; ?></b></h3>
                      </div>
                      <div class="panel-body panel-body-cambios">
                        <h3><?= $datos['titular']['nombre'];?></h3>
                        <p>Historia Social: <?= $datos['HS'];?></p>
                        <p>Expediente EDIS:
                            <?php if (!isset($datos['datos_bd']['numedis'])): ?>
                                   <big><i class="fa fa-warning text-danger"></i></big>
                            <?php else: ?>
                            <?= $this->Html->link($datos['datos_bd']['numedis'], ['controller'=>'Expedientes', 'action' => 'view', $datos['datos_bd']['expediente_id']], [     
                                    'class'=> 'btn btn-info btn-xs','target' => '_blank',
                                    'id'=>'add_comision'.$num_rgc,
                                    'data-container'=>"body",
                                    'data-toggle'=>"popover",
                                    'data-placement'=>"top",
                                    'data-content'=>"Accede a este expediente..."]) ?>
                            <?php endif; ?></p>
                        <p>Clasificación: <b><?= $datos['clasificacion'];?></b></p>
                        <p>Último técnico de referencia: <b>
                            <?php if (!isset($datos['datos_bd']['rol']) || empty($datos['datos_bd']['rol'])): ?>
                                  <big><i class="fa fa-warning text-danger"></i></big>
                            <?php else: ?>
                                  <?php foreach($datos['datos_bd']['rol'] as $tedis): ?>
                                      <?php if($tedis['rol']=='tedis'){ echo $tedis['tecnico']['nombre'].' '.$tedis['tecnico']['apellidos'];} ?>
                                  <?php endforeach; ?>            
                            <?php endif; ?>
                        </b></p>
                        <p>Domicilio a <b> <?= $datos['domicilio'];?> </b> </p>
                        <p></p>

                      </div>
                      <div class="panel-footer panel-footer-cambios"> <?= $datos['ceas'];?> </div>
                </div>
            </div>

            <?php endforeach; ?>     
        </div> 
    </div>
</div>


<div class="col-md-12 col-sm-12 col-xs-12"> 
    <div class="x_panel"> 
        <div class="x_title"> 
            <h2><i class="fa fa-folder"></i>  Expedientes eliminados (Suspensiones, extinciones y traslados hacia otro municipio).  <?= count($cambios['bajas_nomina']);?></h2> 
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
            <h3>Expedientes eliminados de nómina:  </h3>
                                
            <?php foreach ($cambios['bajas_nomina'] as $num_rgc => $baja ): ?> 
            <div class="col-md-6 col-sm-12 col-xs-12">     
                <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title">Expediente RGC: <?= $num_rgc;?></h3>

                      </div>
                      <div class="panel-body panel-body-cambios">
                        <h3><?= $baja['titular']['nombre'];?></h3>
                        <p>Historia Social: <?= $baja['hs'];?></p>
                        <p>Clasificación: <b><?= $baja['clasificacion'];?></b></p>
                        <p>Expediente EDIS: <b>
                            <?php if (!isset($baja['datos_bd']['numedis'])): ?>
                                   <big><i class="fa fa-warning text-danger"></i></big>
                            <?php else: ?>
                            <?= $this->Html->link($baja['datos_bd']['numedis'], ['controller'=>'Expedientes', 'action' => 'view', $baja['datos_bd']['expediente_id']], [     
                                    'class'=> 'btn btn-info btn-xs','target' => '_blank',
                                    'id'=>'add_comision'.$num_rgc,
                                    'data-container'=>"body",
                                    'data-toggle'=>"popover",
                                    'data-placement'=>"top",
                                    'data-content'=>"Accede a este expediente..."]) ?>
        
                            <?php endif; ?></b></p>
                        <p>Domicilio a <b> <?= $baja['domicilio'];?> </b> </p>
                        <p>TEDIS de Referencia: <b>
                            <?php if (!isset($baja['datos_bd']['rol']) || empty($baja['datos_bd']['rol'])): ?>
                                  <big><i class="fa fa-warning text-danger"></i></big>
                            <?php else: ?>
                                  <?php foreach($baja['datos_bd']['rol'] as $tedis): ?>
                                      <?php if($tedis['rol']=='tedis'){ echo $tedis['tecnico']['nombre'].' '.$tedis['tecnico']['apellidos'];} ?>
                                  <?php endforeach; ?>            
                            <?php endif; ?>
                        </b></p>

                      </div>
                      <div class="panel-footer panel-footer-cambios"> <?= $baja['ceas'];?> </div>
                </div>
            </div>

            <?php endforeach; ?>     
        </div> 
    </div>
</div>