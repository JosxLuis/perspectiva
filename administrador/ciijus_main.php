<?php 

	$fechaActual = date('Y-m-d');
	$mesActual = date('m');
	$anioActual = date('Y');

	$d = new DateTime($fechaActual, new DateTimeZone('UTC')); 
	$d->modify('first day of previous month');
	$year = $d->format('Y'); //2012
	$month = $d->format('m'); //12

	
	$cantidadCategorias = cantidadRegistros("SELECT * FROM ".DB_PREFIJO."post_categoria");
	$categorias = "SELECT * FROM ".DB_PREFIJO."post_categoria";
	$resCategorias = mysqli_query($conexion, $categorias);

	$get_param='page';
	    
	 //get current page from url  
	 $current_page=(isset($_GET[$get_param]) &&
	 is_numeric($_GET[$get_param]))?$_GET[$get_param]:1;
	  //notice: when get param , you should SAFE it

	$url = URL."blog/";

	$cantidaBlog = cantidadRegistros("SELECT * FROM ".DB_PREFIJO."post");

	$cat=new pagination($cantidaBlog,3,$current_page,3 /*number of button*/);
	if($cantidaBlog != 0){
		$blog = "SELECT * FROM ".DB_PREFIJO."post ORDER BY id".DB_PREFIJO."post DESC LIMIT $cat->Start,$cat->End";
		$resBlog = mysqli_query($conexion,$blog);	
	}

	$categorias = "SELECT * FROM ".DB_PREFIJO."post_categoria";
    $resCategoria = mysqli_query($conexion,$categorias);

	$cantidaOferta = cantidadRegistros("SELECT * FROM ".DB_PREFIJO."oferta");

	$cat=new pagination($cantidaBlog,3,$current_page,3 /*number of button*/);
	if($cantidaOferta != 0){
		$oferta = "SELECT * FROM ".DB_PREFIJO."oferta ORDER BY id".DB_PREFIJO."oferta DESC LIMIT $cat->Start,$cat->End";
		$resOferta = mysqli_query($conexion,$oferta);	
	}

?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Administrador - <?php echo PROYECTO; ?></title>
	<!-- Metas  Especificas para  mobiles -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- CSS -->
	<link rel="stylesheet" href="<?php echo ADMINURL; ?>css/base.css">
	<link rel="stylesheet" href="<?php echo ADMINURL; ?>css/skeleton.css">
	<link rel="stylesheet" href="<?php echo ADMINURL; ?>css/layout.css">
	<link rel="stylesheet" href="<?php echo ADMINURL; ?>css/fonts/custom/style.css">
 	<!-- Favicons -->
    <link rel="shortcut icon" href="<?php echo URL; ?>img/favicon.png">
    <link rel="apple-touch-icon" href="<?php echo URL; ?>img/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo URL; ?>img/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo URL; ?>img/apple-touch-icon-114x114.png">
    
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var piedata = google.visualization.arrayToDataTable([
          ['Task', 'Categorias'],
        	<?php 
        		while($rowCategoria = mysqli_fetch_array($resCategorias)){
        			$cantidadPublicaciones = cantidadRegistros("SELECT * FROM ".DB_PREFIJO."post WHERE id".DB_PREFIJO."post_categoria=".$rowCategoria['id'.DB_PREFIJO.'post_categoria']." ");
				echo "['".utf8_encode($rowCategoria['titulo'])."',".$cantidadPublicaciones."],";
				}
			?>
        ]);

        var piechart_options = {
          title: 'Total de categorias <?php echo $cantidadCategorias;?>',legend: 'none'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(piedata, piechart_options);

      }
    </script>
</head>
<body>
<div class="blog">
	<div class="dashboard">
		<?php require_once(PREFIJO.'menu.php'); ?>
		<div class="container">
			<div class="eight columns">
				<div class="tablero">
					<div class="estadistica">
						<?php if($_SESSION[PREFIJO.'tipo'] == 1){ ?>
							<div class="add-button"><a href="<?php echo ADMINURL; ?>content/oferta<?php echo $_GET['do']; ?>/nuevo"> Nuevo</a></div>
						<?php } ?>
						<div class="titulo">
							<h4>Oferta</h4>
							<p>Ofertas actuales</p>
						</div>
						<div class="noticias">
							<?php if($cantidaOferta != 0){
								while($rowOferta = mysqli_fetch_array($resOferta)){
									$tituloURL = limpiar_cadena(utf8_encode($rowOferta['titulo']));
							?>			
							<div class="noticia">
								<div class="imagen">
									<a href="<?php echo URL; ?>oferta/<?php echo $rowOferta['id'.DB_PREFIJO.'oferta']; ?>/<?php echo $tituloURL; ?>/" class="img mh-400 maut" style="background: url(<?php echo URL.$rowOferta['portada']; ?>);"></a>
								</div>
								<div class="box pd-all-3">
									<div class="intro">
										<a href="<?php echo URL; ?>oferta/<?php echo $rowOferta['id'.DB_PREFIJO.'oferta']; ?>/<?php echo $tituloURL; ?>/"><h2><?php echo utf8_encode($rowOferta['titulo']); ?></h2></a>
									</div>
								</div>
							</div>
							<?php 
								} 
							}else{ ?>
								No hay Registros
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<div class="eight columns">
				<div class="tablero">
					<div class="estadistica">
						<div class="titulo">
							<h4>Categorias</h4>
							<p>Categorias de las noticias</p>
						</div>
						<div class="cotizaciones">
							<div id="piechart" style="width:100%; height:300px;"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="row"></div>
			<div class="eight columns">
				<div class="tablero">
					<div class="estadistica">
						<?php if($_SESSION[PREFIJO.'tipo'] == 1){ ?>
							<div class="add-button"><a href="<?php echo ADMINURL; ?>content/blog<?php echo $_GET['do']; ?>/nuevo"> Nuevo</a></div>
						<?php } ?>
						<div class="titulo">
							<h4>Blog</h4>
							<p>Noticas actuales del blog</p>
						</div>
						<div class="noticias">
							<?php if($cantidaBlog != 0){
								while($rowBlog = mysqli_fetch_array($resBlog)){
									$tituloURL = limpiar_cadena(utf8_encode($rowBlog['titulo']));	
							?>		
							<div class="noticia">
								<div class="imagen">
									<a href="<?php echo URL; ?>tema/<?php echo $rowBlog['id'.DB_PREFIJO.'post']; ?>/<?php echo $tituloURL; ?>/" class="img mh-400 maut" style="background: url(<?php echo URL.$rowBlog['portada']; ?>);"></a>
								</div>
								<div class="box pd-all-3">
									<div class="intro">
										<a href="<?php echo URL; ?>tema/<?php echo $rowBlog['id'.DB_PREFIJO.'post']; ?>/<?php echo $tituloURL; ?>/"><h2><?php echo utf8_encode($rowBlog['titulo']); ?></h2></a>
									</div>
								</div>
							</div>
							<?php 
								} 
							}else{ ?>
								No hay Registros
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<div class="eight columns">
				<div class="tablero">
					<div class="estadistica">
						<div class="titulo">
							<h4>.</h4>
							<p>.</p>
						</div>
						<div id="barchart" style="width:100%; height:300px;"></div>
					</div>
				</div>
			</div>
		</div>
		<?php require_once(PREFIJO.'footer.php'); ?>
	</div>
</div>		
	
	<script type="text/javascript" src="<?php echo ADMINURL; ?>js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo ADMINURL; ?>js/default.js"></script>
</body>
</html>