    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

<?= $this->Flash->render('auth'); ?>
      
      <div class="login_inicial text-center">
          <p class="">r<b>edis</b>eñándonos</p>
          <button type="button" class="btn btn-primary">Entrar</button>
      </div>

      <div class="login_wrapper">
        <div class="animate form login_form">

          <section class="login_content">
           <h2 class="titulo_inicial text-center">ediSemos</h2>
            <?= $this->Form->create(); ?>

              <h1><?= $this->Html->image('escudo_color.svg', ['class'=> 'logo-login']) ?></h1>
              <div>

                <?= $this->Form->input('user', [
                                            //'type'=>"text",
                                            'class'=>"form-control",
                                            'placeholder'=>"Usuario", 'required'=>"required",
                                            'label'=>false
                                          ]); ?>
                
              </div>

              <div>

                <?= $this->Form->input('password', [
                                            'type'=>"password",
                                            'class'=>"form-control",
                                            'placeholder'=>"Contraseña", 'required',
                                            'label'=>false
                                          ]); ?>
                
              </div>
              <div>

                <?= $this->Form->button('Entrar', [
                                            
                                            'class'=>"btn btn-default submit",
                                            
                                          ]); ?>

                <!-- <a class="btn btn-default submit" href="index.html">Log in</a>
                 <a class="reset_pass" href="#">Lost your password?</a> -->
              </div>

              <div class="clearfix"></div>

              <div class="separator">

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1>Equipos de Inclusión Social</h1>
                  <h4>Ayuntamiento de León</h4>
                </div>
              </div>
             <?= $this->Form->end(); ?>
          </section>
        </div>

      </div>
    </div>

