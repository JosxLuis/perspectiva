<!DOCTYPE HTML>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>INICIO - <?php echo PROYECTO; ?></title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>    
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo URL; ?>css/skeleton<?php echo MIN; ?>.css">
    <link rel="stylesheet" href="<?php echo URL; ?>css/layout<?php echo MIN; ?>.css">
    <link rel="stylesheet" href="<?php echo URL; ?>css/icons/flaticon/icons<?php echo MIN; ?>.css">
    <link rel="stylesheet" href="<?php echo URL; ?>css/icons/fontawesome/fontawesome<?php echo MIN; ?>.css">

    <!-- Favicons -->
    <link rel="shortcut icon" href="<?php echo URL; ?>img/favicon.png">
    <link rel="apple-touch-icon" href="<?php echo URL; ?>img/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo URL; ?>img/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo URL; ?>img/apple-touch-icon-114x114.png">
</head>
<body>
<?php include(PREFIJO.'header.php'); ?>
    
    <div class="main-section">
        <div id="slides">
            <ul class="slides-container">
                <li>
                    <a href="<?php echo URL; ?>consultar/?>"><img src="img/slider/slider.jpg" alt="PERSPECTIVA CONSULTAR"></a>
                </li>
                <li>
                    <img src="img/slider/publicidad.jpg" alt="publicidad">
                </li>
                <li>
                    <img src="img/slider/publicidad.jpg" alt="publicidad">
                </li>
            </ul>
            <nav class="slides-navigation">
                    <a href="javascript:;" class="next"><i class="flaticon-arrow-slider-2"></i></a>
                    <a href="javascript:;" class="prev"><i class="flaticon-arrow-slider-1"></i></a>
            </nav>
        </div>
    </div>    

    <div class="top-footer">
        <div class="box">
            <ul class="social-footer">
                <li>
                    <a href="#" target="_blank">
                        <div class="square">
                            <i class="fa fa-facebook"></i>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#" target="_blank">
                        <div class="square">
                            <i class="fa fa-twitter"></i>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#" target="_blank">
                        <div class="square">
                            <i class="fa fa-instagram"></i>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#" target="_blank">
                        <div class="square">
                            <i class="fa fa-youtube"></i>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
 
    
<?php include(PREFIJO.'footer.php'); ?>
<script src="<?php echo URL; ?>js/slider/jquery.superslides<?php echo MIN; ?>.js"></script>
 <script src="<?php echo URL; ?>js/bxslider/jquery.bxslider<?php echo MIN; ?>.js"></script>
<script>
    $(document).ready(function(){
            $('#slides').superslides({
                animation: 'fade',
                hashchange:false,
                play:8000,
                pagination:false,
                inherit_width_from:'.main-section',
                inherit_height_from:'.main-section'
             });
    });
</script>
</body>
</html>
