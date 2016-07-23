<h1>Equipos</h1>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Lista completa de los equipos técnicos de referencia </h2>
                <?= $this->Element('menus/menu_panel');?>
        
        <div class="clearfix"></div>
      </div>


      <div class="x_content">

        <table id="datatable" class="table table-striped table-bordered" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    
                    <th>Equipo de Referencia</th>
                    <th>Entidad </th>
                    <th>Tipo </th>
                    <th>Creado</th>
                    <th>Modificado</th>
                    <th class="actions">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($equipos as $equipo): ?>
                <tr>
                    
                    <td><?= $this->Html->link($equipo->nombre, ['action' => 'view', $equipo->id]) ?></td>
                    <td><?= h($equipo->entidad) ?></td>
                    <td><?= h($equipo->tipo) ?></td>
                    <td><?= $this->Time->format($equipo->created, "dd/MM/yyyy HH:mm", null) ?></td>
                    <td><?= $this->Time->format($equipo->modified, "dd/MM/yyyy HH:mm", null) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $equipo->id], ['class'=> 'btn btn-xs btn-success']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $equipo->id], ['class'=> 'btn btn-xs btn-info']) ?>
                        <?= $this->Form->postLink(__('delete'), ['action' => 'delete', $equipo->id], ['class'=> 'btn btn-xs btn-danger', 'confirm' => __('Realmente quieres borrar el registro: # {0}?', $equipo->nombre)]) ?>
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


