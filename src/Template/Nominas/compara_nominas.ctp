

<h1><i class="fa fa-money"></i> Cambios detectados en la Última Nómina <small> ( Comparativa entre <?= $penultima_nomina['nomina'].' y '.$ultima_nomina['nomina']; ?> ) </small> </h1>

<div class="col-md-12 col-sm-12 col-xs-12"> 
    <div class="x_panel"> 
        <div class="x_title"> 
            <h2><i class="fa fa-home"></i>  Cambios de domicilio detectados</h2> 
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
                               
            <?php foreach ($cambios['domicilios'] as $num_rgc => $calle): ?> 
            <div class="col-md-6 col-sm-12 col-xs-12">     
                <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title">Expediente RGC: <b> <?= $num_rgc; ?></b></h3>
                      </div>
                      <div class="panel-body panel-body-cambios">
                        <h3><?= $ultima_nomina[$num_rgc]['titular'];?></h3>
                        <p>Historia Social: <?= $ultima_nomina[$num_rgc]['HS'];?></p>
                        <p>Expediente EDIS: -----</p>
                        <p>Ha cambiado de domicilio a <b> <?= $calle;?> </b> </p>
                        <p>procedente de <b><?= $anterior['domicilios'][$num_rgc];?></b></p>

                        <?php if (array_key_exists($num_rgc, $anterior['ceas'])): ?>
                            <p class="success-text">y pasará del <?= $anterior['ceas'][$num_rgc]; ?> al <?= $cambios['ceas'][$num_rgc]; ?> </p>
                        <?php else: ?>
                            pero <i class="rojo">no hay cambio de CEAS</i>.
                        <?php endif; ?>

                      </div>
                      <div class="panel-footer"> TEDIS de Referencia: ----- </div>
                </div>
            </div>

            <?php endforeach; ?>     
        </div> 
    </div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12"> 
    <div class="x_panel"> 
        <div class="x_title"> 
            <h2><i class="fa fa-folder-open"></i>  Nuevos Expedientes (Inicios de cobro, reanudaciones y traslados desde otro municipio).</h2> 
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
            <h3>Nuevos expedientes en nómina: <?= count($nuevos);?>  </h3>
                                
            <?php foreach ($nuevos as $num_rgc): ?> 
            <div class="col-md-3 col-sm-4 col-xs-6">     
                <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title">Expediente RGC: <b> <?= $num_rgc; ?></b></h3>
                      </div>
                      <div class="panel-body panel-body-cambios">
                        <h3><?= $ultima_nomina[$num_rgc]['titular'];?></h3>
                        <p>Historia Social: <?= $ultima_nomina[$num_rgc]['HS'];?></p>
                        <p>Expediente EDIS: -----</p>
                        <p>Domicilio a <b> <?= $ultima_nomina[$num_rgc]['domicilio'];?> </b> </p>
                        <p></p>

                      </div>
                      <div class="panel-footer"> <?= $ultima_nomina[$num_rgc]['ceas'];?> </div>
                </div>
            </div>

            <?php endforeach; ?>     
        </div> 
    </div>
</div>


<div class="col-md-12 col-sm-12 col-xs-12"> 
    <div class="x_panel"> 
        <div class="x_title"> 
            <h2><i class="fa fa-folder"></i>  Expedientes eliminados (Suspensiones, extinciones y traslados hacia otro municipio).</h2> 
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
            <h3>Expedientes eliminados de nómina: <?= count($bajas);?>  </h3>
                                
            <?php foreach ($bajas as $num_rgc): ?> 
            <div class="col-md-3 col-sm-4 col-xs-6">     
                <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title">Expediente RGC: 

                            <?= $this->Html->link($num_rgc, ['controller'=>'Expedientes', 'action' => 'viewExpedientePorHs', $penultima_nomina[$num_rgc]['HS']], [     
                                    'class'=> '','target' => '_blank',
                                    'id'=>'add_comision'.$num_rgc,
                                    'data-container'=>"body",
                                    'data-toggle'=>"popover",
                                    'data-placement'=>"left",
                                    'data-content'=>"Accede a este expediente..."]) ?>

                        </h3>

                      </div>
                      <div class="panel-body panel-body-cambios">
                        <h3><?= $penultima_nomina[$num_rgc]['titular'];?></h3>
                        <p>Historia Social: <?= $penultima_nomina[$num_rgc]['HS'];?></p>
                        <p>Expediente EDIS: -----</p>
                        <p>Domicilio a <b> <?= $penultima_nomina[$num_rgc]['domicilio'];?> </b> </p>
                        <p>TEDIS de Referencia: ----</p>

                      </div>
                      <div class="panel-footer"> <?= $penultima_nomina[$num_rgc]['ceas'];?> </div>
                </div>
            </div>

            <?php endforeach; ?>     
        </div> 
    </div>
</div>