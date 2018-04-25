<?php
    if(isset($_POST['registrarme']) && $_POST['correo'] != ""){
        //echo "SELECT username,email FROM ".DB_PREFIJO."usuario WHERE username='".$_POST['usuario']."' OR email='".$_POST['correo']."' "; exit();
        $verificarUsuario = cantidadRegistros("SELECT username,email FROM ".DB_PREFIJO."usuario WHERE username='".$_POST['usuario']."' OR email='".$_POST['correo']."' ");
        if($verificarUsuario == 0){
            $fecha = date('Y-m-d H:i:s');
            $password = trim($_POST['token']);
            $insertarRegistro = "INSERT INTO ".DB_PREFIJO."usuario(id".DB_PREFIJO."usuario,username,token,email,created) VALUES (0,
            '".utf8_decode($_POST['usuario'])."','".password_hash($password, PASSWORD_DEFAULT)."','".utf8_decode($_POST['correo'])."','".$fecha."')";
            //echo $insertarRegistro; exit();
            mysqli_query($conexion,$insertarRegistro) or die(mysql_error());

            $success = "<i class='fa-icon-check-circle'></i> El usuario ha sido creado con éxito";
        }else{
            $error = "<i class='fa-icon-check-circle'></i> El usuario o el correo ya existen";
        }

    }
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registrarme</title>
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
<?php if(isset($_GET['error_login'])){ ?>
        <div class="alert alert-danger"><i class="icon-minus-circle"></i> Los datos son incorrectos</div>
<?php } ?>
<?php include(PREFIJO.'header.php'); ?>
<div class="login">
    <div class="content">
        <h4 class="tx-cen lt-bold">Crear mi cuenta</h4>
        <?php if(isset($success) && $success != ""){ ?>
            <div class="alert alert-success">
                <i class="fa fa-check-circle"></i> <?php echo $success; ?>
            </div>
        <?php } ?>
        <?php if(isset($error) && $error != ""){ ?>
            <div class="alert alert-error">
                <i class="fa fa-times-circle"></i> <?php echo $error; ?>
            </div>
        <?php } ?>
        <form name="login" method="post" action="">
            <input type="text" name="usuario" placeholder="Usuario" required autofocus />
            <input type="text" name="correo" placeholder="Correo Electrónico" required />
            <input type="password" name="token" id="password" placeholder="Contraseña:" required />
            <input type="password" name="confirmtoken" id="confirm_password" placeholder="Confirmar contraseña:" required />
            <input type="submit" name="registrarme" value="Crear mi cuenta" />
            <br /><br>
            <div class="tx-cen">
                <span class="txt1">
                    ¿Ya tienes una cuenta?
                </span>
                <a href="<?php echo URL; ?>login/" class="txt2 hov1">
                    Iniciar Sesión
                </a>
            </div>
        </form>
    </div>
</div>
</div>
<?php include(PREFIJO.'footer.php'); ?>
<script type="text/javascript" src="<?php echo ADMINURL; ?>js/jquery.js"></script>
<script type="text/javascript" src="<?php echo ADMINURL; ?>js/default.js"></script>
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