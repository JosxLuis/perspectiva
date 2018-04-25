<?php
    //param of url to specify page_number
   
     $get_param='page';
        
     //get current page from url  
     $current_page=(isset($_GET[$get_param]) &&
     is_numeric($_GET[$get_param]))?$_GET[$get_param]:1;
      //notice: when get param , you should SAFE it

    $url = URL."miembros-honorarios/";

    $cantidaMiembro = cantidadRegistros("SELECT * FROM ".DB_PREFIJO."miembro");

    $cat=new pagination($cantidaMiembro,8,$current_page,5 /*number of button*/);
    if($cantidaMiembro != 0){
        $miembro = "SELECT * FROM ".DB_PREFIJO."miembro ORDER BY id".DB_PREFIJO."miembro DESC LIMIT $cat->Start,$cat->End";
        $resMiembro = mysqli_query($conexion,$miembro); 
    }
?>
<!DOCTYPE HTML>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Miembros honorarios - <?php echo PROYECTO; ?></title>
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
                    <h3 class="lt-bold col-third">Miembros Honorarios</h3>
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
                    <li>Miembros Honorarios</li>
                </ul>
                <div class="clear"></div>
            </div>
        </div>
    </div>

    <div class="section equipo">
        <div class="container">
            <div class="historia">
                <h3 class="tx-cen">Miembros Honorarios </h3>
                <?php if($cantidaMiembro != 0){
                        while($rowMiembro = mysqli_fetch_array($resMiembro)){
                            $tituloURL = limpiar_cadena(utf8_encode($rowMiembro['nombre']));
                    ?> 
                <div class="four columns">
                    <div class="integrante">
                        <div class="foto">
                            <a href="#" style="background: url(<?php echo URL.$rowMiembro['portada']; ?>);"></a>
                        </div>
                        <div class="box">
                            <div class="info">
                                <h5><?php echo utf8_encode($rowMiembro['nombre']); ?></h5>
                                <span><?php echo utf8_encode($rowMiembro['puesto']); ?></span>
                                <p><?php echo utf8_encode($rowMiembro['origen']); ?></p>
                            </div>
                        </div>    
                    </div>
                </div>    
                <?php 
                    } 
                }else{ ?>
                    <div class="tx-cen no-registro">No hay Registros</div>
                <?php } ?>

                <div class="container">
                    <div class="sixteen columns">
                        <div class="box pd-10 mh-100">
                            <div class="paginacion">
                                <?php if($cantidaMiembro != 0 && $cantidaMiembro >8){ ?>
                                    <div class="pagination"><?php $cat->Show_Pagination($url,'page','paginacion'); ?></div>
                                <?php } ?>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>     
        </div>
    </div> 
    <?php include(PREFIJO.'footer.php'); ?>
    </body>
</html>
