<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <!-- <link rel="manifest" href="manifest.json" /> -->

  <link rel="icon" type="image/png" sizes="72x72" href="<?= assets('images/icons/icon-72x72.png'); ?>">
  <link rel="icon" type="image/png" sizes="96x96" href="<?= assets('images/icons/icon-96x96.png'); ?>">
  <link rel="apple-touch-icon" href="<?= assets('images/icons/icon-72x72.png'); ?>"/>
  <link rel="apple-touch-icon" href="<?= assets('images/icons/icon-96x96.png'); ?>"/>
  <link rel="apple-touch-icon" href="<?= assets('images/icons/icon-128x128.png'); ?>"/>
  <link rel="apple-touch-icon" href="<?= assets('images/icons/icon-144x144.png'); ?>"/>
  <link rel="apple-touch-icon" href="<?= assets('images/icons/icon-152x152.png'); ?>"/>
  <link rel="apple-touch-icon" href="<?= assets('images/icons/icon-192x192.png'); ?>"/>
  <link rel="apple-touch-icon" href="<?= assets('images/icons/icon-384x384.png'); ?>"/>
  <link rel="apple-touch-icon" href="<?= assets('images/icons/icon-512x512.png'); ?>"/>
  <meta name="apple-mobile-web-app-status-bar" content="#EEE" />
  <meta name="theme-color" content="#EEE" />
  <!-- and ios support -->

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
    rel="stylesheet">

  <!-- DEPENDENCIES APP -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" />
  <!-- AND DEPENDENCIES APP -->

  <!-- STYLED APP -->
  <!-- tokens app -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="<?= assets('style/css/pages/auth.css'); ?>">
  <link rel="stylesheet" href="<?= assets('style/css/main.css'); ?>">
  <!-- AND STYLED APP -->
</head>

<body class="light-theme-brand w-100">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  <?php $this->block('script'); ?>
</body>
</html>
