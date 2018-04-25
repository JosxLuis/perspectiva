<?php
    //param of url to specify page_number
   
     $get_param='page';
        
     //get current page from url  
     $current_page=(isset($_GET[$get_param]) &&
     is_numeric($_GET[$get_param]))?$_GET[$get_param]:1;
      //notice: when get param , you should SAFE it

    $url = URL."blog/";

    $cantidaBlog = cantidadRegistros("SELECT * FROM ".DB_PREFIJO."post WHERE status=1 AND id".DB_PREFIJO."post_categoria=".$_GET['id']."");

    $cat=new pagination($cantidaBlog,8,$current_page,5 /*number of button*/);
    if($cantidaBlog != 0){
        $blog = "SELECT * FROM ".DB_PREFIJO."post WHERE status=1 AND id".DB_PREFIJO."post_categoria=".$_GET['id']." ORDER BY id".DB_PREFIJO."post  DESC LIMIT $cat->Start,$cat->End";
        $resBlog = mysqli_query($conexion,$blog);   
    }

    $categorias = "SELECT * FROM ".DB_PREFIJO."post_categoria";
    $resCategoria = mysqli_query($conexion,$categorias);

    $categoria = devolverValorQuery("SELECT * FROM ".DB_PREFIJO."post_categoria WHERE id".DB_PREFIJO."post_categoria=".$_GET['id']." ");
?>
<!DOCTYPE HTML>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo utf8_encode($categoria['titulo']); ?> - <?php echo PROYECTO; ?></title>
    <meta name="keywords" content="" />
    <meta name="description" content="<?php echo utf8_encode($categoria['descripcion']); ?>" />
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
                    <h3 class="lt-bold col-third"><?php echo utf8_encode($categoria['titulo']); ?></h3>
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
                    <li><a href="<?php echo URL; ?>blog/">Blog</a></li>
                    <li class="separador">/</li>
                    <li><?php echo utf8_encode($categoria['titulo']); ?></li>
                </ul>
                <div class="clear"></div>
            </div>
        </div>
    </div>

    <div class="noticias">
        <div class="container">
            <div class="two-thirds column">
                 <?php if($cantidaBlog != 0){
                    while($rowBlog = mysqli_fetch_array($resBlog)){
                        $tituloURL = limpiar_cadena(utf8_encode($rowBlog['titulo']));
                        $tituloCategoriaURL = limpiar_cadena(utf8_encode(mostrarNombre($rowBlog['id'.DB_PREFIJO.'post_categoria'],"post_categoria","titulo")));
                ?>  
                <div class="noticia">
                    <div class="portada">
                        <a href="<?php echo URL; ?>blog/post/<?php echo $rowBlog['id'.DB_PREFIJO.'post']; ?>/<?php echo $tituloURL; ?>/"><img src="<?php echo URL.$rowBlog['portada']; ?>" alt=""></a>
                    </div>
                    <div class="box">
                        <div class="status">
                            <div class="elementos pd-hor-3">
                                <a href="<?php echo URL; ?>blog/categoria/<?php echo $rowBlog['id'.DB_PREFIJO.'post_categoria']; ?>/<?php echo $tituloCategoriaURL; ?>/"><?php echo utf8_encode(mostrarNombre($rowBlog['id'.DB_PREFIJO.'post_categoria'],"post_categoria","titulo")); ?></a>&nbsp;
                                <i class="fa fa-calendar-o"><span><?php echo tiempoDesde($rowBlog['creado']); ?></span></i>
                            </div>
                        </div>
                    </div>
                    <div class="box pd-all-3">
                        <div class="descripcion">
                            <a href="<?php echo URL; ?>blog/post/<?php echo $rowBlog['id'.DB_PREFIJO.'post']; ?>/<?php echo $tituloURL; ?>/"><h2><?php echo utf8_encode($rowBlog['titulo']); ?></h2></a>
                            <p><?php echo utf8_encode($rowBlog['introduccion']); ?>.</p>
                        </div>
                    </div>
                </div>
                <?php 
                    } 
                }else{ ?>
                    <div class="tx-cen no-registro">No hay Registros</div>
                <?php } ?>
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
                            <li><a href="<?php echo URL; ?>blog/categoria/<?php echo $rowCategoria['id'.DB_PREFIJO.'post_categoria']; ?>/<?php echo $tituloCategoriaURL; ?>/"><?php echo utf8_encode($rowCategoria['titulo']); ?> <div class="cant"><span class="sec-blue"><?php echo $cantidadBlogCategoria; ?></span></div></a></li>
                                <?php } ?>
                        </ul>  
                    </div>
                </div> 
            </div>
        </div>
    </div>


    <div class="container">
        <div class="sixteen columns">
            <div class="box pd-10 mh-100">
                <div class="paginacion">
                    <?php if($cantidaBlog != 0 && $cantidaBlog >8){ ?>
                        <div class="pagination"><?php $cat->Show_Pagination($url,'page','paginacion'); ?></div>
                    <?php } ?>
                </div>
            </div> 
        </div>
    </div>
    
    <?php include(PREFIJO.'footer.php'); ?>
    </body>
</html>
