<?php
	if(isset($_POST['insertar']) && $_POST['descripcion'] != ""){
		require_once('image_resize.php');
		$anio = date('Y');
		$mes = date('m');

		$fecha = date('Y-m-d H:i:s');


		$dir = "img/media/".$anio."/".$mes."/";
		$max_file = 3;
		$upload_dir = "../img/media/".$anio."/".$mes."/";
		$allowed_image_types = array('image/jpeg'=>"jpg",'image/jpeg'=>"jpg",'image/jpg'=>"jpg",'image/png'=>"png");
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
			
			move_uploaded_file($userfile_tmp, $original_location);
		
			$image_normal = $upload_dir."imagen_".$random.".".$file_ext;
			
			$normal = new thumb();
			$normal->loadImage($original_location);
			$normal->resize(500, "width");
			$normal->save($image_normal, 90);


			unlink($original_location);
			
			$ruta_image_normal = $dir."imagen_".$random.".".$file_ext;

			
			$guardarPublicacion = "INSERT INTO ".DB_PREFIJO."director(id".DB_PREFIJO."director,id".DB_PREFIJO."administrador,portada,titulo,descripcion,creado)
			VALUES(0,".$_SESSION[PREFIJO.'idadmin'].",'".$ruta_image_normal."','".utf8_decode(addslashes($_POST['titulo']))."','".utf8_decode(addslashes($_POST['descripcion']))."','".$fecha."') ";
			//echo $guardarPublicacion;exit();
			mysqli_query($conexion,$guardarPublicacion) or die(mysql_error());
			$success = "<i class='fa-icon-check-circle'></i> La publicación ha sido guardada con éxito";

				
		//fin condicion
		}

	}

	if(isset($_POST['editar']) && $_POST['descripcion'] != ""){
		$anio = date('Y');
		$mes = date('m');

		$fecha = date('Y-m-d H:i:s');
		require_once('image_resize.php');
		$dir = "img/media/".$anio."/".$mes."/";
		$max_file = 3;
		$upload_dir = "../img/media/".$anio."/".$mes."/";
		$allowed_image_types = array('image/jpeg'=>"jpg",'image/jpeg'=>"jpg",'image/jpg'=>"jpg",'image/png'=>"png");
		$allowed_image_ext = array_unique($allowed_image_types); 
		$image_ext = "";
		$fotografia = "";

		if($_FILES['imagen']['name'] != null){

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
				
				move_uploaded_file($userfile_tmp, $original_location);

				$image_normal = $upload_dir."imagen_".$random.".".$file_ext;

				$normal = new thumb();
				$normal->loadImage($original_location);
				$normal->resize(500, "width");
				$normal->save($image_normal, 90);
				
				unlink($original_location);

				$nombreImagenActual = devolverValorQuery("SELECT portada FROM ".DB_PREFIJO."director WHERE id".DB_PREFIJO."director=1");
				if($nombreImagenActual['portada'] != ""){
		    		unlink("../".$nombreImagenActual['portada']);
				}
		
				$ruta_image_normal = $dir."imagen_".$random.".".$file_ext;

				$fotografia = "portada='".$ruta_image_normal."', ";

			}

			
					
		//fin condicion
		}

		$editarPublicacion = "UPDATE ".DB_PREFIJO."director SET $fotografia titulo='".utf8_decode(addslashes($_POST['titulo']))."' , descripcion = '".utf8_decode(addslashes($_POST['descripcion']))."', editado='".$fecha."'  WHERE id".DB_PREFIJO."director=1";
		echo $editarPublicacion; exit();
		mysqli_query($conexion,$editarPublicacion) or die(mysql_error());

		$success = "<i class='fa-icon-check-circle'></i> El contenido ha sido guardada con éxito";
	}

	$consulta = devolverValorQuery("SELECT * FROM ".DB_PREFIJO."director WHERE id".DB_PREFIJO."director=1");
?>
<!DOCTYPE HTML>
<html lang="es-MX">
<head>
	<meta charset="UTF-8">
	<title>Director - <?php echo PROYECTO; ?></title>
	<!-- Metas  Especificas para  mobiles -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- CSS -->
	<link rel="stylesheet" href="<?php echo ADMINURL; ?>css/base.css">
	<link rel="stylesheet" href="<?php echo ADMINURL; ?>css/skeleton.css">
	<link rel="stylesheet" href="<?php echo ADMINURL; ?>css/layout.css">
	<link rel="stylesheet" href="<?php echo ADMINURL; ?>css/fonts/custom/style.css">

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
			<div class="twelve columns">
				<div class="list-items">
					<div class="titulo">
						<h4>Director del <?php echo PROYECTO; ?></h4>
					</div>
						<div class="form-add">
				        	<form name="form1" action="" method="post" enctype="multipart/form-data">
								<label for="titulo">Titulo</label>
				        		<input type="text" name="titulo" placeholder="Título" maxlength="100" value="<?php if($consulta['titulo'] != ""){ echo utf8_encode($consulta['titulo']); } ?>" required>
				        		<label for="descripcion">Descripción</label>
				        		<textarea class="editor" id="editor" name="descripcion" placeholder="Descripción"><?php if($consulta['descripcion'] != ""){ echo utf8_encode($consulta['descripcion']); } ?></textarea>
				        		<label for="portada">Imágen de portada</label>
				        		<?php if($consulta['titulo'] != ""){ ?> 
				        			<img src="<?php echo URL.$consulta['portada']; ?>" width="200" alt=""><br>
				        		<?php } ?>
								<input type="file" name="imagen" <?php if($consulta['titulo'] != ""){ ?> <?php }else{ ?> required <?php } ?>><br>
								<?php if($consulta['titulo'] != ""){ ?> <div class="mintext">Si no selecionas una nueva imagen se conserva la anterior</div> <?php }else{ ?>  <?php } ?>
				        		<?php if($consulta['titulo'] != ""){ ?>
				        		<input type="submit" name="editar" value="Guardar">
				        		<?php }else{ ?>
				        		<input type="submit" name="insertar" value="Guardar">
				        		<?php } ?>
				        	</form>
				        </div>
				    </div>
			</div>
		</div>
		<?php require_once(PREFIJO.'footer.php'); ?>
	</div>
	
	<script type="text/javascript" src="<?php echo ADMINURL; ?>js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo ADMINURL; ?>js/default.js"></script>
	<script type="text/javascript" src="<?php echo ADMINURL; ?>js/ckeditor/ckeditor.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function() {
		//$('.editor').jqte();
		 CKEDITOR.replace( 'editor' );
		 CKEDITOR.replace( 'editor2' );
		 CKEDITOR.replace( 'editor3' );
	});
	</script>
</body>
</html>