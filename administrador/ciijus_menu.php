<?php $buscarAvatar = devolverValorQuery("SELECT avatar FROM ".DB_PREFIJO."administrador WHERE id".DB_PREFIJO."administrador=".$_SESSION[PREFIJO.'idadmin']." "); ?>

<header>
	<div class="cabecera">
		<div class="titulo">Administración</div>
	</div>
	<div class="user-detail">
		<div class="avatar">
			<a <?php if($buscarAvatar['avatar'] != ""){ ?> style="background:url(<?php echo URL.$buscarAvatar['avatar']; ?>);" <?php } ?> ></a>
			<div class="no-image">
					<i class="fa-icon-user"></i>
			</div>
		</div>
		<div class="username"><a href="<?php echo ADMINURL; ?>profile/"><i class="fa-icon-user-o"></i> <?php echo $_SESSION[PREFIJO.'user']; ?></a></div>
	</div>
	<nav>
		<ul class="menu">
			<li class="menu-icon"><a href="#">Menu</a></li>
			<li <?php if($_GET['do'] == ""){ echo 'class="current"'; } ?>>
				<a href="<?php echo ADMINURL; ?>"><i class="fa-icon-dashboard"></i> Tablero</a>
			</li>
			<li class="encabezado">
				<a href="javascript:;" class="toggle" id="1"> <i class="fa-icon-bank"></i> CIIJUS <span><i class="fa-icon-caret-down"></i></span></a>
					<div id="item_1" class="mostrar">
						<ul>
							<li <?php if(isset($_GET['do']) && $_GET['do'] == "acerca"){ ?>class="current"<?php } ?>><a href="<?php echo ADMINURL; ?>content/acerca">Acerca</a></li>
							<li <?php if(isset($_GET['do']) && $_GET['do'] == "director"){ ?>class="current"<?php } ?>><a href="<?php echo ADMINURL; ?>content/director">Director</a></li>
							<li <?php if(isset($_GET['do']) && $_GET['do'] == "miembro"){ ?>class="current"<?php } ?>><a href="<?php echo ADMINURL; ?>content/miembro">Miembros</a></li>
							<li <?php if(isset($_GET['do']) && $_GET['do'] == "acuerdo"){ ?>class="current"<?php } ?>><a href="<?php echo ADMINURL; ?>content/acuerdo">Acuerdo</a></li>
						</ul>
					</div>
			</li>
			<li class="encabezado">
				<a href="javascript:;" class="toggle" id="2"> <i class="fa-icon-suitcase"></i> Oferta <span><i class="fa-icon-caret-down"></i></span></a>
					<div id="item_2" class="mostrar">
						<ul>
							<li <?php if(isset($_GET['do']) && $_GET['do'] == "oferta-categorias"){ ?>class="current"<?php } ?>><a href="<?php echo ADMINURL; ?>content/oferta-categorias">Categorias</a></li>
							<li <?php if(isset($_GET['do']) && $_GET['do'] == "oferta"){ ?>class="current"<?php } ?>><a href="<?php echo ADMINURL; ?>content/oferta">Publicaciones</a></li>
						</ul>
					</div>
			</li>
			<li class="encabezado">
				<a href="javascript:;" class="toggle" id="3"> <i class="fa-icon-newspaper-o"></i> Blog <span><i class="fa-icon-caret-down"></i></span></a>
					<div id="item_3" class="mostrar">
						<ul>
							<li <?php if(isset($_GET['do']) && $_GET['do'] == "categorias"){ ?>class="current"<?php } ?>><a href="<?php echo ADMINURL; ?>content/categorias">Categorias</a></li>
							<li <?php if(isset($_GET['do']) && $_GET['do'] == "blog"){ ?>class="current"<?php } ?>><a href="<?php echo ADMINURL; ?>content/blog">Publicaciones</a></li>
						</ul>
					</div>
			</li>
			<li class="encabezado">
				<a href="javascript:;" class="toggle" id="4"> <i class="fa-icon-book"></i> Libreria <span><i class="fa-icon-caret-down"></i></span></a>
					<div id="item_4" class="mostrar">
						<ul>
							<li <?php if(isset($_GET['do']) && $_GET['do'] == "libreria-categorias"){ ?>class="current"<?php } ?>><a href="<?php echo ADMINURL; ?>content/libreria-categorias">Categorias</a></li>
							<li <?php if(isset($_GET['do']) && $_GET['do'] == "libreria"){ ?>class="current"<?php } ?>><a href="<?php echo ADMINURL; ?>content/libreria">Publicaciones</a></li>
						</ul>
					</div>
			</li>
			<li class="encabezado <?php if(isset($_GET['do']) && $_GET['do'] == "slider"){ ?>current <?php } ?>">
				<a href="<?php echo ADMINURL; ?>content/slider/"> <i class="fa-icon-picture-o"></i> slider</a>
			</li>
			<li class="encabezado <?php if(isset($_GET['do']) && $_GET['do'] == "coloquium"){ ?>current <?php } ?>">
				<a href="<?php echo ADMINURL; ?>content/clinica-juridica/"> <i class="fa-icon-picture-o"></i> Clinica Juridica</a>
			</li>
			<li class="encabezado <?php if(isset($_GET['do']) && $_GET['do'] == "coloquium"){ ?>current <?php } ?>">
				<a href="<?php echo ADMINURL; ?>content/coloquium/"> <i class="fa-icon-picture-o"></i> Coloquium</a>
			</li>
			<li class="encabezado <?php if(isset($_GET['do']) && $_GET['do'] == "version"){ ?>current <?php } ?>">
				<a href="<?php echo ADMINURL; ?>content/version/"> <i class="fa-icon-upload"></i> version</a>
			</li>
			<li class="encabezado">
				<a href="javascript:;" class="toggle" id="5"> <i class="fa-icon-gears"></i> ajustes <span><i class="fa-icon-caret-down"></i></span></a>
					<div id="item_5" class="mostrar">
						<ul>
							<li <?php if(isset($_GET['do']) && $_GET['do'] == "usuarios"){ ?>class="current"<?php } ?>><a href="<?php echo ADMINURL; ?>content/usuarios"> <i class="fa-icon-user"></i> Usuarios</a></li>
						</ul>
					</div>
			</li>

		</ul>
	</nav>
</header>
<div class="navegacion">
	<div class="area">
		<h4><a href="<?php echo ADMINURL; ?>content/<?php echo $_GET['do'];  ?>" <?php if(isset($_GET['act']) && $_GET['act'] != ""){ ?> class="current" <?php } ?>><?php echo $_GET['do'];  ?></a> <?php if(isset($_GET['act']) && $_GET['act'] != ""){ ?> / <span><?php echo $_GET['act']; ?> registro</span> <?php } ?></h4>
	</div>
	<div class="objetos">
		<ul>
			<li><a href="<?php echo ADMINURL ?>salir/"><i class="fa-icon-sign-out"></i></a></li>
		</ul>
	</div>
</div>