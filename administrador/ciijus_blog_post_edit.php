<?php
	if(isset($_POST['eliminar-foto']) && $_POST['eliminar-foto'] != ""){
		$portada = devolverValorQuery("SELECT portada FROM ".DB_PREFIJO."post WHERE id".DB_PREFIJO."post=".$_GET['id']." ");
		if($portada['portada'] != ""){
    		unlink("../".$portada['portada']);
		}
		$borrarEntrada = "UPDATE ".DB_PREFIJO."post SET portada = '' WHERE id".DB_PREFIJO."post= ".$_GET['id']."";
		mysqli_query($conexion,$borrarEntrada) or die(mysqli_error());
		$curpage = curPageURL();
		header("Location:".$curpage);
	}

	if(isset($_POST['titulo']) && $_POST['titulo'] != ""){
		$fecha = date('Y-m-d H:i:s');

		if($_FILES['imagen']['name'] != null){
			$anio = date('Y');
			$mes = date('m');

			require_once('image_resize.php');
			$dir = "img/media/".$anio."/".$mes."/";
			$max_file = 3;
			$upload_dir = "../img/media/".$anio."/".$mes."/";
			$allowed_image_types = array('image/jpeg'=>"jpeg",'image/jpeg'=>"jpg",'image/jpg'=>"jpg",'image/png'=>"png",'image/gif'=>"gif",'image/svg+xml'=>"svg");
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
				$image_normal = $upload_dir."imagen_".$random.".".$file_ext;

				if($userfile_type == 'image/svg+xml' || $userfile_type == 'image/gif'){
					move_uploaded_file($userfile_tmp, $image_normal);
				}else{
					move_uploaded_file($userfile_tmp, $original_location);

					$normal = new thumb();
					$normal->loadImage($original_location);
					$normal->resize(780, "width");
					$normal->save($image_normal, 90);
					
					unlink($original_location);
				}

				$portada = devolverValorQuery("SELECT portada FROM ".DB_PREFIJO."post WHERE id".DB_PREFIJO."post=".$_GET['id']." ");
				if($portada['portada'] != "" && $portada['portada'] != "img/no-picture.jpg"){
		    		unlink("../".$portada['portada']);
				}
		
				$ruta_image_normal = $dir."imagen_".$random.".".$file_ext;

				$fotografia = "portada='".$ruta_image_normal."', ";

			}else{
				$fotografia = "";
			}
		}else{
			$fotografia = "";
		}
		if (isset($_POST['guardarBorrador'])) {
			$status=0;
		}else{$status=1;}


		$editarRegistro = "UPDATE ".DB_PREFIJO."post SET $fotografia id".DB_PREFIJO."post_categoria=".$_POST['categoria'].",titulo='".utf8_decode(addslashes($_POST['titulo']))."',introduccion='".utf8_decode(addslashes($_POST['introduccion']))."',descripcion='".utf8_decode(addslashes($_POST['descripcion']))."', status=".$status." WHERE id".DB_PREFIJO."post=".$_GET['id']." ";
		//echo $editarRegistro; exit();
		mysqli_query($conexion,$editarRegistro) or die(mysqli_error());

		$success = "<i class='fa-icon-check-circle'></i> El registro ha sido guardado con éxito";

	}

	$categoria = "SELECT * FROM ".DB_PREFIJO."post_categoria";
	$resCategoria = mysqli_query($conexion,$categoria);

	$consulta = devolverValorQuery("SELECT * FROM ".DB_PREFIJO."post WHERE id".DB_PREFIJO."post=".$_GET['id']." ");

?>
<!DOCTYPE HTML>
<html lang="es-MX">

<head>
	<meta charset="UTF-8">
	<title>Publicación	 - <?php echo PROYECTO; ?></title>
	<!-- Metas  Especificas para  mobiles -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- CSS -->
	<link rel="stylesheet" href="<?php echo ADMINURL; ?>css/base.css">
	<link rel="stylesheet" href="<?php echo ADMINURL; ?>css/skeleton.css">
	<link rel="stylesheet" href="<?php echo ADMINURL; ?>css/layout.css">
	<link rel="stylesheet" href="<?php echo ADMINURL; ?>css/fonts/custom/style.css">
	<link rel="stylesheet" href="<?php echo ADMINURL; ?>js/datetime/datetimepicker.css">
	<link rel="stylesheet" href="<?php echo ADMINURL; ?>js/froala/css/froala_editor.pkgd.min.css">
	<link rel="stylesheet" href="<?php echo ADMINURL; ?>js/froala/css/froala_style.min.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

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
						<h4>Editar Publicacion</h4>
					</div>
			        <div class="form-add">
			        	<form name="form1" action="" method="post" enctype="multipart/form-data">
			        		<label for="marca">CATEGORIA <span>*</span></label>
			        		<select name="categoria" id="marca" required>
								<option value="<?php echo $consulta['id'.DB_PREFIJO.'post_categoria']; ?>"><?php echo utf8_encode(mostrarNombre($consulta['id'.DB_PREFIJO.'post_categoria'],"post_categoria","titulo")); ?></option>
								<?php while($rowCategoria = mysqli_fetch_array($resCategoria)){ ?>
									<option value="<?php echo $rowCategoria['id'.DB_PREFIJO.'post_categoria']; ?>"><?php echo utf8_encode($rowCategoria['titulo']); ?></option>
								<?php } ?>
							</select>
			        		<label for="foto">Portada</label>
			        		<div class="mintext">Si no seleccionas otra imagen se conserva la imagen anterior</div>
			    			<input type="file" name="imagen">
			        		<label for="titulo">Titulo <span>*</span></label>
			        		<input type="text" name="titulo" placeholder="Nombre del servicio" value="<?php echo utf8_encode($consulta['titulo']); ?>" required>
			        		<label for="condicion">Introducción</label>
			        		<input type="text" name="introduccion" placeholder="Máx 200 caractéres" value="<?php echo utf8_encode($consulta['introduccion']); ?>" maxlength="200" required>
			        		<label for="descripcion">Descripcion</label>
			        		<textarea  name="descripcion" id="editor" placeholder="Descripción"><?php echo utf8_encode($consulta['descripcion']); ?></textarea>
			    			<label for="requerido" class="req"><span>*</span> campos requeridos</label>
			        		<input type="submit" name="editar" value="Publicar"> ó
			        		<input type="submit" name="guardarBorrador" value="Guardar Borrador">
			        	</form>
			        </div>
			    </div>
	    	</div>
	    	<div class="six columns">
				<div class="list-items">
					<div class="form-add">
						<div class="foto-perfil">
						<label for="portada">Foto de perfil</label>
		        		<?php if($consulta['portada'] != ""){ ?>
	        				<div class="foto" style="background:url(<?php echo URL.$consulta['portada']; ?>)"></div>
	        				<div class="eliminar-foto">
		        				<form name="form2" action="" method="post">
		        					<input type="submit" class="delete" name="eliminar-foto" value="Eliminar Fotografía" class="confirm" title="¿Está seguro de borrar la fotografía?">
		        				</form>
		        			</div>
		        		<?php } ?>
		        		</div>
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
		$(function() { 
			$('textarea').froalaEditor() 
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