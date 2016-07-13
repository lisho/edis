    
    <?= $this->Html->charset() ?>
   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>
        
        <?= $this->fetch('title') ?>
    </title>
    
    <?= $this->Html->meta('icon') ?>

    <? // = $this->Html->css('base.css') ?>
    <? // = $this->Html->css('cake.css') ?>
    
    <!-- ******** ESTILOS ********* -->
    
    <!-- Bootstrap -->
    <?= $this->Html->css('bootstrap.min.css') ?>
   
    <!-- Font Awesome -->
    <?= $this->Html->css('font-awesome.min.css') ?>
   
    <!-- iCheck -->
    <?= $this->Html->css('skins/red.css') ?>

    <!-- iCheck -->
    <?= $this->Html->css('skins/red.css') ?>

     <!-- DataTables -->
    <?= $this->Html->css('datatables.net-bs/css/dataTables.bootstrap.min.css') ?>
    <?= $this->Html->css('datatables.net-buttons-bs/css/buttons.bootstrap.min.css') ?>

    <!-- bootstrap-progressbar -->
    <?= $this->Html->css('bootstrap-progressbar-3.3.4.min.css') ?>
   
    <!-- jVectorMap -->
    <?= $this->Html->css('jquery-jvectormap-2.0.3.css') ?>
  
    <!-- Custom Theme Style -->
    <?= $this->Html->css('custom.min.css') ?>
    <?= $this->Html->css('mis_estilos.css') ?>
       
    
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
