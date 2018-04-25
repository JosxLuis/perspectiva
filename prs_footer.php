
<footer>
        <div class="top">
            <div class="container">
                <div class="six columns">
                    <div class="logo-blanco"></div>
                    <div class="descripcion">
                        <p>Por medio de esta plataforma, serás capaz de encontrar noticias verificadas por nuestra comunidad de usuarios, así como comprobar la validez de aquellas noticias de las que dudes su veracidad.</p>
                        <div class="telefono">
                            <span>soporte@perspectiva.mx</span>
                        </div>
                    </div>
                </div>
                <div class="three columns">
                    <h4>CATEGORIAS</h4>
                    <div class="linea-roja"></div>
                    <ul>
                         <li>
                             <a href="<?php echo URL; ?>salud/">
                                <i class="fa fa-caret-right"></i>
                                SALUD
                             </a>
                         </li>
                         <li>
                             <a href="<?php echo URL; ?>tecnologia/">
                                <i class="fa fa-caret-right"></i>
                                TECNOLOGIA
                             </a>
                         </li>
                         <li>
                             <a href="<?php echo URL; ?>politica/">
                                <i class="fa fa-caret-right"></i>
                                POLÍTICA
                             </a>
                         </li>
                         <li>
                             <a href="<?php echo URL; ?>entretenimiento/">
                                <i class="fa fa-caret-right"></i>
                                ENTRETENIMIENTO
                             </a>
                         </li>
                         <li>
                             <a href="<?php echo URL; ?>deporte/">
                                <i class="fa fa-caret-right"></i>
                                DEPORTE
                             </a>
                         </li>
                    </ul>
                </div>
                <div class="three columns">
                    <h4>ENLACES</h4>
                    <div class="linea-roja"></div>
                    <ul>
                         <li>
                             <a href="<?php echo URL; ?>">
                                <i class="fa fa-caret-right"></i>
                                 INICIO
                             </a>
                         </li>
                          <li>
                             <a href="<?php echo URL; ?>acerca/">
                                <i class="fa fa-caret-right"></i>
                                 ACERCA
                             </a>
                         </li>
                         <li>
                             <a href="<?php echo URL; ?>privacidad/">
                                <i class="fa fa-caret-right"></i>
                                PRIVACIDAD
                             </a>
                         </li>
                         <li>
                             <a href="<?php echo URL; ?>terminos-y-condiciones/">
                                <i class="fa fa-caret-right"></i>
                                TERMINOS Y CONDICIONES
                             </a>
                         </li>
                         <li>
                             <a href="<?php echo URL; ?>actualizaciones/">
                                <i class="fa fa-caret-right"></i>
                                ACTUALIZACIONES
                             </a>
                         </li>
                    </ul>
                </div>
                <div class="four columns">
                     <h4>VALIDACIÓN</h4>
                    <div class="linea-roja"></div>
                    <ul>
                         <li>
                             <a href="<?php echo URL; ?>login/">
                                <i class="fa fa-user"></i>
                                 VALIDAR
                             </a>
                         </li>
                         <li>
                             <a href="<?php echo URL; ?>consultar/">
                                <i class="fa fa-envelope"></i>
                                CONSULTAR
                             </a>
                         </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="bottom">
            <div class="container">
                <div class="sixteen columns">
                    <?php echo PROYECTO; ?> &copy; Derechos Reservados <?php echo date('Y'); ?>
                </div> 
            </div>
        </div>
    </footer>
<script src="<?php echo URL; ?>js/jquery<?php echo MIN; ?>.js"></script>
<!-- Global Site Tag (gtag.js) - Google Analytics -->
<script src="https://cdn.jsdelivr.net/ga-lite/latest/ga-lite.min.js" async></script>
<script>
    $("a#movil-button").toggle(function () {
        $("#menu-movil").addClass("show");
      },function (){
        $("#menu-movil").removeClass("show");
    });
</script> 