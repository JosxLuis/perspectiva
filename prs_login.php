<?php
if(isset($_SESSION[PREFIJO.'iduser']) && $_SESSION[PREFIJO.'iduser'] != "" ){
 header("Location:".URL."perfil/");
 exit();   
}

if(isset($_POST['usuario']))
{
    //print_r($_POST);
    $password=trim($_POST['token']);
    $consulta = devolverValorQuery("SELECT id".DB_PREFIJO."usuario,username,token FROM ".DB_PREFIJO."usuario WHERE (username='".$_POST['usuario']."' OR email='".$_POST['usuario']."')");
    if(password_verify($password,$consulta['token']))
    {
        @session_start();
        $_SESSION[PREFIJO.'iduser'] = $consulta['id'.DB_PREFIJO.'usuario'];
        $_SESSION[PREFIJO.'frontuser'] = $consulta['username'];
        header("Location:".URL."perfil/");
        exit();
    }
    else
    {
        //$md5 = md5($password);
        $error = "<i class='fa-icon-check-circle'></i> Usuario o contraseña incorrecta";
        //header("Location: index.php?error_login=true");
    }
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
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
<div class="login">
    <div class="content">
        <h4 class="tx-cen lt-bold">Iniciar Sesión</h4>
        <form name="login" method="post" action="">
            <?php if(isset($error) && $error != ""){ ?>
                <div class="alert alert-error">
                    <i class="fa fa-times-circle"></i> <?php echo $error; ?>
                </div>
            <?php } ?>
            <input type="text" name="usuario" placeholder="Usuario o Correo:" required autofocus />
            <input type="password" name="token" placeholder="Contraseña:" required />
            <input type="submit" name="entrar" value="Ingresar" />
            <br /><br>
            <div class="tx-cen">
                <span class="txt1">
                    ¿Has olvidado tu contraseña?
                </span>
                <a href="<?php echo URL; ?>recuperar/" class="txt2 hov1">
                    Recuperar mi contraseña
                </a>
            </div>
            <div class="tx-cen">
                <span class="txt1">
                    ¿No tienes una cuenta?
                </span>
                <a href="<?php echo URL; ?>registro/" class="txt2 hov1">
                    Crear mi cuenta.
                </a>
            </div>
        </form>
    </div>
</div>
</div>
<?php include(PREFIJO.'footer.php'); ?>
</body>
</html>