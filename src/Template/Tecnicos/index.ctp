

<h1>Técnicos de Intervención...</h1>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2><i class="fa fa-bars"></i> TÉCNICOS </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
            <div class="clearfix"></div>

        <div class="clearfix"></div>
      </div>


      <div class="x_content">

        <table id="datatable" class="table table-striped table-bordered" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th></th>
                    <th>Nombre </th>
                    <th>Apellidos </th>
                    <th>Equipo</th>
                    <th>Puesto</th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tecnicos as $tecnico): ?>
                <tr>
                    
                    <td><?= h($tecnico->id) ?></td>
                    <td><?= h($tecnico->nombre) ?></td>
                    <td><?= h($tecnico->apellidos) ?></td>
                     <td><?= $tecnico->has('equipo') ? $this->Html->link($tecnico->equipo->nombre, ['controller' => 'Equipos', 'action' => 'view', $tecnico->equipo->id]) : '' ?></td>
                    <td><?= h($tecnico->puesto) ?></td>
                    
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $tecnico->id], ['class'=> 'btn btn-xs btn-success']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tecnico->id], ['class'=> 'btn btn-xs btn-info']) ?>
                        <?= $this->Form->postLink(__('delete'), ['action' => 'delete', $tecnico->id], ['class'=> 'btn btn-xs btn-danger', 'confirm' => __('Realmente quieres borrar el registro: # {0}?', $tecnico->nombre)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        

    </div>
</div>




