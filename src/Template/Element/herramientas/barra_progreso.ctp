        <div class="progress">
          <div id="bar" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
            <span class="sr-only">0% Complete</span>
          </div>
        </div>

        <script>
            var progreso = 0;
            var idIterval = setInterval(function(){
              // Aumento en 10 el progeso
              progreso +=20;
              $('#bar').css('width', progreso + '%');
                 
              //Si llegó a 100 elimino el interval
              if(progreso == 100){
                clearInterval(idIterval);
                jQuery(document).ready(function($) {
                     $('.progress').addClass('hidden');
                });
               
              }
            },200);
        </script>