
<h1><i class="fa fa-money"></i>  Visor de Nóminas </h1>

<!-- Barra de Progreso -->  
<?= $this->element ('herramientas/barra_progreso'); ?>

<div class="col-md-12 col-sm-12 col-xs-12"> 
    <div class="x_panel"> 
        <div class="x_title"> 
            
            <?php if ($nomina): ?>
              <h2><?= $nomina[0]->fechanomina; ?></h2>         
            <?php endif; ?>
            
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
         
            <div class="input-group">
                <form action="view" class="form-horizontal form-label-left" method = 'post'>                                     
                    <div class="input-group">
                        <?php 
                            echo $this->Form->select('n', $posibles_nominas['opciones'], [ 
                                        'class'=>'form-control',
                                        'autocomplete'=>"off",
                                        'required' => 'required', 
                                        'label' => ['text' => ''], 
                                        'empty' => 'Selecciona una nómina...' 
                                    ]); 
                        ?>  

                        <span class="input-group-btn">
                          <button class="btn btn-default " type="submit"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>
            </div>
                      
            <table id="datatable" class="table table-striped table-bordered" cellpadding="0" cellspacing="0"> 
                <thead>
                    <tr> 
                        <th><?= 'CEAS' ?></th> 
                        <th><?= 'HS' ?></th> 
                        <th><?= 'RGC' ?></th> 
                        <th><?= 'CLASIFICACIÓN' ?></th> 
                        <th><?= 'dni' ?></th> 
                        <th><?= 'nombrecompleto' ?></th> 
                        <th><?= 'SEXO' ?></th> 
                        <th><?= 'EDAD' ?></th> 
                        <th><?= 'NACIONALIDAD' ?></th> 
                        <th><?= 'DOMICILIO' ?></th> 
                        <th><?= 'relacion' ?></th> 
                        <th><?= 'fechanomina' ?></th>                        
                    </tr>                        
                </thead>
                <tbody>
                <?php foreach ($nomina as $n): ?> 
                    <tr> 
                        <td><?= h($n->CEAS) ?></td> 
                        <td><?= h($n->HS) ?></td> 
                        <td><?= h($n->RGC) ?></td> 
                        <td><?= h($n->CLASIFICACION) ?></td> 
                        <td><?= h($n->dni) ?></td> 
                        <td><?= h($n->nombrecompleto) ?></td> 
                        <td><?= h($n->SEXO) ?></td> 
                        <td><?= h($n->EDAD) ?></td> 
                        <td><?= h($n->NACIONALIDAD) ?></td> 
                        <td><?= h($n->DOMICILIO) ?></td> 
                        <td><?= h($n->relacion) ?></td> 
                        <td><?= h($n->fechanomina) ?></td>        
                    </tr> 
                <?php endforeach; ?> 
                </tbody>
            </table> 
        </div> 
    </div>
</div>