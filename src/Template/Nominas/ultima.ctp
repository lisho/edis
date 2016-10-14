

<div class="col-md-12 col-sm-12 col-xs-12"> 
    <div class="x_panel"> 
        <div class="x_title"> 
            <h2>Prueba inicial de nominas</h2> 
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
                <h4>Tablas nóminas</h4>        
            </div>         
 
            <div class="related"> 
               
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
                    <?php foreach ($lista_nominas as $nomina): ?> 
                        <tr> 
                            <td><?= h($nomina->CEAS) ?></td> 
                            <td><?= h($nomina->HS) ?></td> 
                            <td><?= h($nomina->RGC) ?></td> 
                            <td><?= h($nomina->CLASIFICACION) ?></td> 
                            <td><?= h($nomina->dni) ?></td> 
                            <td><?= h($nomina->nombrecompleto) ?></td> 
                            <td><?= h($nomina->SEXO) ?></td> 
                            <td><?= h($nomina->EDAD) ?></td> 
                            <td><?= h($nomina->NACIONALIDAD) ?></td> 
                            <td><?= h($nomina->DOMICILIO) ?></td> 
                            <td><?= h($nomina->relacion) ?></td> 
                            <td><?= h($nomina->fechanomina) ?></td> 
                            
                        </tr> 
                    <?php endforeach; ?> 
                    </tbody>
                </table> 
 
            </div> 
        </div> 
    </div>
</div>