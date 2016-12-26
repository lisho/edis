
<div class="row">

<h1><i class="fa fa-newspaper-o"></i>  Avisos y Noticias</h1>
    
<!-- Panel de fichas-->
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-bars"></i> URGENTES </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
            <div class="clearfix"></div>
        </div>
        
        <div class="x_content">

            <div class="row">
                <?php foreach ($avisos_urgentes as $aviso): ?>
                
                <div class="col-md-4 col-xs-12 widget widget_tally_box">
                    <div class="x_panel ui-ribbon-container fixed_height_390">
                        <div class="ui-ribbon-wrapper">
                            <div class="ui-ribbon importancia-<?= $aviso['importancia'];?>">
                              <?= strtoupper($aviso['tipo']);?>
                            </div>
                        </div>
                        <div class="x_title">
                            <div class="row">
                                <div class="col-lg-2 foto-avisos">                       
                                    <?= $this->Html->image('user_fotos/'.$aviso['user']['foto'], ['class'=> 'img-circle profile_img']) ?>           
                                </div>
                                <div class="col-lg-8 botonera-avisos">
                                    <?= $this->Html->link('', ['action' => 'view', $aviso->id], ['class'=> 'btn btn-xs btn-dark fa fa-eye']) ?>

                                <?php if ($aviso['user_id']=== $auth['id'] || $auth['role']==='admin'): ?>
                                               
                                    <?= $this->Html->link('', ['action' => 'edit', $aviso->id], ['class'=> 'btn btn-xs btn-info fa fa-edit']) ?>
                                    <?= $this->Form->postLink('', ['action' => 'delete', $aviso->id], ['class'=> 'btn btn-xs btn-danger fa fa-trash', 'confirm' => __('Realmente quieres borrar el registro: # {0}?', $aviso->titulo)]) ?>
                                <?php endif; ?>    
                                
                                </div>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <h3 class="name_title"><?= $aviso['titulo'];?></h3>
                            <p><?= $this->Time->format($aviso->modified, "dd/MM/yyyy", null) ?></p>
                            <div class="divider"></div>

                            <p><?= $aviso['description'];?></p>

                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>

        </div>
    </div>
</div> <!--/ Panel de fichas-->



<!-- Panel de tabla de todos los avisos-->
<div class="col-md-12 col-sm-12 col-xs-12">

<div class="x_panel">

    <div class="" role="tabpanel" data-example-id="togglable-tabs">

        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
            <li role="presentation" class="active"><a href="#tab_content1" role="tab" id="home-tab" data-toggle="tab" aria-expanded="true">Mis Avisos y Noticias</a>
            </li>
            <li role="presentation" class=""><a href="#tab_content2" id="profile-tab" role="tab" data-toggle="tab" aria-expanded="true">Listado completo</a>
            </li>
            <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Todos los Avisos</a>
            </li>
            <li role="presentation" class=""><a href="#tab_content4" role="tab" id="profile-tab3" data-toggle="tab" aria-expanded="false">Todas las Noticias</a>
            </li>

        </ul>
        
        <div id="myTabContent" class="tab-content">

<!-- Contenido PESTAÑA 1-->

            <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                <div class="x_title">
                    <h2><i class="fa fa-list-alt"></i> Mis Avisos y Noticias <small>Entradas publicadas por <?= $auth['nombre'].' '.$auth['apellidos']; ?></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                            
                            <li><?= $this->Html->link('  Nuevo Aviso/Noticia', ['controller'=>'Avisos', 'action'=>'add'],['class'=>'fa fa-plus']); ?>
                            </li>

                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                </div> <!-- / x-title-->
                
                <div class="x_content">
                    <table id="" class="table table-striped table-bordered datatable" cellpadding="0" cellspacing="0">
                        <thead>
                            <tr>
                                <!-- <th></th> -->
                                <th></th>
                                <th>Fecha</th>
                                <th>Título</th>
                                <th>Descrición</th>
                                <th>Publicado por</th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($mis_avisos as $aviso): ?>
                            <tr>
                            <!--
                                <td class="foto-lista"><?= $this->Html->image('user_fotos/'.$aviso['user']['foto'], ['class'=> 'img-circle profile_img']) ?>  </td>
                            -->

                                <?php 

                                    switch ($aviso['tipo']) {
                                        case 'noticia':
                                            $fa = 'fa fa-newspaper-o';
                                            break;
                                        case 'aviso':
                                            $fa = 'fa fa-warning';
                                            break;                           
                                    }

                                ?>
                                
                                <td class="text-center"><i class="<?= $fa;?> importancia-<?= $aviso['importancia'];?>"><span class=" hidden"><?= $aviso['id'];?></span></i></td>
                                <td><?= $this->Time->format($aviso->modified, "dd/MM/yyyy", null) ?></td>
                                <td><?= h($aviso->titulo) ?></td>
                                <td><?= $aviso->description ?></td>
                                <td><?= $aviso->user->user ?></td>
                                <td>  
                                           
                                    <?= $this->Html->link('', ['action' => 'view', $aviso->id], ['class'=> 'btn btn-xs btn-dark fa fa-eye']) ?>

                                    <?php if ($aviso['user_id']=== $auth['id'] || $auth['role']==='admin'): ?>                 
                                        <?= $this->Html->link('', ['action' => 'edit', $aviso->id], ['class'=> 'btn btn-xs btn-info fa fa-edit']) ?>
                                        
                                        <?= $this->Form->postLink('', ['action' => 'delete', $aviso->id], ['class'=> 'btn btn-xs btn-danger fa fa-trash', 'confirm' => __('Realmente quieres borrar el registro: # {0}?', $aviso->titulo)]) ?>
                                    <?php endif; ?>    
                                    
                                </td>

                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div> <!-- / x-content-->
            </div> <!-- / tab_content1-->

<!-- Contenido PESTAÑA 2-->

            <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                <div class="x_title">
                    <h2><i class="fa fa-list-alt"></i> Listado completo <small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                            
                            <li><?= $this->Html->link('  Nuevo Aviso/Noticia', ['controller'=>'Avisos', 'action'=>'add'],['class'=>'fa fa-plus']); ?>
                            </li>

                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                </div> <!-- / x-title-->
                
                <div class="x_content">
                    <table id="" class="table table-striped table-bordered datatable" cellpadding="0" cellspacing="0">
                        <thead>
                            <tr>
                                <!-- <th></th> -->
                                <th></th>
                                <th>Fecha</th>
                                <th>Título</th>
                                <th>Descrición</th>
                                <th>Publicado por</th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($avisos as $aviso): ?>
                            <tr>
                            <!--
                                <td class="foto-lista"><?= $this->Html->image('user_fotos/'.$aviso['user']['foto'], ['class'=> 'img-circle profile_img']) ?>  </td>
                            -->

                                <?php 

                                    switch ($aviso['tipo']) {
                                        case 'noticia':
                                            $fa = 'fa fa-newspaper-o';
                                            break;
                                        case 'aviso':
                                            $fa = 'fa fa-warning';
                                            break;                           
                                    }

                                ?>
                                
                                <td class="text-center"><i class="<?= $fa;?> importancia-<?= $aviso['importancia'];?>"><span class=" hidden"><?= $aviso['id'];?></span></i></td>
                                <td><?= $this->Time->format($aviso->modified, "dd/MM/yyyy", null) ?></td>
                                <td><?= h($aviso->titulo) ?></td>
                                <td><?= $aviso->description ?></td>
                                <td><?= $aviso->user->user ?></td>
                                
                                <td>  
                                           
                                    <?= $this->Html->link('', ['action' => 'view', $aviso->id], ['class'=> 'btn btn-xs btn-dark fa fa-eye']) ?>

                                    <?php if ($aviso['user_id']=== $auth['id'] || $auth['role']==='admin'): ?>                 
                                        <?= $this->Html->link('', ['action' => 'edit', $aviso->id], ['class'=> 'btn btn-xs btn-info fa fa-edit']) ?>
                                        
                                        <?= $this->Form->postLink('', ['action' => 'delete', $aviso->id], ['class'=> 'btn btn-xs btn-danger fa fa-trash', 'confirm' => __('Realmente quieres borrar el registro: # {0}?', $aviso->titulo)]) ?>
                                    <?php endif; ?>    
                                    
                                </td>

                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div> <!-- / x-content-->

            </div>  <!-- / tab_content2-->

<!-- Contenido PESTAÑA 3-->

            <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
              
                <div class="x_title">
                    <h2><i class="fa fa-list-alt"></i> Listado de Avisos <small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                            
                            <li><?= $this->Html->link('  Nuevo Aviso/Noticia', ['controller'=>'Avisos', 'action'=>'add'],['class'=>'fa fa-plus']); ?>
                            </li>

                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                </div> <!-- / x-title-->
                
                <div class="x_content">
                    <table id="" class="table table-striped table-bordered datatable" cellpadding="0" cellspacing="0">
                        <thead>
                            <tr>
                                <!-- <th></th> -->
                                <th></th>
                                <th>Fecha</th>
                                <th>Título</th>
                                <th>Descrición</th>
                                <th>Publicado por</th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($solo_avisos as $aviso): ?>
                            <tr>
                            <!--
                                <td class="foto-lista"><?= $this->Html->image('user_fotos/'.$aviso['user']['foto'], ['class'=> 'img-circle profile_img']) ?>  </td>
                            -->

                                <?php 

                                    switch ($aviso['tipo']) {
                                        case 'noticia':
                                            $fa = 'fa fa-newspaper-o';
                                            break;
                                        case 'aviso':
                                            $fa = 'fa fa-warning';
                                            break;                           
                                    }

                                ?>
                                
                                <td class="text-center"><i class="<?= $fa;?> importancia-<?= $aviso['importancia'];?>"><span class=" hidden"><?= $aviso['id'];?></span></i></td>
                                <td><?= $this->Time->format($aviso->modified, "dd/MM/yyyy", null) ?></td>
                                <td><?= h($aviso->titulo) ?></td>
                                <td><?= $aviso->description ?></td>
                                <td><?= $aviso->user->user ?></td>
                                
                                <td>  
                                           
                                    <?= $this->Html->link('', ['action' => 'view', $aviso->id], ['class'=> 'btn btn-xs btn-dark fa fa-eye']) ?>

                                    <?php if ($aviso['user_id']=== $auth['id'] || $auth['role']==='admin'): ?>                 
                                        <?= $this->Html->link('', ['action' => 'edit', $aviso->id], ['class'=> 'btn btn-xs btn-info fa fa-edit']) ?>
                                        
                                        <?= $this->Form->postLink('', ['action' => 'delete', $aviso->id], ['class'=> 'btn btn-xs btn-danger fa fa-trash', 'confirm' => __('Realmente quieres borrar el registro: # {0}?', $aviso->titulo)]) ?>
                                    <?php endif; ?>    
                                    
                                </td>

                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div> <!-- / x-content-->

            </div> <!-- / tab_content3-->

<!-- Contenido PESTAÑA 4-->

            <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">
                <div class="x_title">
                    <h2><i class="fa fa-list-alt"></i> Listado de Noticias <small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                            
                            <li><?= $this->Html->link('  Nuevo Aviso/Noticia', ['controller'=>'Avisos', 'action'=>'add'],['class'=>'fa fa-plus']); ?>
                            </li>

                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                </div> <!-- / x-title-->
                
                <div class="x_content">
                    <table id="" class="table table-striped table-bordered datatable" cellpadding="0" cellspacing="0">
                        <thead>
                            <tr>
                                <!-- <th></th> -->
                                <th></th>
                                <th>Fecha</th>
                                <th>Título</th>
                                <th>Descrición</th>
                                <th>Publicado por</th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($solo_noticias as $aviso): ?>
                            <tr>
                            <!--
                                <td class="foto-lista"><?= $this->Html->image('user_fotos/'.$aviso['user']['foto'], ['class'=> 'img-circle profile_img']) ?>  </td>
                            -->

                                <?php 

                                    switch ($aviso['tipo']) {
                                        case 'noticia':
                                            $fa = 'fa fa-newspaper-o';
                                            break;
                                        case 'aviso':
                                            $fa = 'fa fa-warning';
                                            break;                           
                                    }

                                ?>
                                
                                <td class="text-center"><i class="<?= $fa;?> importancia-<?= $aviso['importancia'];?>"><span class=" hidden"><?= $aviso['id'];?></span></i></td>
                                <td><?= $this->Time->format($aviso->modified, "dd/MM/yyyy", null) ?></td>
                                <td><?= h($aviso->titulo) ?></td>
                                <td><?= $aviso->description ?></td>
                                <td><?= $aviso->user->user ?></td>
                                
                                <td>  
                                           
                                    <?= $this->Html->link('', ['action' => 'view', $aviso->id], ['class'=> 'btn btn-xs btn-dark fa fa-eye']) ?>

                                    <?php if ($aviso['user_id']=== $auth['id'] || $auth['role']==='admin'): ?>                 
                                        <?= $this->Html->link('', ['action' => 'edit', $aviso->id], ['class'=> 'btn btn-xs btn-info fa fa-edit']) ?>
                                        
                                        <?= $this->Form->postLink('', ['action' => 'delete', $aviso->id], ['class'=> 'btn btn-xs btn-danger fa fa-trash', 'confirm' => __('Realmente quieres borrar el registro: # {0}?', $aviso->titulo)]) ?>
                                    <?php endif; ?>    
                                    
                                </td>

                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div> <!-- / x-content-->

            </div> <!-- / tab_content4-->

        </div> <!-- / myTabContent-->
    </div> <!-- / tabpanel-->
</div><!--/ Panel de tabla de todos los avisos-->                   
</div> <!-- / x-panel-->
            


</div> <!--/ row-->

