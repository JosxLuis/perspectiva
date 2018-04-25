<?php
if(!session_start()){
	ini_set('session.gc_maxlifetime', 3600);
	session_set_cookie_params(3600);
	session_start();
}
require_once('lib/config.php');
require_once('lib/mysql.php');
require_once('lib/pagination.php');
require_once('lib/funciones.php');

$checkanio = date('Y');
$checkmes = date('m');
$rutaYear = "../img/media/".$checkanio."/";
$rutaMonth = "../img/media/".$checkanio."/".$checkmes."/";
makeDir($rutaYear);
makeDir($rutaMonth);

if(isset($_SESSION[PREFIJO.'idadmin'])){
	
	if(isset($_GET['do'])){
		$ruta=$_GET['do'];
		switch($ruta){
			case "profile":
				include(PREFIJO.'perfil.php');
				break;
			case "usuarios":
				if(isset($_GET['act'])){
					switch(@$_GET['act']){
						case "nuevo":include(PREFIJO.'usuarios_add.php');
						break;
						case "editar":include(PREFIJO.'usuarios_edit.php');
						break;
						case "eliminar":include(PREFIJO.'usuarios.php');
						break;
					}
				}else{
					include(PREFIJO.'usuarios.php');
				}
			break;
			case "blog":
				if(isset($_GET['act'])){
					switch(@$_GET['act']){
						case "nuevo":include(PREFIJO.'blog_post_add.php');
						break;
						case "editar":include(PREFIJO.'blog_post_edit.php');
						break;
						case "eliminar":include(PREFIJO.'blog_post.php');
						break;
					}
				}else{
					include(PREFIJO.'blog_post.php');
				}
			break;	
			case "categorias":
				if(isset($_GET['act'])){
					switch(@$_GET['act']){
						case "nuevo":include(PREFIJO.'blog_categorias_add.php');
						break;
						case "editar":include(PREFIJO.'blog_categorias_edit.php');
						break;
						case "eliminar":include(PREFIJO.'blog_categorias.php');
						break;
					}
				}else{
					include(PREFIJO.'blog_categorias.php');
				}
			break;
			case "oferta":
				if(isset($_GET['act'])){
					switch(@$_GET['act']){
						case "nuevo":include(PREFIJO.'oferta_post_add.php');
						break;
						case "editar":include(PREFIJO.'oferta_post_edit.php');
						break;
						case "eliminar":include(PREFIJO.'oferta_post.php');
						break;
					}
				}else{
					include(PREFIJO.'oferta_post.php');
				}
			break;	
			case "oferta-categorias":
				if(isset($_GET['act'])){
					switch(@$_GET['act']){
						case "nuevo":include(PREFIJO.'oferta_categorias_add.php');
						break;
						case "editar":include(PREFIJO.'oferta_categorias_edit.php');
						break;
						case "eliminar":include(PREFIJO.'oferta_categorias.php');
						break;
					}
				}else{
					include(PREFIJO.'oferta_categorias.php');
				}
			break;
			case "libreria":
				if(isset($_GET['act'])){
					switch(@$_GET['act']){
						case "nuevo":include(PREFIJO.'libreria_add.php');
						break;
						case "editar":include(PREFIJO.'libreria_edit.php');
						break;
						case "eliminar":include(PREFIJO.'libreria.php');
						break;
					}
				}else{
					include(PREFIJO.'libreria.php');
				}
			break;	
			case "libreria-categorias":
				if(isset($_GET['act'])){
					switch(@$_GET['act']){
						case "nuevo":include(PREFIJO.'libreria_categorias_add.php');
						break;
						case "editar":include(PREFIJO.'libreria_categorias_edit.php');
						break;
						case "eliminar":include(PREFIJO.'libreria_categorias.php');
						break;
					}
				}else{
					include(PREFIJO.'libreria_categorias.php');
				}
			break;
			case "acerca":
				if(isset($_GET['act'])){
					switch(@$_GET['act']){
						case "nuevo":include(PREFIJO.'acerca.php');
						break;
					}
				}else{
					include(PREFIJO.'acerca.php');
				}
			break;	
			case "director":
				if(isset($_GET['act'])){
					switch(@$_GET['act']){
						case "nuevo":include(PREFIJO.'director.php');
						break;
					}
				}else{
					include(PREFIJO.'director.php');
				}
			break;
			case "miembro":
				if(isset($_GET['act'])){
					switch(@$_GET['act']){
						case "nuevo":include(PREFIJO.'miembro_add.php');
						break;
						case "editar":include(PREFIJO.'miembro_edit.php');
						break;
						case "eliminar":include(PREFIJO.'miembro.php');
						break;
					}
				}else{
					include(PREFIJO.'miembro.php');
				}
			break;
			case "acuerdo":
				if(isset($_GET['act'])){
					switch(@$_GET['act']){
						case "nuevo":include(PREFIJO.'acuerdo_add.php');
						break;
						case "editar":include(PREFIJO.'acuerdo_edit.php');
						break;
						case "eliminar":include(PREFIJO.'acuerdo.php');
						break;
					}
				}else{
					include(PREFIJO.'acuerdo.php');
				}
			break;				
			case "slider":
				if(isset($_GET['act'])){
					switch(@$_GET['act']){
						case "nuevo":include(PREFIJO.'slider_add.php');
						break;
						case "editar":include(PREFIJO.'slider_edit.php');
						break;
						case "eliminar":include(PREFIJO.'slider.php');
						break;
					}
				}else{
					include(PREFIJO.'slider.php');
			    }
			break;
			case "coloquium":
				if(isset($_GET['act'])){
					switch(@$_GET['act']){
						case "nuevo":include(PREFIJO.'coloquium_add.php');
						break;
						case "editar":include(PREFIJO.'coloquium_edit.php');
						break;
						case "eliminar":include(PREFIJO.'coloquium.php');
						break;
					}
				}else{
					include(PREFIJO.'coloquium.php');
			    }
			break;
			case "clinica-juridica":
				if(isset($_GET['act'])){
					switch(@$_GET['act']){
						case "nuevo":include(PREFIJO.'clinica_juridica_add.php');
						break;
						case "editar":include(PREFIJO.'clinica_juridica_edit.php');
						break;
						case "eliminar":include(PREFIJO.'clinica_juridica.php');
						break;
					}
				}else{
					include(PREFIJO.'clinica_juridica.php');
				}
			break;
			case "version":
				if(isset($_GET['act'])){
					switch(@$_GET['act']){
						case "nuevo":include(PREFIJO.'version_add.php');
						break;
						case "editar":include(PREFIJO.'version_edit.php');
						break;
						case "eliminar":include(PREFIJO.'version.php');
						break;
					}
				}else{
					include(PREFIJO.'version.php');
				}
			break;	
			case "users":
				if(isset($_GET['act'])){	
					switch(@$_GET['act']){
						case "nuevo":include(PREFIJO.'configuracion_usuarios_add.php');
						break;
						case "editar":include(PREFIJO.'configuracion_usuarios_edit.php');
						break;
						case "permisos":include(PREFIJO.'configuracion_usuarios_privileges.php');
						break;
						case "eliminar":include(PREFIJO.'configuracion_usuarios.php');
						break;
					}
				}else{
					include(PREFIJO.'configuracion_usuarios.php');
				}
			break;
			case "profile":
				include(PREFIJO.'profile.php');
				break;
			case "settings":
				include(PREFIJO.'settings.php');
				break;
			case "salir":
				include('logout.php');
				break;
			default: 
				include(PREFIJO.'main.php');
				break;
		}
		
	}
	else{
		include(PREFIJO.'main.php');
	}
	
}
else{
	include('login.php');
}
?>