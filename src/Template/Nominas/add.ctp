<h1>Importando archivo CSV</h1>

<fieldset>
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Carca un archivo de nómina en formato csv<span class="required">*</span></label>
    
    <div class="form-group">
         <div class="col-md-6 col-sm-6 col-xs-12">
            <?php echo $this->Form->create($nomina,['type'=>'file','class'=>'form-horizontal form-label-left data-parsley-validate=""']); ?>
                    
                    <?= $this->Form->file('nomina', [
                                                        //'type'=>'file',
                                                        //'label'=>'Selecciona un archivo para añadir la foto de perfil:'
                                                        ]); ?>  
        </div>
    </div>
</fieldset>             

<div class="ln_solid"></div>
<div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success']) ?>
        <?= $this->Html->link(__('Cancel'), ['action'=>'index'],['class' => 'btn btn-primary']) ?>
    </div>
</div>

<?php echo $this->Form->end(); ?>
<!--
<form action='<?php echo $_SERVER["PHP_SELF"];?>' method='post' enctype="multipart/form-data">
Importar Archivo : <input type='file' name='sel_file' size='20'>
<input type='submit' name='submit' value='submit'>
</form>
-->

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
                            
                        </tr> 
                    <?php endforeach; ?> 
                    </tbody>
                </table> 
 
            </div> 
        </div> 
    </div>
</div>