<?php
if(!session_start()){ session_start();}
	require_once('lib/config.php');
	require_once('lib/mysql.php');
	require_once('lib/funciones.php');
	require_once('lib/pagination.php');
	require_once('lib/recaptchalib.php');

	if(isset($_GET['do'])){
		//print_r($_GET); exit();
		$ruta = $_GET['do'];
		switch ($ruta) {
			case 'acerca':
				include(PREFIJO.'acerca.php');
				break;
			case 'acuerdos-de-colaboracion':
				include(PREFIJO.'acuerdo.php');
				break;		
			case 'salud':
				if(isset($_GET['act']) && $_GET['act'] != ""){
					switch ($_GET['act']) {
						case 'categoria':
							include(PREFIJO.'salud_category.php');
							break;
						case 'post':
							include(PREFIJO.'salud_post.php');
							break;
					}
				}else{
					include(PREFIJO.'salud.php');
				}
				break;	
			case 'tecnologia':
				if(isset($_GET['act']) && $_GET['act'] != ""){
					switch ($_GET['act']) {
						case 'categoria':
							include(PREFIJO.'tecnologia_category.php');
							break;
						case 'post':
							include(PREFIJO.'tecnologia_post.php');
							break;
					}
				}else{
					include(PREFIJO.'tecnologia.php');
				}
				break;			
			case 'politica':
				if(isset($_GET['act']) && $_GET['act'] != ""){
					switch ($_GET['act']) {
						case 'categoria':
							include(PREFIJO.'politica_category.php');
							break;
						case 'post':
							include(PREFIJO.'politica_post.php');
							break;
					}
				}else{
					include(PREFIJO.'politica.php');
				}
				break;		
			case 'entretenimiento':
				if(isset($_GET['act']) && $_GET['act'] != ""){
					switch ($_GET['act']) {
						case 'categoria':
							include(PREFIJO.'entretenimiento_category.php');
							break;
						case 'post':
							include(PREFIJO.'entretenimiento_post.php');
							break;
					}
				}else{
					include(PREFIJO.'entretenimiento.php');
				}
				break;
			case 'deporte':
				if(isset($_GET['act']) && $_GET['act'] != ""){
					switch ($_GET['act']) {
						case 'categoria':
							include(PREFIJO.'deporte_category.php');
							break;
						case 'post':
							include(PREFIJO.'deporte_post.php');
							break;
					}
				}else{
					include(PREFIJO.'deporte.php');
				}
				break;	
			case 'privacidad':
				include(PREFIJO.'privacy.php');
				break;
			case 'mapa-de-sitio':
				include(PREFIJO.'sitemap.php');
				break;
			case 'terminos-y-condiciones':
				include(PREFIJO.'terminos.php');
				break;	
			case 'actualizaciones':
				include(PREFIJO.'actualizaciones.php');
				break;
			case 'consultar':
				include(PREFIJO.'consultar.php');
				break;
			case 'login':
				include(PREFIJO.'login.php');
				break;
			case 'logout':
				include(PREFIJO.'logout.php');
				break;
			case 'registro':
				include(PREFIJO.'registro.php');
				break;
			case 'recuperar':
				include(PREFIJO.'recuperar.php');
				break;
			case 'perfil':
				include(PREFIJO.'perfil.php');
				break;
			case 'historial':
				include(PREFIJO.'historial.php');
				break;
			case 'salir':
				include(PREFIJO.'logout.php');
				break;	
			case '404':
				include('404.php');
				break;
			default:
				include(PREFIJO.'main.php');
				break;
		}
	}else{
		include(PREFIJO.'main.php');
	}
?>