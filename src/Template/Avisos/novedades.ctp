<h1><i class="fa fa-bell"></i>  Novedades en EDISEMOS.</h1>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Actualizaciones y novedades de la app Edisemos</h2>
                <?= $this->Element('menus/menu_panel');?>                
                <div class="clearfix"></div>
            </div>
            <div class="x_content">    
                <?php foreach ($novedades as $novedad): ?>
                    <h2><?= $this->Time->format($novedad->created, "dd/MM/yyyy", null) ?></h2>
                    <h1><small> <?= $novedad->titulo; ?></small></h1>
                    <div>
                        <?= $novedad->description; ?>
                    </div>
                <?php endforeach; ?>
                <hr>
            </div> 
        </div>
    </div>
</div>