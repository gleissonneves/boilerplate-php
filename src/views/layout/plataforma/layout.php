<!DOCTYPE html>
<html lang="pt-BR">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="icon" type="image/png" sizes="72x72" href="<?= assets('images/icons/icon-72x72.png'); ?>">
  <link rel="icon" type="image/png" sizes="96x96" href="<?= assets('images/icons/icon-96x96.png'); ?>">
  <link rel="apple-touch-icon" href="<?= assets('images/icons/icon-72x72.png'); ?>" />
  <link rel="apple-touch-icon" href="<?= assets('images/icons/icon-96x96.png'); ?>" />
  <link rel="apple-touch-icon" href="<?= assets('images/icons/icon-128x128.png'); ?>" />
  <link rel="apple-touch-icon" href="<?= assets('images/icons/icon-144x144.png'); ?>" />
  <link rel="apple-touch-icon" href="<?= assets('images/icons/icon-152x152.png'); ?>" />
  <link rel="apple-touch-icon" href="<?= assets('images/icons/icon-192x192.png'); ?>" />
  <link rel="apple-touch-icon" href="<?= assets('images/icons/icon-384x384.png'); ?>" />
  <link rel="apple-touch-icon" href="<?= assets('images/icons/icon-512x512.png'); ?>" />
  <meta name="apple-mobile-web-app-status-bar" content="#EEE" />
  <meta name="theme-color" content="#EEE" />

  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <!-- INIT STYLED APP -->
  <!-- tokens app -->
  <link rel="stylesheet" href="<?= assets('style/css/main.css') ?>">
  <link rel="stylesheet" href="<?= assets('style/css/components/template/skeleton.css') ?>">
  <!-- AND STYLED APP -->

  <!-- styled especifico -->
  <?php $this->block('css'); ?>
</head>

<body class="light-theme-brand">
  <?php require_once('sidebar.php'); ?>

  <main>
    <?php require_once('header.php'); ?>

    <?php $this->block('content'); ?>

  </main>
  <?php require_once('footer.php'); ?>

  <?php $this->block('script'); ?>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>

  <!-- DEPENDENCIES APP -->
  <!-- ADICIONE OS MODULOS JS AQUI -->
  <script type="module" src="<?= assets('/modules/coloque-o-script', 'resources') ?>"></script>
</body>
</html>