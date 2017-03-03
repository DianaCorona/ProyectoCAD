<?php
    if((!isset($_SESSION['autorizacionrm']))||($_SESSION['autorizacionrm']==false))
    {
        header("Location: index.php");
        exit;
    }
?>
<!-- Menú para vistas de escritorio y pantallas grandes -->
<div id="top-menu" style="position:fixed;top:0;z-index:100;background:#1B75CE;width:100%;">
    <nav class="ink-navigation ink-grid">
        <!-- Botón que se muestra en pantallas pequeñas para desplegar el menú 2 -->
        <ul class="menu horizontal blue push-left medium-push-left small-push-left tiny-push-left">
            <li class="hide-all show-tiny show-small show-medium"><a style="font-size:1em;" class="fa fa-bars left-drawer-trigger"></a> </li>
            <li><img src="mundo.png" style="height:40px;margin:0 1em 0 0;padding-top:6px;"></li>
        </ul>
        <!-- Fin de botón -->

        <!-- Menú para vistas de escritorio y pantallas grandes -->
        <ul class="menu horizontal blue push-left hide-small hide-tiny hide-medium">
            <li class="condensed-300"><a href="inicio.php">Inicio</a></li>
            <?php if($_SESSION['privilegiosrm']==1){ ?>
                <li class="condensed-300">
                    <a href="#">Catálogos</a>
                    <ul class="submenu">
                        <li class="condensed-300"><a href="usuarios.php">Usuarios</a></li>
                        <li class="condensed-300"><a href="status.php">Status</a></li>
                        <li class="condensed-300"><a href="areas.php">Areas</a></li>
                        <li class="condensed-300"><a href="tipo_productos.php">Tipo Productos</a></li>
                    </ul>
                </li>
                <li class="condensed-300">
                    <a href="#">Almacen</a>
                    <ul class="submenu">
                        <li class="condensed-300"><a href="productos.php">Productos</a></li>
                        <li class="condensed-300"><a href="almacen.php">Almacen</a></li>
                    </ul>
                </li>
            <?php } ?>
            <li class="condensed-300"><a href="#">item 4</a></li>
            <li class="condensed-300"><a href="#">item 5</a></li>
        </ul>
        <!-- Fin de Menú -->

        <!-- Menú de Sesión -->
        <ul class="menu horizontal blue push-right">
            <li class="condensed-300">
                <a style="color:#fff;"><?php echo $_SESSION['nombreusuariorm']." ".$_SESSION['appaternousuariorm']." ".$_SESSION['apmaternousuariorm']; ?> &nbsp <span style="font-size:1em;" class="fa fa-user"></span></a>
                <ul class="submenu blue">
                    <li class="condensed-300"><a href="#"><span class="fa fa-cog"></span> &nbsp Confiuración</a></li>
                    <li class="condensed-300"><a href="fin.php"><span class="fa fa-sign-out"></span> &nbsp Salir</a></li>
                </ul>
            </li>
        </ul>
        <!-- Fin de Menú de Sesión -->

    </nav>
</div>

<!-- Menú para vistas movil y tablets (replicar ocpiones del menú anterior) -->
<div class="left-drawer" style="margin-top:45px;background:#c6c6c6;">
    <nav class="ink-navigation ink-grid" style="padding:0;">
        <ul class="menu vertical black">
            <li class="condensed-300"><a href="inicio.php">Inicio</a></li>
            <?php if($_SESSION['privilegiosrm']==1){ ?>
                <li class="condensed-300">
                    <a href="#">Catálogos</a>
                    <ul class="submenu">
                        <li class="condensed-300"><a href="usuarios.php">Usuarios</a></li>
                        <li class="condensed-300"><a href="#">Cosas</a></li>
                    </ul>
                </li>
            <?php } ?>
            <li class="condensed-300"><a href="#">item 3</a></li>
            <li class="condensed-300"><a href="#">item 4</a></li>
            <li class="condensed-300"><a href="#">item 5</a></li>
        </ul>
    </nav>
</div>
