<?php  	
    $categorias = "SELECT * FROM ".DB_PREFIJO."post_categoria";
	$resultadocategorias= mysqli_query($conexion,$categorias);
	
	$cantidadSiteMapActividadCategoria = cantidadRegistros("SELECT * FROM ".DB_PREFIJO."oferta_categoria");
    if($cantidadSiteMapActividadCategoria != 0){
        $siteMapActividadeCategorias = "SELECT * FROM ".DB_PREFIJO."oferta_categoria ORDER BY id".DB_PREFIJO."oferta_categoria";
        $resSiteMapActividadeCategorias = mysqli_query($conexion,$siteMapActividadeCategorias) or die(mysqli_error());
    }
?>
<!DOCTYPE html>
<html lang="es-MX">
<head>
	<title>Mapa de sitio - <?php echo PROYECTO; ?></title>
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
                    <h3 class="lt-bold col-third">Mapa de sitio</h3>
                </div>
            </div>
        </div>
    </div>

	<div class="section sec-white">
        <div class="container">
            <div class="navegacion">
                <ul>
                    <li><a href="<?php echo URL; ?>">Inicio</a></li>
                    <li class="separador">/</li>
                    <li>Mapa de sitio</li>
                </ul>
                <div class="clear"></div>
            </div>
        </div>
    </div>


	<div class="section sec-white pd-30">
		<div class="container">
			<div class="eight columns">
				
				<ul class="accordion">
					<li>
						<a href="<?php echo URL?>" class="">
							<span>+</span> Inicio
						</a>
					</li>
					<li>
						<a href="<?php echo URL?>acerca/" class="">
							<span>+</span> Misión, Visión y Valores
						</a>
					</li>
					<li>
						<a href="<?php echo URL?>director/" class="">
							<span>+</span> Nuestro Director
						</a>
					</li>
					<li>
						<a href="<?php echo URL?>miembros-honorarios/" class="">
							<span>+</span> Miembros Honorarios
						</a>
					</li>
					<li>
						<a href="<?php echo URL?>acuerdos-de-colaboracion/" class="">
							<span>+</span> Acuerdos de Colaboración
						</a>
					</li>
					<li>
						<a href="javascript:;" class="desplegar">
							<span>+</span> Oferta Académica
						</a>
						<div class="contenido">
							<?php if($cantidadSiteMapActividadCategoria != 0){ ?>
								<?php while($rowSiteMapActividadCategoria = mysqli_fetch_array($resSiteMapActividadeCategorias)){
									$tituloSiteMapActividadCategoria = limpiar_cadena(utf8_encode($rowSiteMapActividadCategoria['titulo']));
								?>
								<a href="<?php echo URL; ?>oferta-academica/categoria/<?php echo $rowSiteMapActividadCategoria['id'.DB_PREFIJO.'oferta_categoria']; ?>/<?php echo $tituloSiteMapActividadCategoria; ?>/"><?php echo utf8_encode($rowSiteMapActividadCategoria['titulo']); ?></a>
								<?php } ?>
							
							<?php 
								} 
							?>
						</div>
					</li>
				</ul>

			</div>
			<div class="eight columns">
				<ul class="accordion">
					<li>
						<a href="<?php echo URL?>libreria/" class="">
							<span>+</span> Librería
						</a>
					</li>
					<li>
						<a href="javascript:;" class="desplegar">
							<span>+</span> Blog
						</a>
						<div class="contenido">
							<a href="">Todo</a>
						</div>
					</li>
					<li>
						<a href="http://plataformavirtual.ciijus.org" target="_blank" class="">
							<span>+</span> Plataforma Virtual
						</a>
					</li>
					<li>
						<a href="<?php echo URL?>colloquium/" class="">
							<span>+</span> Colloquium
						</a>
					</li>
					<li>
						<a href="<?php echo URL?>contacto/" class="">
							<span>+</span> Contacto
						</a>
					</li>
					<li>
						<a href="<?php echo URL?>privacidad/" class="">
							<span>+</span> Aviso de privacidad
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
<?php include(PREFIJO.'footer.php'); ?>	
<script>
	$(document).ready(function(){
		$(".desplegar").click(function(){
			//var ruta = $(this).parent("li").children(".contenido");
			var ruta = $(this).parent("li a span");
			console.log(ruta);
			//$(this).find(".contenido").toggle();
			$(this).parent("li").children(".contenido").toggle();
			$(this).parent("li").children(".desplegar").children("span").toggleClass("angulo");
			
		});
	});
</script>
</body>
</html>