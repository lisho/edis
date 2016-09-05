

<h1>Expedientes</h1>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Lista de los expedientes en los que aparece como técnico <?= $auth['nombre'].' '. $auth['apellidos']?> </h2>
        
        <?= $this->Element('menus/menu_panel');?>

        <div class="clearfix"></div>
      </div>

      <div class="x_content">

        <table id="datatable" class="table table-striped table-bordered" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    
                    <th>Exp. EDIS</th>
                    <th>HS </th>
                    <th>Titular HS</th>
                    <th>CEAS </th>
                    <th>Domicilio</th>
                    <th>Mi Rol</th>
                    <th>Creado</th>
                    <th>Modificado</th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($expedientes as $expediente): ?>
                <tr>

                    <td><?= $this->Html->link($expediente->expediente->numedis, ['controller'=>'expedientes', 'action' => 'view', $expediente->expediente->id]) ?></td>

                    <td><?= h($expediente->expediente->numhs) ?></td>
                    <td>
                        <!-- Iteramos los participantes de cada expediente e imprimimos el titulas de la HS-->
                        <?php foreach ($expediente->expediente->participantes as $participante): ?>
                            <?php if ($participante['relation_id']==1): ?>
                                <?= ucwords($participante['nombre'].' '.$participante['apellidos']) ?>
                            <?php endif ?>
                        <?php endforeach; ?><!--// FIN iteración de los participantes-->
                    </td>
                    <td><?= h($listado_ceas[$expediente->expediente->ceas]) ?></td>
                    <td><?= h($expediente->expediente->domicilio) ?></td>
                    <td><?= strtoupper($expediente->rol) ?></td>
                    <td><?= $this->Time->format($expediente->expediente->created, "dd/MM/yyyy", null) ?></td>
                    <td><?= $this->Time->format($expediente->expediente->modified, "dd/MM/yyyy", null) ?></td>
                    
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $expediente->expediente->id], ['class'=> 'btn btn-xs btn-success']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $expediente->expediente->id], ['class'=> 'btn btn-xs btn-info']) ?>
                        <?= $this->Form->postLink(__('delete'), ['action' => 'delete', $expediente->expediente->id], ['class'=> 'btn btn-xs btn-danger', 'confirm' => __('Realmente quieres borrar el registro: # {0}?', $expediente->expediente->nombre)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
<!--
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
            </ul>
            <p><?= $this->Paginator->counter() ?></p>
        </div>
-->

    </div>
</div>
