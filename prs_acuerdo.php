<?php
    //param of url to specify page_number
   
     $get_param='page';
        
     //get current page from url  
     $current_page=(isset($_GET[$get_param]) &&
     is_numeric($_GET[$get_param]))?$_GET[$get_param]:1;
      //notice: when get param , you should SAFE it

    $url = URL."acuerdo/";

    $cantidaAcuerdo = cantidadRegistros("SELECT * FROM ".DB_PREFIJO."acuerdo");

    $cat=new pagination($cantidaAcuerdo,8,$current_page,5 /*number of button*/);
    if($cantidaAcuerdo != 0){
        $acuerdo = "SELECT * FROM ".DB_PREFIJO."acuerdo ORDER BY id".DB_PREFIJO."acuerdo  DESC LIMIT $cat->Start,$cat->End";
        $resAcuerdo = mysqli_query($conexion,$acuerdo);   
    }

?>
<!DOCTYPE HTML>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acuerdos de colaboración - <?php echo PROYECTO; ?></title>
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
                    <h3 class="lt-bold col-third">Acuerdos de colaboración</h3>
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
                    <li>Acuerdos de colaboración</li>
                </ul>
                <div class="clear"></div>
            </div>
        </div>
    </div>

    <div class="section sitios">
        <div class="container">
            <div class="sitio">
                <h3 class="tx-cen">Acuerdos de colaboración</h3>
                <?php if($cantidaAcuerdo != 0){
                    while($rowAcuerdo = mysqli_fetch_array($resAcuerdo)){
                        $tituloURL = limpiar_cadena(utf8_encode($rowAcuerdo['titulo']));
                ?> 
                <div class="four columns">
                   <div class="enlace">
                        <div class="portada">
                            <a href="#" style="background: url(<?php echo URL.$rowAcuerdo['portada']; ?>);"></a>
                        </div>
                        <div class="box">
                            <div class="link">
                                <h5><?php echo utf8_encode($rowAcuerdo['titulo']); ?></h5>
                                <button class="btn btn-medium btn-blue-out btn-center">Ver más</button><br><br>
                            </div>
                        </div>    
                    </div>
                    
                </div>
                <?php 
                    } 
                }else{ ?>
                    <div class="tx-cen no-registro">No hay Registros</div>
                <?php } ?>
            </div>     
        </div>
    </div> 
    <?php include(PREFIJO.'footer.php'); ?>
    </body>
</html>
