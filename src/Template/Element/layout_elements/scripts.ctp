
<!-- ******** SCRIPTS ********* -->

    <!-- jQuery -->
    <?= $this->Html->script('jquery.min.js') ?>
   
    <!-- Bootstrap -->
    <?= $this->Html->script('bootstrap.min.js') ?>
   
    <!-- FastClick -->
     <?= $this->Html->script('fastclick.js') ?>
   
    <!-- JQ- TextEditor -->
    <?= $this->Html->script('jq-te/jquery-te-1.4.0.min.js') ?>
  
    <!-- bootstrap-progressbar -->
    <?= $this->Html->script('bootstrap-progressbar.min.js') ?>
  
    <!-- iCheck -->
    <?= $this->Html->script('iCheck/icheck.min.js') ?>
 
    <!-- Datatables -->

    <?= $this->Html->script('datatables.net/js/jquery.dataTables.js') ?>
    <?= $this->Html->script('datatables.net-bs/js/dataTables.bootstrap.min.js') ?>
    <?= $this->Html->script('datatables.net-buttons/js/dataTables.buttons.min.js') ?>
    <?= $this->Html->script('datatables.net-buttons-bs/js/buttons.bootstrap.min.js') ?>
    <?= $this->Html->script('datatables.net-buttons/js/buttons.flash.min.js') ?>
    <?= $this->Html->script('datatables.net-buttons/js/buttons.html5.min.js') ?>
    <?= $this->Html->script('parsleyjs/dist/parsley.min.js') ?>
    <?= $this->Html->script('datatables.net-buttons/js/buttons.print.min.js') ?>
    
    <? // $this->Html->script('pdfmake/build/pdfmake.min.js') ?>
    <? // $this->Html->script('pdfmake/build/vfs_fonts.js') ?>

    <!-- Custom Theme Scripts -->
     <?= $this->Html->script('custom.min.js') ?>


<!-- Datatables -->
    
    <script>
    /*
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($("#datatable-buttons").length) {
            $("#datatable-buttons").DataTable({
              dom: "Bfrtip",
              buttons: [
                {
                  extend: "copy",
                  className: "btn-sm"
                },
                {
                  extend: "csv",
                  className: "btn-sm"
                },
                {
                  extend: "excel",
                  className: "btn-sm"
                },
                {
                  extend: "pdfHtml5",
                  className: "btn-sm"
                },
                {
                  extend: "print",
                  className: "btn-sm"
                },
              ],
              responsive: true
            });
          }
        };

        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
              handleDataTableButtons();
            }
          };
        }();

        $('#datatable').dataTable();
        $('#datatable-keytable').DataTable({
          keys: true
        });

        $('#datatable-responsive').DataTable();

        $('#datatable-scroller').DataTable({
          ajax: "js/datatables/json/scroller-demo.json",
          deferRender: true,
          scrollY: 380,
          scrollCollapse: true,
          scroller: true
        });

        var table = $('#datatable-fixed-header').DataTable({
          fixedHeader: true
        });

        TableManageButtons.init();
      });
    */
    </script>
    <!-- /Datatables -->


    <?= $this->fetch('script') ?>

    