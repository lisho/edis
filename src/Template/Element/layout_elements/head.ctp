    
    <?= $this->Html->charset() ?>
   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>
        
        <?= $this->fetch('title') ?>
    </title>
    
    <?= $this->Html->meta('icon') ?>
    
<!--
    <? // = $this->Html->css('base.css') ?>
    <? // = $this->Html->css('cake.css') ?>
-->

    <!-- ******** ESTILOS ********* -->
    
    <!-- Bootstrap 
    <?= $this->Html->css('bootstrap.min.css') ?>
   -->

   <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme 
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    -->
    
    <!-- Font Awesome -->
    <?= $this->Html->css('font-awesome.min.css') ?>
   
    <!-- iCheck -->
    <?= $this->Html->css('skins/red.css') ?>

     <!-- DataTables -->
    <?= $this->Html->css('datatables.net-bs/css/dataTables.bootstrap.min.css') ?>
    <?= $this->Html->css('datatables.net-buttons-bs/css/buttons.bootstrap.min.css') ?>

    <!-- bootstrap-progressbar -->
    <?= $this->Html->css('bootstrap-progressbar-3.3.4.min.css') ?>

    <!-- bootstrap-datepicker -->
    <?= $this->Html->css('datepicker.css') ?>
   
    <!-- jVectorMap -->
    <?= $this->Html->css('jquery-jvectormap-2.0.3.css') ?>

        <!-- text-editor -->
    <?= $this->Html->css('jquery-te-1.4.0.css') ?>
  
    <!-- Custom Theme Style -->
    <?= $this->Html->css('custom.min.css') ?>
    <?= $this->Html->css('mis_estilos.css') ?>
       
    
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
