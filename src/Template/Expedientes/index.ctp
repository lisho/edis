

<h1>Expedientes</h1>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Lista completa de los Expedientes registrados en el sistema </h2>
        
        <?= $this->Element('menus/menu_panel');?>

        <div class="clearfix"></div>
      </div>

      <div class="x_content">

        <table id="datatable" class="table table-striped table-bordered" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    
                    <th>Expediente EDIS</th>
                    <th>Historia Social </th>
                    <th>CEAS </th>
                    <th>Domicilio</th>
                    <th>Creado</th>
                    <th>Última Modificación</th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($expedientes as $expediente): ?>
                <tr>

                    <td><?= $this->Html->link($expediente->numedis, ['action' => 'view', $expediente->id]) ?></td>

                    <td><?= h($expediente->numhs) ?></td>
                    <td><?= h($listado_ceas[$expediente->ceas]) ?></td>
                    <td><?= h($expediente->domicilio) ?></td>
                    <td><?= $this->Time->format($expediente->created, "dd/MM/yyyy", null) ?></td>
                    <td><?= $this->Time->format($expediente->modified, "dd/MM/yyyy", null) ?></td>
                    
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $expediente->id], ['class'=> 'btn btn-xs btn-success']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $expediente->id], ['class'=> 'btn btn-xs btn-info']) ?>
                        <?= $this->Form->postLink(__('delete'), ['action' => 'delete', $expediente->id], ['class'=> 'btn btn-xs btn-danger', 'confirm' => __('Realmente quieres borrar el registro: # {0}?', $expediente->nombre)]) ?>
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
