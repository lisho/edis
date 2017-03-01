<!DOCTYPE html>
<html>
<head>
    <!-- <?= $this->Html->charset() ?> -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>
        <!-- <?= $this->fetch('title') ?> -->
    </title>
    <!-- <?= $this->Html->css('pdf.css', ['fullBase' => true]) ?> -->

    <link rel="stylesheet" href="<?= CSS; ?>pdf.css" />
    
</head>
<body>
    <div class="header">
        <table class="table">
            <tr>
                <td id="td1">

                <img src="<?= IMAGES; ?>logo_concejalia.jpg" alt="" class="logo_pdf">

                
                <p>CONCEJALIA DE FAMILIA Y SERVICIOS SOCIALES</p>
                </td>

                <td id="td2"><img src="<?= IMAGES; ?>leon_cuna.jpg" alt="" class="logo_pdf">
                </td>

            </tr>
        </table>
    </div> 

    <div class="footer">
        <hr>
        Pág. <span class="pagenum"></span>
    </div>   


   
        <div id="content">    
            <?= $this->fetch('content') ?>
        </div>


        

</body>
</html>

