<?php
    $consulta = devolverValorQuery("SELECT * FROM ".DB_PREFIJO."post WHERE id".DB_PREFIJO."post=".$_GET['id']."");
    $categoria = devolverValorQuery("SELECT * FROM ".DB_PREFIJO."post_categoria WHERE id".DB_PREFIJO."post_categoria=".$consulta['id'.DB_PREFIJO.'post_categoria']."");
    $tituloCategoriaURL = limpiar_cadena(utf8_encode($categoria['titulo']));
    
    $categorias = "SELECT * FROM ".DB_PREFIJO."post_categoria";
    $resCategoria = mysqli_query($conexion,$categorias);
?>
<!DOCTYPE HTML>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo utf8_encode($consulta['titulo']); ?> - <?php echo PROYECTO; ?></title>
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
                    <li>Titulo de la noticia</li>
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
                        <a><img src="<?php echo URL.$consulta['portada']; ?>" alt=""></a>
                    </div>
                    <div class="box">
                        <div class="status">
                            <div class="elementos pd-hor-3">
                                <a href="<?php echo URL; ?>blog/categoria/<?php echo $consulta['id'.DB_PREFIJO.'post_categoria']; ?>/<?php echo $tituloCategoriaURL; ?>/"><?php echo utf8_encode(mostrarNombre($consulta['id'.DB_PREFIJO.'post_categoria'],"post_categoria","titulo")); ?></a>
                                <i class="fa fa-calendar"><span><?php echo tiempoDesde($consulta['creado']); ?></span></i>
                            </div>
                        </div>
                    </div>
                    <div class="box pd-all-3">
                        <div class="descripcion">
                            <h2><?php echo utf8_encode($consulta['titulo']); ?></h2>
                            <blockquote><?php echo utf8_encode($consulta['introduccion']); ?></blockquote>
                           <p><?php echo utf8_encode($consulta['descripcion']); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="one-third column">
                <div class="categorias">
                    <div class="box">
                        <h5>Categorías</h5>
                        <ul class="list-categoria">
                            <!--<li class="current"><a href="<?php echo URL; ?>blog/">Todo <div class="cant"></div></a></li>-->
                                <?php 
                                while($rowCategoria = mysqli_fetch_array($resCategoria)){ 
                                    $cadenaCategoriaURL = utf8_encode($rowCategoria['titulo']);
                                    $tituloCategoriaURL = limpiar_cadena($cadenaCategoriaURL);
                                    $cantidadBlogCategoria = cantidadRegistros("SELECT * FROM ".DB_PREFIJO."post WHERE id".DB_PREFIJO."post_categoria=".$rowCategoria['id'.DB_PREFIJO.'post_categoria']." AND status=1");
                                ?>
                            <li><a href="<?php echo URL; ?>blog/categoria/<?php echo $rowCategoria['id'.DB_PREFIJO.'post_categoria']; ?>/<?php echo $tituloCategoriaURL; ?>/"><?php echo utf8_encode($rowCategoria['titulo']); ?> <div class="cant"><span class="sec-third-color"><?php echo $cantidadBlogCategoria; ?></span></div></a></li>
                                <?php } ?>
                        </ul>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    
    <?php include(PREFIJO.'footer.php'); ?>
    </body>
</html>
