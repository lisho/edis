<!DOCTYPE html>
<html lang="es">
<head>

    <?= $this->element('layout_elements/head'); ?>

</head>
<body class="nav-md">

    <div class="container body">
      <div class="main_container">
        
    <!-- Inicio barra lateral -->  
    
    <?php if (!empty($auth)): ?>
      
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              
              <a href="index.html" class="site_title"><?= $this->Html->image('escudo.svg', ['class'=> 'sidebar-logo']) ?> <span>EdisLeon</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">

                <?= $this->Html->image('user_fotos/'.$auth['foto'], ['class'=> 'img-circle profile_img']) ?>
                
              </div>
              <div class="profile_info">
                <span>Bienvenido,</span>
                <h2><?= $auth['nombre'].' '.$auth['apellidos']; ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
             <?= $this->element('menus/sidebar'); ?>   
            <!-- /sidebar menu -->

           
          </div>
        </div>

    <!-- Final barra lateral -->  

        <!-- top navigation -->
            <?= $this->element('menus/menu_principal'); ?>
        <!-- /top navigation -->

        <!-- page content -->        
    
    <?php else : ?>

        <div class="col-md-3 left_col">
          <div class="text-center">           
            <?= $this->Html->image('escudo.svg', ['class'=> 'sidebar-logo-grande']) ?>
          </div>

        </div>
          
    <?php endif ?>

            <div class="container clearfix">
                <div class="right_col" role="main">

                <?= $this->Flash->render() ?>
                
                <?= $this->fetch('content') ?>

                </div>
            </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>

            <?= $this->element('layout_elements/footer'); ?>
          
        </footer>
        <!-- /footer content -->
      </div>
    </div>  
   
    <?= $this->element('layout_elements/scripts'); ?>

</body>
</html>