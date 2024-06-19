<?php $this->extend('layout/auth/layout') ?>

<?php $this->startBlock('content'); ?>
<div class="auth-content-form-header">
  <img src="<?= assets('images/logo-dark.png')?>" class="brand-mobile" height="30">
  <h1>Login</h1>
  <p>Para ter acesso a todas funcionalidades inovadoras informe seus dados e acesse.</p>
</div>

<div class="auth-content-form-field">
  <div data-test="cnpj-field" class="">
    <label for="cnpj" class="field-label">CNPJ</label>
    <input type="text" class="dy-field cnpj" id="cnpj" name="cnpj" aria-describedby="cnpjHelp" data-test="cnpj" autocomplete="on">
  </div>

  <div data-test="user-field" class="">
    <label for="username" class="field-label">Usuário</label>
    <input type="text" class="dy-field" id="username" name="username" autocomplete="username">
  </div>

  <div data-test="senha-field" class="">
    <label for="password" class="field-label">Senha</label>
    <a href="/recuperar-senha" class="reset-pass dy-link">Recuperar senha</a>
    <input type="password" class="dy-field" name="password" id="password" autocomplete="current-password">
    <i class="bx bx-show pass dy-icon--field dy-icon--with-pointer"></i>
    <i class="bx bx-hide d-none pass dy-icon--field dy-icon--with-pointer"></i>
  </div>

  <div data-test="rememberme-field" class="dy-toggle-content">
    <input type="checkbox" class="dy-toggle" name="rememberme" id="rememberme  " />
    <label class="" for="rememberme">
      <p>
        Manter-me logado por 30 dias
      </p>
      <!-- <p class="dy-help-text">
                  Ao aceitar essa opção iremos te logado durante 30 dias, depois você fará o login novamente 
                </p> -->
    </label>
  </div>
</div>

<div class="auth-content-form-footer">
  <hr>
  <button class="dy-btn dy-btn--with-icon --brand" id="btn-acessar">
    <span>Acessar agora</span>
    <i class='bx bx-right-arrow-alt'></i>
  </button>
</div>
<?php $this->endBlock(); ?>



<?php $this->startBlock('script'); ?>
<script src="<?= assets('js/validation/cnpj.js'); ?>"></script>

<script type="text/javascript">
  $(document).ready(function() {
    if ($('.cnpj')) {
      $('.cnpj').mask('00.000.000/0000-00', {
        reverse: true
      });
    }

    $('#btn-acessar').on('click', function(event) {
      event.preventDefault()
      location.assign('/dashboard');
    });

    const inputPassword = $('input[type="password"]');
    $('.bx-show').on('click', function() {
      $(this).addClass('d-none');
      $('.bx-hide').removeClass('d-none');

      inputPassword.attr('type', 'text');
      inputPassword.focus();
    });

    $('.bx-hide').on('click', function() {
      $(this).addClass('d-none');
      $('.bx-show').removeClass('d-none');

      inputPassword.attr('type', 'password');
      inputPassword.focus();
    });
  });
</script>
<?php $this->endBlock(); ?>
