<?php

    if(!isset($_SESSION[PREFIJO.'iduser']) && $_SESSION[PREFIJO.'iduser'] == "" ){
        header("Location:".URL."login/");
        exit();   
    }

   
    $perfilUsuario = devolverValorQuery("SELECT * FROM ".DB_PREFIJO."usuario WHERE id".DB_PREFIJO."usuario=".$_SESSION[PREFIJO.'iduser']." ");

    if(isset($_POST['eliminar-foto']) && $_POST['eliminar-foto'] != ""){
        $portada = devolverValorQuery("SELECT avatar FROM ".DB_PREFIJO."usuario WHERE id".DB_PREFIJO."usuario=".$_SESSION[PREFIJO.'iduser']."");
        if($portada['avatar'] != ""){
            unlink("../".$portada['avatar']);
        }
        $borrarEntrada = "UPDATE ".DB_PREFIJO."usuario SET avatar = '' WHERE id".DB_PREFIJO."usuario=".$_SESSION[PREFIJO.'iduser']."";
        mysqli_query($conexion,$borrarEntrada) or die(mysql_error());
        $curpage = curPageURL();
        header("Location:".$curpage);
    }

    if(isset($_POST['cambiar-contrasena']) && $_POST['cambiar-contrasena'] != ""){
        $password = trim($_POST['token']);

        $cambiarContrasena = "UPDATE ".DB_PREFIJO."usuario SET token = '".password_hash($password, PASSWORD_DEFAULT)."' WHERE id".DB_PREFIJO."usuario=".$_SESSION[PREFIJO.'iduser']."";
        //echo $cambiarContrasena; exit();
        mysqli_query($conexion,$cambiarContrasena) or die(mysql_error());
        
        $success = "<i class='fa-icon-check-circle'></i> La contraseña se ha cambiado con éxito";
    }

    if(isset($_POST['editar']) && $_POST['name'] != ""){
        $portada = "";
        $fecha = date('Y-m-d H:i:s');

        if($_FILES['imagen']['name'] != null){
            require_once('lib/image_resize.php');

            $anio = date('Y');
            $mes = date('m');
            

            $dir = "img/media/".$anio."/".$mes."/";
            $max_file = 3;
            $upload_dir = "img/media/".$anio."/".$mes."/";
            $allowed_image_types = array('image/jpeg'=>"jpg",'image/jpeg'=>"jpg",'image/jpg'=>"jpg",'image/png'=>"png",'image/svg+xml'=>"svg");
            $allowed_image_ext = array_unique($allowed_image_types); 
            $image_ext = "";

            foreach ($allowed_image_ext as $mime_type => $ext) {
                $image_ext.= strtoupper($ext)." ";
            }

            $random = strtotime(date('Y-m-d H:i:s'));
            $userfile_name = $_FILES['imagen']['name'];
            $userfile_tmp = $_FILES['imagen']['tmp_name'];
            $userfile_size = $_FILES['imagen']['size'];
            $userfile_type = $_FILES['imagen']['type'];
            $filename = basename($_FILES['imagen']['name']);
            $file_ext = strtolower(substr($filename, strrpos($filename, '.') + 1));

            $original_location = $upload_dir."".$filename;


            //Solo precedemos si las imagenes son JPG, PNG, GIF y que no exedan el peso limite
            if((!empty($_FILES["imagen"]['name'])) && ($_FILES['imagen']['error'] == 0)) {
                foreach ($allowed_image_types as $mime_type => $ext) {
                    //se hace un bucle atraves de los tipos de imagen especificados y se verifica si coincide con la extension despues de eso termina
                    if($file_ext==$ext && $userfile_type==$mime_type){
                        $error = "";
                        break;
                    }else{
                        $error = "Solo se admiten imagenes con formato <strong>".$image_ext."</strong> <br />";
                    }
                }
                //verifica que la imagen sea menor al tamaño especificado
                if ($userfile_size > ($max_file*1048576)) {
                    $error.= "Las imagenes deben pesar menos de ".$max_file."MB";
                }
                
            }else{
                $error= "Seleccione una imagen para subir";
            }

            //Todo esta bien ahora si podemos subir la imagen.
            if (strlen($error)==0){         
                
                if($userfile_type != 'image/svg+xml'){              
                    move_uploaded_file($userfile_tmp, $original_location);

                    $image_normal = $upload_dir."imagen_".$random.".".$file_ext;
                    
                    $normal = new thumb();
                    $normal->loadImage($original_location);
                    $normal->resize(600, "width");
                    $normal->save($image_normal, 90);
                    
                    unlink($original_location);
                }else{
                    $image_normal = $upload_dir."imagen_".$random.".".$file_ext;
                    move_uploaded_file($userfile_tmp, $image_normal);
                }
                
                $nombreImagenActual = devolverValorQuery("SELECT avatar FROM ".DB_PREFIJO."usuario WHERE id".DB_PREFIJO."usuario=".$_SESSION[PREFIJO.'iduser']."");
                if($nombreImagenActual['avatar'] != ""){
                    unlink("../".$nombreImagenActual['avatar']);
                }
                
                $ruta_image_normal = $dir."imagen_".$random.".".$file_ext;

                $portada = "avatar ='".$ruta_image_normal."', ";

            }
                
        //fin condicion
        }

        $editarPublicacion = "UPDATE ".DB_PREFIJO."usuario SET $portada name='".utf8_decode($_POST['name'])."', lastname='".utf8_decode($_POST['lastname'])."', email='".utf8_decode($_POST['email'])."', phone='".utf8_decode($_POST['phone'])."' 
        WHERE id".DB_PREFIJO."usuario=".$_SESSION[PREFIJO.'iduser']."";
        //echo $editarPublicacion; exit();
        mysqli_query($conexion,$editarPublicacion) or die(mysql_error());

        $success = "<i class='fa-icon-check-circle'></i> El registro se ha guardado con éxito";

    }
   
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <title>Perfil - <?php echo PROYECTO; ?></title>
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
<div class="box relative">
<?php include(PREFIJO.'header.php'); ?>
    <div class="perfil">
        <div class="container">
            <div class="ten columns offset-by-one">
                <div class="box">
                    <div class="datos">
                        <form action="" method="post" enctype="multipart/form-data">
                            
                                <label for="label1">Nombre de usuario:</label>
                                <input type="text" name="username" class="" value="<?php if($perfilUsuario['username'] != ""){ echo utf8_encode($perfilUsuario['username']); } ?>"  placeholder="Nombre de Usuario" disabled="disabled" required >
                                
                                <label for="label1">Nombre:</label>
                                <input type="text" name="name" class="" value="<?php if($perfilUsuario['name'] != ""){ echo utf8_encode($perfilUsuario['name']); } ?>" placeholder="Nombre Completo" required" >
                                
                                <label for="label1">Apellidos:</label>
                                <input type="text" name="lastname" class="" value="<?php if($perfilUsuario['lastname'] != ""){ echo utf8_encode($perfilUsuario['lastname']); } ?>" placeholder="Apellidos Completo" required" >
                        
                                <label for="doble">Correo:</label>
                                <input type="text" name="email" class="" value="<?php if($perfilUsuario['email'] != ""){ echo utf8_encode($perfilUsuario['email']); } ?>" placeholder="Dirección de correo" required 
                                    pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" title="Escribe una dirección de correo Ej. micorreo@gmail.com" >
                                
                                <label for="doble">Teléfono:</label>
                                <input type="text" name="phone" class="" value="<?php if($perfilUsuario['phone'] != ""){ echo utf8_encode($perfilUsuario['phone']); } ?>"  placeholder="Número de diez dígitos" required>
                                
                                <input type="file" name="imagen" <?php if($perfilUsuario['avatar'] != ""){ ?> <?php }else{ ?> <?php } ?>><br>
                                <?php if($perfilUsuario['avatar'] != ""){ ?> <div class="mintext">Si no selecionas una nueva foto se conserva la anterior</div> <?php }else{ ?>  <?php } ?><br>
                                <input type="submit" name="editar" class="btn btn-big btn-red btn-inli" value="Guardar">
                        </form>
                    </div>
                </div>
            </div>
            <div class="four columns">
                <div class="usuario">
                    <div class="foto">
                        <?php if($perfilUsuario['avatar'] != ""){ ?>
                        <a href="javascript:;" style="background: url(<?php echo URL.$perfilUsuario['avatar']; ?>);"></a>
                        <?php } ?>
                    </div>
                    <h5><?php echo utf8_encode($perfilUsuario['name']); ?><br><?php echo utf8_encode($perfilUsuario['lastname']); ?></h5>
                    <span>@<?php echo $perfilUsuario['username']; ?></span>
                </div>
                <div class="usuariomenu">
                    <ul class="list-usuario">
                        <li><a href="#">Perfil <div class="cant"></div></a></li>
                        <li><a href="<?php echo URL; ?>trabajar/">Trabajar<div class="cant"></div></a></li>
                    </ul>
                </div>
                <div class="row"></div>
                <div class="list-items">
                    <div class="form-add">
                        <div class="cambiar-contra">
                            <label for="portada">Cambiar contraseña</label>
                            <form action="" method="post">
                                <input type="password" name="token" id="password" placeholder="Contraseña" required>
                                <input type="password" name="confirmatoken" id="confirm_password" placeholder="Confirmar Contraseña" required>
                                <input type="submit" class="btn btn-medium btn-gray btn-inli" name="cambiar-contrasena" value="Cambiar contraseña">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include(PREFIJO.'footer.php'); ?>
    <script>
        $(document).ready(function(){
            var password = document.getElementById("password"), confirm_password = document.getElementById("confirm_password");

            function validatePassword(){
              if(password.value != confirm_password.value) {
                confirm_password.setCustomValidity("Las contraseñas no cohinciden");
              } else {
                confirm_password.setCustomValidity('');
              }
            }

            password.onchange = validatePassword;
            confirm_password.onkeyup = validatePassword;
        });
    </script>

</body>
</html>