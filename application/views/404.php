<?php

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Datalab Center</title>


    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?= base_url(); ?>admin_lte/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>admin_lte/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url(); ?>admin_lte/plugins/iCheck/square/blue.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>admin_lte/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>admin_lte/css/skins/blue-layout.css">
    
    <link rel="apple-touch-icon" sizes="57x57" href="<?= base_url();?>favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?= base_url();?>favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= base_url();?>favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url();?>favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= base_url();?>favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= base_url();?>favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?= base_url();?>favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= base_url();?>favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url();?>favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?= base_url();?>favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url();?>favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= base_url();?>favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url();?>favicon/favicon-16x16.png">

    <link rel="manifest" href="<?= base_url();?>favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?= base_url();?>favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="hold-transition login-page" style="background-color: #FFFFFF;">
<!--404 Error-->
<section id="error-page" class="screen-height center">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center error-block">
                <a href="<?= site_url(); ?>"><img style="" src="<?= base_url('assets\logo.png');?>" /></a>
                <h1 style="text-align: center;font-size: 150px">404</h1>
                <p style="text-align: center;font-size: 20px">No econtramos el Elemento<br> busque en Nuestro Sitio</p>
                <a class="btn btn-primary btn-lg" href="<?= base_url();?>"><i class="fa fa-chevron-left"></i> Ir a la Portada</a>
            </div>
        </div>
    </div>
</section>
<!--All Script-->
<!-- jQuery 2.1.4 -->
<script src="<?= base_url(); ?>admin_lte/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="<?= base_url(); ?>admin_lte/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?= base_url(); ?>admin_lte/plugins/iCheck/icheck.min.js"></script>


</body>
</html>
