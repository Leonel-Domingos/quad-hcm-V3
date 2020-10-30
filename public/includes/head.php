<head>
    <meta charset="utf-8">
    <title><?= $_title ?? 'SmartAdmin PHP' ?></title>
    <meta name="description" content="<?= $_title ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <!-- Call App Mode on ios devices -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <!-- base css -->
    <link rel="stylesheet" media="screen, print" href="<?= ASSETS_URL ?>/css/vendors.bundle.css">
    <link rel="stylesheet" media="screen, print" href="<?= ASSETS_URL ?>/css/app.bundle.css">
    <!-- Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= ASSETS_URL ?>/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= ASSETS_URL ?>/img/favicon/favicon-32x32.png">
    <link rel="mask-icon" href="<?= ASSETS_URL ?>/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="hostname" content="<?= SERVER_NAME ?>">
    <meta name="app-url" content="<?= APP_URL ?>">
    <meta name="assets-url" content="<?= ASSETS_URL ?>">
    <meta name="environment" content="<?= getenv('ENVIRONMENT') ?>">
    <!-- Optional: page related CSS -->
    <link rel="stylesheet" media="screen, print" href="<?= ASSETS_URL ?>/css/datepicker.css">
    <link rel="stylesheet" media="screen, print" href="<?= ASSETS_URL ?>/css/timepicker.css">
    <link rel="stylesheet" media="screen, print" href="<?= ASSETS_URL ?>/css/slider.css">
    <!-- PHP docs -->
    <link rel="stylesheet" media="screen, print" href="<?= ASSETS_URL ?>/css/markdown.css">

    <!-- Icons: FontAwesome -->
    <link rel="stylesheet" media="screen, print" href="<?= ASSETS_URL ?>/css/fa-brands.css">
    <link rel="stylesheet" media="screen, print" href="<?= ASSETS_URL ?>/css/fa-duotone.css">
    <link rel="stylesheet" media="screen, print" href="<?= ASSETS_URL ?>/css/fa-light.css">
    <link rel="stylesheet" media="screen, print" href="<?= ASSETS_URL ?>/css/fa-regular.css">
    <link rel="stylesheet" media="screen, print" href="<?= ASSETS_URL ?>/css/fa-solid.css">

    <!-- Classes específicas desta nova versão SmartAdmin -->
    <link rel="stylesheet" media="screen, print" href="<?= ASSETS_URL ?>/css/novo_css.css">
    
    <?= $_head ?? '' ?>
</head>
