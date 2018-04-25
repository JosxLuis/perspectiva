<?php 

    $consulta = devolverValorQuery("SELECT * FROM ".DB_PREFIJO."director");

?>
<!DOCTYPE HTML>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuestro director - <?php echo PROYECTO; ?></title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>    
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo URL; ?>css/skeleton.css">
    <link rel="stylesheet" href="<?php echo URL; ?>css/layout.css">
    <link rel="stylesheet" href="<?php echo URL; ?>css/icons/flaticon/icons.css">
    <link rel="stylesheet" href="<?php echo URL; ?>css/icons/fontawesome/fontawesome.css">

    <!-- Favicons -->
    <link rel="shortcut icon" href="<?php echo URL; ?>img/favicon.png">
    <link rel="apple-touch-icon" href="<?php echo URL; ?>img/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo URL; ?>img/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo URL; ?>img/apple-touch-icon-114x114.png">
</head>
<body>
<?php include(PREFIJO.'header.php'); ?>

    <div class="headline3 sec-third-color ">
        <div class="container">
            <div class="sixteen columns">
                <div class="box pd-60">
                    <h3 class="lt-bold col-third">Nuestro Director</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="navegacion">
                <ul>
                    <li><a href="<?php echo URL; ?>">Inicio</a></li>
                    <li class="separador">/</li>
                    <li>Nuestro Director</li>
                </ul>
                <div class="clear"></div>
            </div>
        </div>
    </div>

    <div class="section director">
        <div class="container">
            <div class="historia">
                <div class="five columns">
                    <div class="integrante">
                        <div class="foto">
                            <img src="<?php echo URL.$consulta['portada']; ?>" alt="">
                        </div>
                        <div class="box">
                            <div class="info">
                                <h5><?php echo utf8_encode($consulta['titulo']);?></h5>
                                <p>Director General</p>
                            </div>
                        </div>    
                    </div>
                </div>
                <div class="eleven columns">
                    <div class="desc">
                        <p><?php echo utf8_encode($consulta['descripcion']);?></p>
                    </div>
                </div>
            </div>     
        </div>
    </div> 
    <?php include(PREFIJO.'footer.php'); ?>
    </body>
</html>
