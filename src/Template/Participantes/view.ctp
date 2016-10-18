<?= $this->assign('title', $participante->dni.'- '.$participante->nombre.' '.$participante->apellidos);?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2><i class="icono-titulo-fa fa fa-user">  Ficha de Usuario</i></h2>
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

        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12 profile_left">

            <div class="profile_img">

                <!-- end of image cropping -->
                <div id="crop-avatar">
                  <!-- Current avatar -->
                  <?php if ($participante->foto === ''): ?>
                         
                        <?= $this->Html->image('avatar/avatar-'.$participante->sexo.'.svg', [
                                                'class' =>'img-responsive avatar-view avatar_profile', 
                                                'id'=>$participante['id'],
                                                ]);  ?> 
                  <? else: ?>
                        
                        <?= $this->Html->image('participantes_fotos/'.$participante->foto, ['class'=>'img-responsive avatar-view avatar_profile'])?>

                  <?php endif; ?>
                 
                  <!-- Loading state 
                  <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>-->
                </div>
                <!-- end of image cropping -->

            </div>
           
            
          <h3><?= $participante->nombre.' '.$participante->apellidos ?></h3>

            <ul class="list-unstyled user_data">
                
                <li class="datos-profile">
                  <i class="glyphicon glyphicon-credit-card user-profile-icon"></i> <?= $participante->dni; ?>
                </li>

                <li class="datos-profile">

                    <?php if ($participante->nacimiento): ?>
                         <i class="fa fa-calendar user-profile-icon"></i><?= '  '.$this->Time->format($participante->nacimiento, "dd/MM/yyyy", null).'<b> ('.$participante->edad .' años)</b>';?> 
                    <?php else: ?>
                            <i class="fa fa-calendar user-profile-icon"></i>
                            <?= $this->Html->link(' Fecha Nacimiento', '#', [     
                                'class'=> 'btn btn-xs modal-btn btn-warning fa fa-plus',
                                'id'=>'add_fecha_nacimiento_'.$participante->id,
                                'data-container'=>"body",
                                //'data-toggle'=>"popover",
                                //'data-placement'=>"right",
                                //'data-content'=>"Añade un nuevo miembro a esta parrilla..."
                                ]); ?>

                    <?php endif ?>
                   
                </li>

                <li class="datos-profile">
                    <?php if ($participante->telefono): ?>
                         <i class="fa fa-phone user-profile-icon"></i> <?= $participante->telefono; ?>
                    <?php else: ?>
                            <i class="fa fa-phone user-profile-icon"></i> 
                            <?= $this->Html->link(' Teléfono de contacto', '#', [     
                                'class'=> 'btn btn-xs modal-btn btn-warning fa fa-plus',
                                'id'=>'add_telefono_'.$participante->id,
                                'data-container'=>"body",
                                //'data-toggle'=>"popover",
                                //'data-placement'=>"right",
                                //'data-content'=>"Añade un nuevo miembro a esta parrilla..."
                                ]); ?>

                    <?php endif ?>
                
                </li>

                <li class="datos-profile">

                    <?php if ($participante->email): ?>
                            <i class="fa fa-at user-profile-icon"></i> <?= $participante->email; ?>
                    <?php else: ?>
                            <i class="fa fa-at user-profile-icon"></i>
                            <?= $this->Html->link(' E-mail de contacto', '#', [     
                                'class'=> 'btn btn-xs modal-btn btn-warning fa fa-plus',
                                'id'=>'add_email_'.$participante->id,
                                'data-container'=>"body",
                                //'data-toggle'=>"popover",
                                //'data-placement'=>"right",
                                //'data-content'=>"Añade un nuevo miembro a esta parrilla..."
                                ]); ?>

                    <?php endif ?>

                </li>

                <li class="datos-profile"><i class="fa fa-map-marker user-profile-icon"></i> <?= $participante->expediente->domicilio; ?>
                </li>
            </ul>
           <h4>Observaciones</h4>
                <blockquote class="small">
                <?php if ($participante->observaciones): ?>
                        <?= $participante->observaciones; ?>
                <?php else: ?>
                        <p>No se han generado observaciones para esta persona.</p>
                <?php endif ?>
                </blockquote>
          
             <div class="clearfix"></div>
           <hr>
            <!-- Botonera profile -->
            <?= $this->Html->link(' Editar Datos de Usuario', ['action' => 'edit', $participante->id], ['class'=> 'pull-right btn btn-success fa fa-edit m-right-xs']) ?>
            <?= $this->Form->postLink(' Eliminar usuario', ['controller' => 'Participantes', 'action' => 'delete', $participante->id], ['class'=> 'pull-right btn btn-danger fa fa-trash','confirm' => __('Estás seguro de que quieres borrar a # {0}?', $participante->nombre.' '.$participante->apellidos),
                        'id' => 'borra_participante',
                        'data-toggle'=>"popover",
                        'data-placement'=>"top",
                        'data-content'=>"¡ATENCIÓN! Si eliminas este usuario eliminarás todos los datos y plantillas asociadas a él (currículum, valoraciones, caracterizaciones...)."]) ?>
          <br />

        </div>

<!--// end Columna IZQUIERDA -->   

     <big><?= $this->Html->link(' '.$participante->expediente->numedis, ['controller'=>'expedientes', 'action' => 'view', $participante->expediente->id], ['class'=> 'btn btn-success btn-lg fa fa-folder-open pull-right']) ?></big>
        <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">

          <div class="profile_title">
            <div class="col-md-6">
              <h2>Estadísticas Predictivas</h2>

            </div>
            <div class="col-md-6 container">
                
            </div>
          </div>
          
              <!-- start skills -->
                <br>
              <ul class="list-unstyled user_data">
                <li>
                  <?= $this->Html->link('', ['action' => '#'], ['class'=> 'btn btn-primary fa fa-edit m-right-xs pull-right']) ?>
                  <p>Motivación para el empleo</p>
                  <div class="progress progress_sm">
                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                  </div>
                </li>
                <li>
                    <?= $this->Html->link('', ['action' => '#'], ['class'=> 'btn btn-primary fa fa-edit m-right-xs pull-right']) ?>
                  <p>Motivación para la formación</p>
                  <div class="progress progress_sm">
                    <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="70"></div>
                  </div>
                </li>
                <li>
                    <?= $this->Html->link('', ['action' => '#'], ['class'=> 'btn btn-primary fa fa-edit m-right-xs pull-right']) ?>
                  <p>Nivel de Competencias Generales</p>
                  <div class="progress progress_sm">
                    <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="30"></div>
                  </div>
                </li>
                <li>
                    <?= $this->Html->link('', ['action' => '#'], ['class'=> 'btn btn-primary fa fa-edit m-right-xs pull-right']) ?>
                  <p>Nivel de Disponibilidad</p>
                  <div class="progress progress_sm">
                    <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                  </div>
                </li>
              </ul>
              <!-- end of skills -->
            <br>

<!-- INICIO BLOQUE DE PESTAÑAS -->   

          <div class="" role="tabpanel" data-example-id="togglable-tabs">
            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
              <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Caracterización</a>
              </li>
              <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-folder-open user-profile-icon"></i> <?= $participante->expediente->numedis; ?></a>
              </li>
              <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false"><i class="fa fa-group user-profile-icon"></i> Mi familia</a>
              </li>
              <li role="presentation" class=""><a href="#tab_content4" role="tab" id="profile-tab3" data-toggle="tab" aria-expanded="false"><i class="fa fa-file-text user-profile-icon"></i> Curriculum Vitae</a>
              </li>
            </ul>
            <div id="myTabContent" class="tab-content">
              <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                <!-- start primera pestaña -->
                
                <!-- end primera pestaña -->

              </div>
              <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                <!-- start segunda pestaña -->
                <table class="data table table-striped no-margin">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Project Name</th>
                      <th>Client Company</th>
                      <th class="hidden-phone">Hours Spent</th>
                      <th>Contribution</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>New Company Takeover Review</td>
                      <td>Deveint Inc</td>
                      <td class="hidden-phone">18</td>
                      <td class="vertical-align-mid">
                        <div class="progress">
                          <div class="progress-bar progress-bar-success" data-transitiongoal="35"></div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>New Partner Contracts Consultanci</td>
                      <td>Deveint Inc</td>
                      <td class="hidden-phone">13</td>
                      <td class="vertical-align-mid">
                        <div class="progress">
                          <div class="progress-bar progress-bar-danger" data-transitiongoal="15"></div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>Partners and Inverstors report</td>
                      <td>Deveint Inc</td>
                      <td class="hidden-phone">30</td>
                      <td class="vertical-align-mid">
                        <div class="progress">
                          <div class="progress-bar progress-bar-success" data-transitiongoal="45"></div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td>New Company Takeover Review</td>
                      <td>Deveint Inc</td>
                      <td class="hidden-phone">28</td>
                      <td class="vertical-align-mid">
                        <div class="progress">
                          <div class="progress-bar progress-bar-success" data-transitiongoal="75"></div>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <!-- end segunda pestaña -->

              </div>

                <!-- start tercera pestaña -->

              <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                
                    <table class="data table table-striped no-margin">
                        <thead>
                            <tr>
                              <th>DNI/NIE</th>
                              <th>Nombre y Apellidos</th>
                              <th>Edad</th>
                              <th>Relación con el Tutular</th>
                              <th>Progress</th>
                              <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($participante->expediente->participantes as $p): ?>
                                    
                                    <?php 
                                        $marcada = '';
                                        if ($p->id === $participante->id){
                                            $marcada = 'tabla-seleccionada';
                                        }
                                     ?>                                               
                                    
                            <tr class="<?= $marcada; ?>">
                              <td><?= $p->dni; ?></td>
                              <td><?= $p->nombre.' '.$p->apellidos; ?></td>
                              <td>
                                  <?php if ($p->nacimiento): ?>
                                  
                                 <?= '<b>'.$p->edad .' años </b> ('.$this->Time->format($p->nacimiento, "dd/MM/yyyy", null).')';?> 
                            <?php else: ?>
                                    <p>- - - -</p>
                            <?php endif ?>
                              </td>
                              <td><?= $p['relation']['nombre']; ?></td>
                              <td class="vertical-align-mid">
                                <div class="progress">
                                  <div class="progress-bar progress-bar-success" data-transitiongoal="<?= rand(5,100)?>"></div>
                                </div>
                              </td>
                              <td>
                                  <?= $this->Html->link(' ', ['action' => 'view', $p->id], ['class'=> 'btn btn-success fa fa-eye m-right-xs']) ?>
                              </td>
                            </tr>
                            <?php endforeach; ?> 
                        </tbody>
                    </table>
              </div>   <!-- end tercera pestaña -->

                <!-- start cuarta pestaña -->

              <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">
                <p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui
                  photo booth letterpress, commodo enim craft beer mlkshk </p>
              </div>

                <!-- end cuarta pestaña -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
