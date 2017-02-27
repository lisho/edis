  <?php $esconder = ''; ?>
  <?php if ($auth['role'] == 'auxiliar'): ?>
     <?php $esconder = 'hidden'; ?>
  <?php endif; ?>  

<!-- top navigation -->
    <div class="top_nav">
      <div class="nav_menu">
        <nav class="" role="navigation">
          <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
          </div>       

          <ul class="nav navbar-nav navbar-right">

            <li class="">
              <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                
                

                <?= $this->Html->image('user_fotos/'.$auth['foto'], ['class'=> '']); ?>
                <?= $auth['user'].' '; ?></h2><span class=" fa fa-angle-down"></span>


              </a>
              <ul class="dropdown-menu dropdown-usermenu pull-right">

                <li>
                <?= $this->Html->link('    Mi Perfil',['controller'=>'Users','action' => 'view', $auth['id']], ['class'=>'fa fa-user pull-right'])?>
                
                <!--
                <a href="javascript:;"> Profile</a></li>
                <li>
                  <a href="javascript:;">
                    <span class="badge bg-red pull-right">50%</span>
                    <span>Settings</span>
                  </a>
                </li>
                <li><a href="javascript:;">Help</a></li>
                -->
                <li><?= $this->Html->link('   Salir', ['controller'=> 'Users', 'action'=>'logout'], ['class'=>'fa fa-sign-out pull-right']) ?></li>
              </ul>
            </li>

            <li role="presentation" class="dropdown">
              <a href="javascript:;" class="dropdown-toggle info-number <?= $esconder; ?>" data-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-warning"></i>
                <span class="badge bg-green">5</span>
              </a>
              <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                  <li>
                    <div class="text-center">
                      <h2>Ultimos avisos publicados</h2>
                    </div>
                  </li>
                
                <?php foreach ($ultimos_avisos as $aviso): ?>

                  <li>

                    <a href="#">

                      <span class="image"><?= $this->Html->image('user_fotos/'.$aviso['user']['foto'], ['class'=> '']); ?></span>
                      <span class="importancia-<?= $aviso['importancia'];?>">
                          <span><small><?= $aviso['user']['nombre'].' '.$aviso['user']['apellidos']?></small></span><br>
                          <span class="time"><?= $this->Time->timeAgoInWords(
                                  $aviso->modified,
                                  ['format' => 'MMM d, YYY', 'end' => '+1 year']
                                ); ?></span>
                      </span>
                      <div class="divider"></div>
                      <h2><?= $aviso['titulo'];?></h2>
                    <span class="message">
                      <?= $aviso['description'];?>
                    </span>
                    </a>

                  </li>
                  
                <?php endforeach ?>
                
                <li>
                  <div class="text-center">

                  <?= $this->Html->link('<strong>Ver todos los avisos y noticias</strong><i class="fa fa-angle-right "></i>',['controller'=>'avisos'],['escape' => false]);?>
                  </div>
                </li>
              </ul>
            </li>

            <!-- buscador -->
              
              <li class="col-md-5 col-sm-5 col-xs-12 form-group-buscador pull-right top_search <?= $esconder; ?>"> 
                  <div class="input-group">
                      <input id="s" type="text" class="form-control" placeholder="Buscar a..." autocomplete="off">
                      <span class="input-group-btn">
                        <button class="btn btn-default " type="button"><i class="fa"></i></button>
                      </span>
                  </div>
              </li>   
            
            

            <!-- /buscador -->

          </ul>
        </nav>
      </div>
    </div>
<!-- /top navigation -->