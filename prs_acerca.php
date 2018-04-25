<?php 

    $consulta = devolverValorQuery("SELECT * FROM ".DB_PREFIJO."acerca");

?>
<!DOCTYPE HTML>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acerca - <?php echo PROYECTO; ?></title>
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

    <div class="section sec-white">
        <div class="container">
            <div class="navegacion">
                <ul>
                    <li><a href="<?php echo URL; ?>">Inicio</a></li>
                    <li class="separador">/</li>
                    <li>Acerca</li>
                </ul>
                <div class="clear"></div>
            </div>
        </div>
    </div>

    <div class="section acerca">
        <div class="container">
            <div class="historia">
                <div class="eight columns">
                    <h4>PERSPECTIVA</h4>
                    <div class="linea"></div>
                    <h3>Misión:</h3>
                    <p>Crear una herramienta que facilite la búsqueda de noticias verídicas mediante la participación ciudadana.</p>
                    <h3>Visión:</h3>
                    <p>Crear una sociedad a nivel internacional que busque frenar el impacto que las noticias falsas tienen, y que sean conscientes del poder que su participación tiene para erradicar este problema.</p>
                    <h3>Valores:</h3>
                    <p>Honestidad: en todo momento mantendremos un punto de vista objetivo, para brindarle a nuestros clientes una plataforma en la que se pueda confiar.</p>
                    <p>Responsabilidad social: buscaremos que las validaciones presentadas en nuestra plataforma incluyan diversas opiniones, para poder darle a la sociedad noticias verificadas.</p>
                    <p>Transparencia: los usuarios podrán saber cómo se lleva a cabo la validación de las noticias</p>
                    <h3>Historia:</h3>
                    <p>Esta iniciativa se creó al darnos cuenta del gran impacto que las noticias falsas. No nos podíamos quedar con las manos cruzadas, por eso, hoy les brindamos este servicio para que a ustedes se les facilite encontrar noticias válidas, y que puedan comprobar aquellas que tienen una validez dudosa.</p>
                    <br><br>
                </div>
                <div class="eight columns">
                    <div class="box mh-100 tx-cen pd-all-10 acercaportada">
                        <img src="../img/acerca.jpg" alt="PERSPECTIVA">
                    </div>
                </div>
            </div>     
        </div>
    </div> 

    <?php include(PREFIJO.'footer.php'); ?>
    </body>
</html>
