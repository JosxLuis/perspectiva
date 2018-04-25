<?php
	
	if(isset($_POST['editar'])!= ""){

		$editarRegistro = "UPDATE ".DB_PREFIJO."versiones SET version='".utf8_decode($_POST['version'])."',introduccion='".utf8_decode($_POST['introduccion'])."',descripcion='".utf8_decode($_POST['descripcion'])."' WHERE id".DB_PREFIJO."versiones=".$_GET['id']." ";
		//echo $editarRegistro; exit();
		mysqli_query($conexion,$editarRegistro) or die(mysql_error());
		$success = "<i class='fa-icon-check-circle'></i> El registro ha sido guardado con éxito";
	
	}

	$consulta = devolverValorQuery("SELECT *,date_format(fecha,'%Y-%m-%d') as fecha FROM ".DB_PREFIJO."versiones WHERE id".DB_PREFIJO."versiones=".$_GET['id']." ");
		
?>
<!DOCTYPE HTML>
<html lang="es-MX">

<head>
	<meta charset="UTF-8">
	<title>Versiones - <?php echo PROYECTO; ?></title>
	<!-- Metas  Especificas para  mobiles -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- CSS -->
	<link rel="stylesheet" href="<?php echo ADMINURL; ?>css/base.css">
	<link rel="stylesheet" href="<?php echo ADMINURL; ?>css/skeleton.css">
	<link rel="stylesheet" href="<?php echo ADMINURL; ?>css/layout.css">
	<link rel="stylesheet" href="<?php echo ADMINURL; ?>css/fonts/custom/style.css">
	<link rel="stylesheet" href="<?php echo ADMINURL; ?>js/datetime/datetimepicker.css">

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
 <!-- Favicons -->
    <link rel="shortcut icon" href="<?php echo URL; ?>img/favicon.png">
    <link rel="apple-touch-icon" href="<?php echo URL; ?>img/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo URL; ?>img/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo URL; ?>img/apple-touch-icon-114x114.png">
</head>
<body>
	<div class="dashboard">
		<?php require_once(PREFIJO.'menu.php'); ?>
		<div class="container">
			<div class="sixteen columns">
			<?php if (isset($error) && $error != null) { ?>
				<div class="alert alert-danger"><?php echo $error; ?></div>
			<?php } ?>
			<?php if (isset($success)){ ?>
				<div class="alert alert-success"><?php echo $success; ?></div>
			<?php } ?>
			</div>
			<div class="ten columns">
				<div class="list-items">
					<div class="titulo">
						<h4>Editar Versiones</h4>
					</div>
			        <div class="form-add">
			        	<form name="form1" action="" method="post" enctype="multipart/form-data">
			    			<label for="clave">Version <span>*</span></label>
			        		<input type="text" name="version" value="<?php echo utf8_encode($consulta['version']); ?>" required>
			        		<label for="condicion">Introducción</label>
			        		<input type="text" name="introduccion" placeholder="Máx 200 caractéres" value="<?php echo utf8_encode($consulta['introduccion']); ?>" maxlength="200"  required>
			        		<label for="descripcion">Descripcion</label>
			        		<textarea  name="descripcion" id="editor" placeholder="Descripción"><?php echo utf8_encode($consulta['descripcion']); ?></textarea>
			        		<label for="condicion">fecha</label>
			        		<input type="text" name="fecha" value="<?php echo utf8_encode($consulta['fecha']); ?>"  required class="default_datetimepicker" readonly="readonly">
			    			<label for="requerido" class="req"><span>*</span> campos requeridos</label>
			        		<input type="submit" name="editar" value="Guardar">
			        	</form>
			        </div>
			    </div>
	    	</div>
	</div>
	<?php require_once(PREFIJO.'footer.php'); ?>
	<script type="text/javascript" src="<?php echo ADMINURL; ?>js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo ADMINURL; ?>js/default.js"></script>
	<script type="text/javascript" src="<?php echo ADMINURL; ?>js/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="<?php echo ADMINURL; ?>js/datetime/datetimepicker.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function() {

			//$('.editor').jqte();
		 	CKEDITOR.replace( 'editor' );

			$('.default_datetimepicker').datetimepicker({
				timepicker:false,
				format: 'Y-m-d',
				lang:'es',
				scrollInput:false
		 });

		$("#marca").change(function(){
	        if (this.value != "") {
	            $.ajax({
	                type: "POST",
	                url: "<?php echo ADMINURL;?>buscar-categoria/",
	                //url: "http://www.ampacet.mx/buscar-ciudad/",
	                data: {
	                    'search_marca' : this.value
	                },
	                dataType: "html",
	                success: function(html){
	                    $("#categoria").html(html);
	                }
	            });
	            /*$("#subcategoria").removeAttr("disabled");
	            $("#subcategoria").attr("required","required");*/
	        }else{
	        	/*$("#subcategoria").removeAttr("required");
	            $("#subcategoria").attr("disabled","disabled");*/
	        }
    	});

		$("#categoria").change(function(){
	        if (this.value != "") {
	            $.ajax({
	                type: "POST",
	                url: "<?php echo ADMINURL;?>buscar-subcategoria/",
	                //url: "http://www.ampacet.mx/buscar-ciudad/",
	                data: {
	                    'search_categoria' : this.value
	                },
	                dataType: "html",
	                success: function(html){
	                    $("#subcategoria").html(html);
	                }
	            });
	            /*$("#subcategoria").removeAttr("disabled");
	            $("#subcategoria").attr("required","required");*/
	        }else{
	        	/*$("#subcategoria").removeAttr("required");
	            $("#subcategoria").attr("disabled","disabled");*/
	        }
    	});
		
	});
	</script>
</body>
</html>