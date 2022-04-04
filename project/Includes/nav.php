<span class="nav-bar" id="btnMenu" onclick="ocultar()"><i class="fas fa-bars"></i>Menú</span>
<nav class="main-nav">
    <ul class="menu" id="menu">
        <li class="menu__item"><a href="index.php"><img class="logo" src="Imgs/logo.jpeg" alt=""></a></li>
        <li class="menu__item"><a href="index.php" class="menu__link">Inicio</a></li>
        <li class="menu__item container-submenu">
            <a href="#" class="menu__link submenu-btn" onclick="desplegarSubmenu()"> Servicios <span class="drop-down"><i class="fa-solid fa-angle-down"></i></span></a>

            <ul class="submenu1">
                <li class="menu__item"><a href="cursos.php" class="menu__link">Cursos</a></li>
                <li class="menu__item"><a href="#" class="menu__link">Exámenes resueltos</a></li>
                <li class="menu__item"><a href="#" class="menu__link">Pregunta a tu profe</a></li>
                <li class="menu__item"><a href="classCreator.php" class="menu__link">Crear clases</a></li>
            </ul>
        </li>

        <li class="menu__item" id="Plataformas"><a href="plataformas.php" class="menu__link">Plataformas</a></li>
        <li class="menu__item"><a href="nosotros.php" class="menu__link">Nosotros</a></li>
        <li class="menu__item container-submenu">
            <a href="#" class="menu__link submenu-btn" onclick="desplegarSubmenu1()">Iniciar Sesión <span class="drop-down"><i class="fa-solid fa-angle-down"></i></span></a>
            <ul class="submenu2">
                <li class="menu__item"><a href="iniciarSesion.php" class="menu__link">Iniciar sesión</a></li>
                <li class="menu__item"><a href="registrar.php" class="menu__link">Registrarse</a></li>
            </ul>
        </li>
    </ul>
</nav>