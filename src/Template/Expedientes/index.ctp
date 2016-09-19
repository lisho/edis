

<h1><i class="fa fa-folder-open"></i>  Expedientes</h1>
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
                    
                    <th>Exp. EDIS</th>
                    <th>Historia Social </th>
                    <th>Titular</th>
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

                    <td class="text-center"><?= $this->Html->link('  '.$expediente->numedis, ['action' => 'view', $expediente->id], ['class' => 'btn btn-sm btn-success fa fa-folder-open', 'target' => '_blank']) ?></td>

                    <td><?= h($expediente->numhs) ?></td>
                    <td><?= $this->Html->link($expediente['participantes'][0]['nombre'].' '.$expediente['participantes'][0]['apellidos'], [
                                            'controller'=>'Participantes', 
                                            'action' => 'view', 
                                            $expediente['participantes'][0]['id']
                                            ]) ?></td>

                    <td><?= h($listado_ceas[$expediente->ceas]) ?></td>
                    <td><?= h($expediente->domicilio) ?></td>
                    <td><?= $this->Time->format($expediente->created, "dd/MM/yyyy", null) ?></td>
                    <td><?= $this->Time->format($expediente->modified, "dd/MM/yyyy", null) ?></td>
                    
                    <td class="actions">
                        <?= $this->Html->link('', ['action' => 'view', $expediente->id], ['class'=> 'btn btn-xs btn-success fa fa-folder-open']) ?>
                        <?= $this->Html->link('', ['action' => 'edit', $expediente->id], ['class'=> 'fa fa-edit btn btn-xs btn-info']) ?>
                     <?php if ($auth['role'] === 'admin'): ?>    
                        <?= $this->Form->postLink('', ['action' => 'delete', $expediente->id], ['class'=> 'btn btn-xs btn-danger fa fa-trash', 'confirm' => __('Realmente quieres borrar el registro: # {0}?', $expediente->nombre)]) ?>
                    <?php endif; ?>
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
