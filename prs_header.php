<div class="top-header">
       <div class="container">
            <div class="four columns">
                <div class="news">
                    <h2>TOP NOTICIAS<i class="fa fa-bullhorn"></i></h2>
                </div>
            </div>
            <div class="twelve columns">
                    <div class="links">
                        <ul>
                            <marquee behavior="" direction=""><li class="telefono"><a href="tel:019616881705"><i class="fa fa-circle "></i> tu publicidad aqui </a></li><li class="email"><a href="<?php echo URL; ?>contacto/"><i class="fa a-circle"></i> tu publicidad aqui</a></li><li class="email"><a href="<?php echo URL; ?>contacto/"><i class="fa a-circle"></i> tu publicidad aqui</a></li><li class="email"><a href="<?php echo URL; ?>contacto/"><i class="fa a-circle"></i> tu publicidad aqui</a></li><li class="email"><a href="<?php echo URL; ?>contacto/"><i class="fa a-circle"></i> tu publicidad aqui</a></li><li class="email"><a href="<?php echo URL; ?>contacto/"><i class="fa a-circle"></i> tu publicidad aqui</a></li></marquee>
                        </ul>
                    </div>
            </div>
       </div>
</div>
<header>
    <div class="container">
        <div class="one-third column">
            <div class="fleft">
                <div class="social">
                    <ul>
                        <li class="youtube"><a href="#" target="_blank"><i class="fa fa-youtube"></i></a></li>
                        <li class="instagram"><a href="#" target="_blank"><i class="fa fa-instagram"></i></a></li>
                        <li class="twitter"><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
                        <li class="facebook"><a href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="one-third column">
            <div class="logo">
                <a href="<?php echo URL; ?>"></a>
            </div>
        </div>
        <div class="one-third column">
            <div class="fright">
                <div class="shop">
                    <ul>
                        <li class="telefono"><a href="<?php echo URL; ?>login/">Login</a></li>
                        <li class="divisor">|</li>
                        <li><a href="<?php echo URL; ?>registro/">Regístrate</a></li>
                        <li><a><i class="fa fa-user"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <a href="javascript:;" id="movil-button" class="desplegar-menu"><i class="flaticon-bars"></i></a>
    <div id="menu-movil" class="box sec-white">
        <nav>
            <div class="container">
                <div class="sixteen columns">
                    <ul>
                        <li class="item <?php if(isset($_GET['do']) && $_GET['do'] == ""){ ?> current<?php } ?>" ><a href="<?php echo URL; ?>">INICIO</a></li>
                        <li class="item <?php if(isset($_GET['do']) && $_GET['do'] == "salud"){ ?> current<?php } ?>"><a href="<?php echo URL; ?>salud/">SALUD</a></li>
                        <li class="item <?php if(isset($_GET['do']) && $_GET['do'] == "tecnologia"){ ?> current<?php } ?>"><a href="<?php echo URL; ?>tecnologia/">TECNOLOGIA</a></li>
                        <li class="item <?php if(isset($_GET['do']) && $_GET['do'] == "politica"){ ?> current<?php } ?>"><a href="<?php echo URL; ?>politica/">POLÍTICA</a></li>
                        <li class="item <?php if(isset($_GET['do']) && $_GET['do'] == "entretenimiento"){ ?> current<?php } ?>"><a href="<?php echo URL; ?>entretenimiento/">ENTRETENIMIENTO</a></li>
                        <li class="item <?php if(isset($_GET['do']) && $_GET['do'] == "deporte"){ ?> current<?php } ?>"><a href="<?php echo URL; ?>deporte/">DEPORTE</a></li>
                        <li class="item <?php if(isset($_GET['do']) && $_GET['do'] == "consultar"){ ?> current<?php } ?>"><a href="<?php echo URL; ?>consultar/">CONSULTAR</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>