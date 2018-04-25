<?php
	if(isset($_POST['libro_categoria']) && $_POST['libro_categoria'] != ""){
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

				$ruta_image_normal = $dir."imagen_".$random.".".$file_ext;

				$fotografia = $ruta_image_normal;

			}else{
				$fotografia = '';
			}
		}else{
			$fotografia = '';
		}

		if($_POST['descuento'] == 1){
			$valueCostoDescuento = ",costo_descuento";
			$postCostoDescuento = ",'".$_POST['costo_descuento']."'";
		}else{
			$valueCostoDescuento = "";
			$postCostoDescuento = "";
		}

		$autor=mostrarNombre($_SESSION[PREFIJO.'idadmin'],"administrador","nombre");


		$insertarRegistro = "INSERT INTO ".DB_PREFIJO."libro(id".DB_PREFIJO."libro,id".DB_PREFIJO."administrador,id".DB_PREFIJO."libro_categoria,portada,nombre,autor,costo,cantidad,descuento $valueCostoDescuento,activo,creado) 
		VALUES (0,".$_SESSION[PREFIJO.'idadmin'].",".$_POST['libro_categoria'].",'".$fotografia."','".utf8_decode(addslashes($_POST['nombre']))."','".utf8_decode(addslashes($_POST['autor']))."','".utf8_decode(addslashes($_POST['costo']))."','".utf8_decode(addslashes($_POST['cantidad']))."','".utf8_decode(addslashes($_POST['descuento']))."' $postCostoDescuento,'".utf8_decode(addslashes($_POST['activo']))."','".$fecha."')";
		//echo $insertarRegistro; exit();
		mysqli_query($conexion,$insertarRegistro) or die(mysqli_error());

		$success = "<i class='fa-icon-check-circle'></i> El registro ha sido guardado con éxito";

	}

	$categoria = "SELECT * FROM ".DB_PREFIJO."libro_categoria";
	$resCategoria = mysqli_query($conexion,$categoria);

?>
<!DOCTYPE HTML>
<html lang="es-MX">
<head>
	<meta charset="UTF-8">
	<title>Publicación - Crear <?php echo PROYECTO; ?></title>
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
						<h4>Nueva Noticia</h4>
					</div>
			        <div class="form-add">
			        	<form name="form1" action="" method="post" enctype="multipart/form-data">
			        		<label for="marca">Categoria <span>*</span></label>
							<select name="libro_categoria" required>
								<option value="">Elegir</option>
								<?php while($rowCategoria = mysqli_fetch_array($resCategoria)){ ?>
									<option value="<?php echo $rowCategoria['id'.DB_PREFIJO.'libro_categoria']; ?>"><?php echo utf8_encode($rowCategoria['titulo']); ?></option>
								<?php } ?>
							</select>
			        		<label for="foto">Portada</label>
			    			<input type="file" name="imagen">
			        		<label for="nombre">Nombre <span>*</span></label>
			        		<input type="text" name="nombre" placeholder="Nombre del libro" maxlength="200" required>
			        		<label for="autor">Autor <span>*</span></label>
			        		<input type="text" name="autor" placeholder="Autor del libro" maxlength="200" required>
			        		<label for="costo">Costo <span>*</span></label>
			        		<input type="text" name="costo" placeholder="Costo del libro" required>
			        		<label for="cantidad">Cantidad <span>*</span></label>
			        		<input type="text" name="cantidad" placeholder="Cantidad del libro" required>
			        		<label for="descuento">Descuento</label>
							<select name="descuento" id="" required>
								<option value="0">No</option>
								<option value="1">Si</option>
							</select>
							<label for="costo_descuento">Costo con el descuento</label>
			        		<input type="text" name="costo_descuento" placeholder="Costo con el descuento del libro" >
			        		<label for="activo">Activo</label>
							<select name="activo" id="" required="">
								<option value="1">Activo</option>
								<option value="0">Inactivo</option>
							</select>
			    			<label for="requerido" class="req"><span>*</span> campos requeridos</label>
			        		<input type="submit" name="insertar" value="Publicar"> 
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