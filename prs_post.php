<!DOCTYPE HTML>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Título de la noticia - <?php echo PROYECTO; ?></title>
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

    <div class="section">
        <div class="container">
            <div class="navegacion">
                <ul>
                    <li><a href="<?php echo URL; ?>">Inicio</a></li>
                    <li class="separador">/</li>
                    <li>Título de la noticia</li>
                </ul>
                <div class="clear"></div>
            </div>
        </div>
    </div>

    <div class="noticias-post">
        <div class="container">
            <div class="two-thirds column">
                <div class="noticia-post">
                    <div class="portada">
                        <a><img src="../img/politica.jpg" alt=""></a>
                    </div>
                    <div class="box">
                        <div class="status">
                            <div class="elementos pd-hor-3">
                                <a href="#">Categoria</a>
                                <i class="fa fa-calendar"><span>hace 20 dias</span></i>
                            </div>
                        </div>
                    </div>
                    <div class="box pd-all-3">
                        <div class="descripcion">
                            <h2>Título</h2>
                            <blockquote>Introducción: esto es un ejemplo de como se apreciaria la noticia</blockquote>
                           <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut voluptatum omnis minima explicabo quos magni aliquam inventore, consequuntur sequi repellat error labore ad, voluptates maiores consectetur soluta rerum illo? Sunt.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="one-third column">
                <div class="categorias">
                    <div class="box">
                        <h5>Categorías</h5>
                        <ul class="list-categoria">
                            <li class="current"><a href="<?php echo URL; ?>blog/">Todo <div class="cant"></div></a></li>
                            <li><a href="#">Noticia<div class="cant"><span class="sec-blue">12</span></div></a></li>
                                
                        </ul>  
                    </div>
                </div> 
            </div>
        </div>
    </div>
    
    <?php include(PREFIJO.'footer.php'); ?>
    </body>
</html>
