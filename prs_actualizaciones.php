<!DOCTYPE html>
<html lang="es-MX">
<head>
	<title>Actualizaciones - <?php echo PROYECTO; ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
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
                    <h3 class="lt-bold col-third">Actualizaciones</h3>
                </div>
            </div>
        </div>
    </div>


	<div class="versiones section pd-50">
		<div class="container">
			<div class="row"></div>
			<div class="row"></div>
			<div class="sixteen columns">
				<h3 class="lt-bold">Actualizaciones</h3>
				<div class="descripcion">
					<p class="lt-reg">Historial de versiones y actualizaciones de la plataforma web de <?php echo PROYECTO; ?></p>
				</div>	
				<div class="box">
					<ul class="list-ver">
	        			<li>
	        				<h5>Version 1.0.1</h5>
							<small> 25/04/2018</small>
							<p>Se corrigen errores mínimos en el diseño y se agregan nuevas secciones al sitio web</p>
							<ul>
								<li>Errores de estilo que afectaban la visualización en móviles</li>
								<li>Se agrega página de términos</li>
								<li>Se agrega aviso de privacidad</li>
							</ul>
						</li>
					</ul>
					<ul class="list-ver">
	        			<li>
	        				<h5>Version 1.0</h5>
							<small> 10/04/2018</small>
							<p>Se libera el sitio con las funciones principales</p>
							<ul>
								<li>Página principal</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

<?php include(PREFIJO."footer.php"); ?>
</body>
</html>