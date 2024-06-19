<?php $this->extend('layout/auth/layout') ?>

<?php $this->startBlock('content'); ?>
<div class="auth-content-form-header">
  <img src="<?= assets('images/logo-dark.png')?>" class="brand-mobile" height="30">
  <h1>Recuperar senha</h1>
  <p>Para ter acesso a todas funcionalidades inovadoras informe seus dados e acesse.</p>
</div>

<div class="auth-content-form-field">
  <div data-test="cnpj-field" class="">
    <label for="cnpj" class="field-label">CNPJ</label>
    <input type="text" class="dy-field cnpj" id="cnpj" name="cnpj" aria-describedby="cnpjHelp" data-test="cnpj" autocomplete="on">
  </div>

  <div data-test="user-field" class="">
    <label for="email" class="field-label">Email</label>
    <input type="text" class="dy-field" id="email" name="email" autocomplete="email">
  </div>
</div>

<div class="auth-content-form-footer">
  <hr>
  <button class="dy-btn dy-btn--with-icon --brand" id="btn-acessar">
    <span>Recuperar</span>
    <i class='bx bx-right-arrow-alt'></i>
  </button>

  <a href="/login" class="dy-btn --brand --link" id="btn-acessar">
    <span>Acessar minha conta</span>
  </a>
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
      alert('em construção');
    });
  });
</script>
<?php $this->endBlock(); ?>
