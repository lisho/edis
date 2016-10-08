<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <title>
        <?// $this->fetch('title') ?>
    </title>
    <!-- Bootstrap -->
    
    <?= $this->Html->css('pdf.css', ['fullBase' => true]) ?>

</head>
<body>
    <div class="header">
        <table class="table">
            <tr>
                <td id="td1"><img src="/opt/lampp/htdocs/edis/webroot/img/logo_concejalia.jpg" alt="" class="logo_pdf">
                <p>CONCEJALIA DE FAMILIA Y SERVICIOS SOCIALES</p>
                </td>

                <td id="td2"><img src="/opt/lampp/htdocs/edis/webroot/img/leon_cuna.jpg" alt="" class="logo_pdf">
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

