<!DOCTYPE html>
<html lang="es">
<head>

    <?= $this->element('layout_elements/head'); ?>

</head>
<body class="nav-md">

    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>EdisLeon</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>John Doe</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
             <?= $this->element('menus/sidebar'); ?>   
            <!-- /sidebar menu -->

           
          </div>
        </div>

        <!-- top navigation -->
            <?= $this->element('menus/menu_principal'); ?>
        <!-- /top navigation -->

        <!-- page content -->        
        
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