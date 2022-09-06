<?php
defined('BASEPATH') or exit('Ação não permitida');
?>

<!DOCTYPE html>
<html lang="pt-br">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="Claudemir da Silva Lopes">


        <?php echo (isset($titulo) ? '<title>Bluesun do Brasil | '.$titulo.'</title>' : '<title>Bluesum Solar do Brasil | Administrativo</title>'); ?>
        
        <link rel="apple-touch-icon" href="<?php echo base_url('public/images/logo_bsum01.png'); ?>">
        <link rel="shortcut icon" href="<?php echo base_url('public/images/favicon.ico'); ?>">
    
        <!-- Custom fonts for this template-->
        <link rel="stylesheet" href="<?php echo base_url('public/vendors/bootstrap/dist/css/bootstrap.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('public/vendors/font-awesome/css/font-awesome.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('public/vendors/themify-icons/css/themify-icons.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('public/vendors/flag-icon-css/css/flag-icon.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('public/vendors/selectFX/css/cs-skin-elastic.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('public/vendors/jqvmap/dist/jqvmap.min.css'); ?>">

        <!-- Custom styles for this template-->
        <link rel="stylesheet" href="<?php echo base_url('public/assets/css/style.css'); ?>">
        <style>
            .text {
              position: relative;
              padding: 2rem 1rem;
              font-size: 3em;
              opacity: 0;
              animation: fadeInText 0s 0.1s both;
            }

            .text-block {
              position: relative;
              overflow: hidden;
            }

            .text-block:after {
              content: "";
              position: absolute;
              top: 85px;
              left: 0;
              width: 100%;
              height: 50%;
              background: #c48e84;
              transform: translateX(-100%);
              animation: enlargeBlock 0.5s 0.6s both, revealBlock 0.5s 1.1s both;
            }

            @keyframes fadeInText {
              from {
                opacity: 0;
              }
              to {
                opacity: 1;
              }
            }

            @keyframes enlargeBlock {
              from {
                width: 0%;
              }
              to {
                width: 100%;
              }
            }

            @keyframes revealBlock {
              from {
                transform: translateX(0);
              }
              to {
                transform: translateX(100%);
              }
            }
          </style>
    </head>

    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- 404 Error Text -->
                <div class="text-center text" style="margin-top: 5%">
                    <div class="error mx-auto text-danger font-weight-bold text-block text" data-text="404">404</div>
                    <p class="lead text-gray-900 mb-5" style="font-size: 1.0em;">Página não encontrada</p>
                    <p class="text-gray-500 mb-5">Parece que você encontrou uma falha na matrix...</p>
                    <script>
                    function goBack() {
                        window.history.back()
                    }
                    </script>
<!--                    <a class="btn btn-outline-secondary" href="<?php echo base_url('/'); ?>">Voltar para a plataforma</a>-->
                    <button onclick="goBack()" type="button" class="btn btn-outline-secondary">Voltar para a plataforma</button>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Content Wrapper -->

    </body>
    <!-- End of Page Wrapper -->

