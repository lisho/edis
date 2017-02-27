<!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3><?= $auth['role']; ?></h3>
                <ul class="nav side-menu">
                  <!--
                  <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.html">Dashboard</a></li>
                      <li><a href="index2.html">Dashboard2</a></li>
                      <li><a href="index3.html">Dashboard3</a></li>
                    </ul>
                  </li>
                  -->

                  <?php if ($auth['role']!='auxiliar'): ?>

                  <li><a><i class="fa fa-folder-open"></i> Expedientes <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      
                      <li><?= $this->Html->link('Listado de Expedientes', ['controller'=> 'Expedientes', 'action'=>'index']) ?></li>
                      <li><?= $this->Html->link('Mis Expedientes', ['controller'=> 'Roles', 'action'=>'mis_roles']) ?></li>
                      <li><?= $this->Html->link('Crear Nuevo Expediente', ['controller'=> 'Expedientes', 'action'=>'add']) ?></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-table"></i> Comisiones <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><?= $this->Html->link('Tengo que ir a una comisión ', ['controller'=> 'Comisions', 'action'=>'index']) ?></li>
                      <!--
                      <li><a href="tables_dynamic.html">Table Dynamic</a></li>
                      -->
                    </ul>
                  </li>
                  <li><a><i class="fa fa-warning"></i> Avisos/Noticias <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><?= $this->Html->link('Nuevo aviso o noticia', ['controller'=> 'Avisos', 'action'=>'add']) ?></li>
                      <!--
                      <li><?= $this->Html->link('Mis avisos o noticias', ['controller'=> 'Avisos', 'action'=>'add']) ?></li></li>
                      -->
                      <li><?= $this->Html->link('Gestión de avisos y noticias', ['controller'=> 'Avisos', 'action'=>'index']) ?></li></li>
                    </ul>
                  </li>
                  <?php endif; ?>

                  <?php if ($auth['role']=='admin'): ?>
                      <li><a><i class="fa fa-fire"></i> Reflexiones <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><?= $this->Html->link('Crear Nueva Reflexión', ['controller'=> '', 'action'=>'add']) ?></li>
                          <li><?= $this->Html->link('Panel de Reflexiones', ['controller'=> '', 'action'=>'index']) ?></li>
                          <li><?= $this->Html->link('Mis Reflexiones', ['controller'=> '', 'action'=>'mis_reflexiones']) ?></li>
                          <li><?= $this->Html->link('Nuevo tema de reflexión', ['controller'=> '', 'action'=>'mis_reflexiones']) ?></li>
                          
                        </ul>
                      </li>   
                  <?php endif; ?>
                  
<!-- ADMINISTRACION -->                  
                  <li><a><i class="fa fa-desktop"></i> Administración <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">

                    <li><?= $this->Html->link('Acceso Auxiliar', ['controller'=> 'Expedientes', 'action'=>'administracion']) ?></li>  

                    <?php if ($auth['role']=='admin'): ?>

                        <li><a>Equipos<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li>
                                <?= $this->Html->link('Listado de Equipos', ['controller'=> 'Equipos', 'action'=>'index']) ?>
                            </li>
                            <li>
                                <?= $this->Html->link('Nuevo Equipo', ['controller'=> 'Equipos', 'action'=>'add']) ?>
                            </li>
                            <li><a href="#level2_2">Level Two</a>
                            </li>
                          </ul>
                        <li><a>Users<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li >
                              <?= $this->Html->link('Listado de Users', ['controller'=> 'Users', 'action'=>'index']) ?>
                            </li>
                            <li>
                              <?= $this->Html->link('Nuevo User', ['controller'=> 'Users', 'action'=>'add']) ?>
                            </li>
                            <li><a href="#level2_2">Level Two</a>
                            </li>
                          </ul>
                        </li>
                        <li><a>Técnicos<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li >
                              <?= $this->Html->link('Listado de Técnicos', ['controller'=> 'Tecnicos', 'action'=>'index']) ?>
                            </li>
                            <li>
                              <?= $this->Html->link('Nuevo Técnico', ['controller'=> 'Tecnicos', 'action'=>'add']) ?>
                            </li>
                            <li><a href="#level2_2">Level Two</a>
                            </li>
                          </ul>
                        </li>
                        <li><a>Incidencias<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li>
                              <?= $this->Html->link('Gestión Tipos de Incidencia', ['controller'=> 'Incidenciatipos', 'action'=>'add']) ?>
                            </li>
                            <li>
                              <?= $this->Html->link('Listado de Incidencias', ['controller'=> 'Incidencias', 'action'=>'index']) ?>
                            </li>
                          </ul>
                        </li>
                        <li><a>Prestaciones<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li>
                              <?= $this->Html->link('Gestión Estados de Prestación', ['controller'=> 'Prestacionestados', 'action'=>'add']) ?>
                            </li>
                            <li>
                              <?= $this->Html->link('Gestión Tipos de Prestación', ['controller'=> 'Prestaciontipos', 'action'=>'add']) ?>
                            </li>
                          </ul>
                        </li>

                   <?php endif; ?>

                   <?php if ($auth['role']!='auxiliar'): ?>                       
                        <li><a>Nóminas<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">

                            <li>
                              <?= $this->Html->link('Ver Nóminas', ['controller'=> 'Nominas', 'action'=>'view']); ?>
                            </li>
                            <!--
                            <li>
                              <?= $this->Html->link('Última Nómina', ['controller'=> 'Nominas', 'action'=>'ultima']); ?>
                            </li>
                            -->
                            <li>
                              <?= $this->Html->link('Análisis de Cambios en la Última Nómina', ['controller'=> 'Nominas', 'action'=>'compara_nominas']); ?>
                            </li>
                  <?php endif; ?>
                  
                  <?php if ($auth['role']=='admin'): ?>   

                            <li>
                              <?= $this->Html->link('Añadir nueva Nómina', ['controller'=> 'Nominas', 'action'=>'add']) ?>
                            </li>
                            <li>
                              <?= $this->Html->link('Añadir nuevo Listado de Suspensiones', ['controller'=> 'Suspensions', 'action'=>'add']) ?>
                            </li>

                   <?php endif; ?>

                          </ul>
                        </li>
                    </ul>
                  </li>
                </ul>
              </div>


              <?php if ($auth['role']=='admin'): ?>   

              <div class="menu_section admin_menu">
                <h3>MIGRACIONES</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-folder"></i> Migra-Expedientes <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><?= $this->Html->link(' Cargar Expedientes', ['controller'=> 'Migraexpedientes', 'action'=>'add'], ['class' => "fa fa-upload"]); ?></li>
                      <li><?= $this->Html->link('Errores', ['controller'=> 'Migraexpedientes', 'action'=>'errores']); ?></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-group"></i> Migra-Usuarios <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    <li><?= $this->Html->link('Todos los Usuarios Migrados', ['controller'=> 'Migrausuarios', 'action'=>'index']); ?></li>
                      <li><?= $this->Html->link(' Cargar Usuarios', ['controller'=> 'Migrausuarios', 'action'=>'add'],['class' => "fa fa-upload"]); ?></li>
                      <li><?= $this->Html->link('Errores', ['controller'=> 'Migrausuarios', 'action'=>'errores']); ?></li>
                      <li><?= $this->Html->link('Enlazar Expedientes-Usuarios', ['controller'=> 'Migrausuarios', 'action'=>'enlaza-expedientes']); ?></li>
                      <li><?= $this->Html->link('Errores al Enlazar Expedientes-Usuarios', ['controller'=> 'Migrausuarios', 'action'=>'enlaza-expedientes-view']); ?></li>
                    </ul> 
                  </li>
                  <li><a><i class="fa fa-group"></i> Migra-Actuaciones <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><?= $this->Html->link('Todas las Actuaciones Migradas', ['controller'=> 'Migraactuaciones', 'action'=>'index']); ?></li>
                      <li><?= $this->Html->link('Errores en las Actuaciones Migradas', ['controller'=> 'Migraactuaciones', 'action'=>'enlaza_expedientes_view']); ?></li>
                      <li><?= $this->Html->link('Enlaza Expedientes-actuaciones', ['controller'=> 'Migraactuaciones', 'action'=>'enlaza_expedientes']); ?></li>
                      <li><?= $this->Html->link(' Cargar Actuaciones', ['controller'=> 'Migraactuaciones', 'action'=>'add'],['class' => "fa fa-upload"]); ?></li>
                      <!--<li><?= $this->Html->link('Errores', ['controller'=> 'Migrausuarios', 'action'=>'errores']); ?></li>
                      <li><?= $this->Html->link('Enlazar Expedientes-Usuarios', ['controller'=> 'Migrausuarios', 'action'=>'enlaza-expedientes']); ?></li>
                      <li><?= $this->Html->link('Errores al Enlazar Expedientes-Usuarios', ['controller'=> 'Migrausuarios', 'action'=>'enlaza-expedientes-view']); ?></li>-->
                    </ul> 
                  </li>

                  <!--
                  <li><a><i class="fa fa-sitemap"></i> Multilevel Menu <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="#level1_1">Level One</a>
                        <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="level2.html">Level Two</a>
                            </li>
                            <li><a href="#level2_1">Level Two</a>
                            </li>
                            <li><a href="#level2_2">Level Two</a>
                            </li>
                          </ul>
                        </li>
                        <li><a href="#level1_2">Level One</a>
                        </li>
                    </ul>
                  </li> 
                  -->

                  <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a></li>
                </ul>
              </div> <!-- end migraciones -->

              <?php endif; ?>


            </div>
            <!-- /sidebar menu -->

             <!-- menu footer buttons -->
            <div class="sidebar-footer hidden-small">

              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>

              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"  ></span>
              </a>

              <a data-toggle="tooltip" data-placement="top" title="Inicio de Página"  href="#body">
                <span class="fa fa-angle-double-up" aria-hidden="true"></span>
              </a>

              <?= $this->Html->link(
                        $this->Html->tag('span','',[
                                      "class"=>"glyphicon glyphicon-off",
                                      "aria-hidden"=>"true"
                                  ]), ['controller'=>'Users', 'action'=>'logout'],
                                  [ "data-toggle"=>"tooltip",
                                    "data-placement"=>"top",
                                    "title"=>"Logout",
                                    'escape' => false]); ?>


             
            </div>
            <!-- /menu footer buttons -->