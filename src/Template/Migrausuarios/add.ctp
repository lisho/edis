<h1>Importando archivo txt - Migrausuarios</h1>
<br><br>
<fieldset>
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Carga un archivo para migrar los usuarios<span class="required">*</span></label>
    
    <div class="form-group">
         <div class="col-md-6 col-sm-6 col-xs-12">
            <?php echo $this->Form->create($migrausuario,['type'=>'file','class'=>'form-horizontal form-label-left data-parsley-validate=""']); ?>
                    
                    <?= $this->Form->file('migrausuario', [
                                                        //'type'=>'file',
                                                        //'label'=>'Selecciona un archivo:'
                                                        ]); ?>  
        </div>
    </div>
</fieldset>             

<div class="ln_solid"></div>
<div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
        <?= $this->Form->button(__('Cargar'), ['class' => 'btn btn-success']) ?>
        <?= $this->Html->link(__('Cancelar'), ['action'=>'index'],['class' => 'btn btn-primary']) ?>
    </div>
</div>

<?php echo $this->Form->end(); ?>

<div class="col-md-12 col-sm-12 col-xs-12">
    <?php if (!empty($datos_array_incorrectos)): ?>
        <? debug($datos_array_incorrectos); ?>       
    <?php endif; ?>
</div>

<hr>
<h1>Proceso de migración</h1>


<ul>
    <li>Crear archivos csv (uno por tabla) con las columnas de los campos a migrar con separadores ";"</li>
    <li>Vaciar la tabla de destino en phpmyadmin</li>
    <li>Importar cada una de las tablas desde phpmyadmin:</li>
        <ul>
            <li>Separadores de columna ";"</li>
            <li>Añadir nombres de los campos de destino sin comillas en el orden en el que estan en la BD</li>
        </ul>
    <li>Adjudicación de los nuevos id de expediente:</li>
        <ul>
            <li>Ejecutar script enlazar expedientes-usuarios</li>
            <li>Ejecutar script enlazar expedientes-actuaciones</li>
        </ul>
    <li>Corrección de errores:</li>
        <ul>
            <li>Errores en Migraexpedientes</li>
                <ul>
                    <li>Corregir los números de expediente EDIS</li>
                    <li>Corregir los nombres de los TEDIS (desde script o desde phpmyadmin (cambiar el de la base antigua por el de la APP)</li>
                    <li>Corregir los nombres de los CC (desde script o desde phpmyadmin (cambiar el de la base antigua por el de la APP)</li>
                    <li>Corregir los nombres de los CEAS (desde script o desde phpmyadmin (cambiar el de la base antigua por el de la APP)</li>
                    <li>Eliminamos los expedientes 5---???</li>

                </ul>
            <li>Errores de Migrausuarios</li>
                <ul>
                    <li>Revisar los usuarios huérfanos que aparezcan y resolver la asociación o borrar. COMPROBAR:</li>
                        <ul>
                            <li>Posible cambio de numero edis (correciones solo del num de expediente)</li>
                            <li>Posible corrección y/o duplicidad del DNI => Borrado del usuario</li>
                            <li>Borrado del expediente???</li>
                        </ul>
                    <li>Corregir errores en los DNI/NIE</li>
                        <ul>
                            <li>Espacios en blanco en la codificacion de los que no tienen DNI</li>
                            <li>Usuarios de expedientes de arraigos (SIN DNI/NIE) --> Borrar??</li>
                            <li></li>
                        </ul>
                        <li>Eliminamos usuarios de los expedientes 5---???</li>
                </ul>
            <li>Errores en migraactuaciones</li>
                <ul>
                    <li></li>
                </ul>
        </ul>
    
</ul>           