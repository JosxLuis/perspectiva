<?php

if(isset($_POST['usuario']))
{
    //print_r($_POST);
    $password=trim($_POST['passwd']);
    $consulta = devolverValorQuery("SELECT id".DB_PREFIJO."usuario,usuario,passwd FROM ".DB_PREFIJO."usuario WHERE (usuario='".$_POST['usuario']."' OR correo='".$_POST['correo']."') and passwd='".md5($password)."'");
    if($consulta['usuario'] == true)
    {
        @session_start();
        $_SESSION[PREFIJO.'user'] = $consulta['usuario'];
        $_SESSION[PREFIJO.'idadmin'] = $consulta['id'.DB_PREFIJO.'usuario'];
        header("Location:".URL);
        exit();
    }
    else
    {
        //$md5 = md5($password);
        header("Location: index.php?error_login=true");
        exit();
    }
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <title>Recuperar mi contraseña</title>
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
        <h4 class="tx-cen lt-bold">Recuperar mi contraseña</h4>
        <p class="tx-cen">Para poder recuperar tu contraseña es necesario que ingreses la dirección de correo con 
        la que te has registrado en el portal.</p>
        <form name="login" method="post" action="">
            <input type="text" name="correo" placeholder="Correo:" required autofocus />
            <input type="text" name="confirmcorreo" placeholder="Confirmar correo:" required />
            <input type="submit" name="entrar" value="Recuperar mi contraseña" />
            <br /><br>
            <div class="tx-cen">
                <span class="txt1">
                    ¿No tienes una cuenta?
                </span>
                <a href="<?php echo URL; ?>registro/" class="txt2 hov1">
                    Crear mi cuenta
                </a>
            </div>
            <div class="tx-cen">
                <span class="txt1">
                    ¿Ya tienes una cuenta?
                </span>
                <a href="<?php echo URL; ?>login/" class="txt2 hov1">
                    Iniciar Sesión.
                </a>
            </div>
        </form>
    </div>
</div>
</div>
<?php include(PREFIJO.'footer.php'); ?>
</body>
</html>