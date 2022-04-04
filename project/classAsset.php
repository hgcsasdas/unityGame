<!doctype html>
<html lang="es">
<?php include "Includes/head.php" ?>
<?php include "Includes/nav.php" ?>
<link rel="stylesheet" href="Css/claseStyle.css">
<body onload="" class="clase">
<main>
    <h5 class="tituloModulo">CURSO DE DESARROLLO DE APPS MÓVILES: MÓDULO 1/8</h5>
    <h1 class="tituloClase">Del nacimiento del teléfono móvil a las apps</h1>
    <aside class="claseContenido">
        <ul class="listaClases">
            <li><a href="classAssetIntroduction.php">Resumen del tema</a></li>
            <li id="lecciones">Lecciones <strong class="durationTime">10</strong></li>
            <li>
                <a href="#" class="menuClases" onclick="desplegarSubmenu2()">Lección 1 <strong>10</strong><i class="fa-solid fa-angle-down"></i></></a>
                <ul class="desplegableClases">
                    <li><a href="classAsset.php" class="tema">Estudia<strong class="durationTime">10</strong></a></li>
                    <li><a href=examAsset.php class="exam">Practica<strong class="durationTime">10</strong></a></li>
                </ul>
            </li>
        </ul>
    </aside>
    <section class="claseContenido">
        <div id="reproductor">
            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/mT0oRvejoSI"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
        </div>
        <button id="testUnidad" onclick="">Comprueba tus conocimientos</button>
        <div class="contenidoClase">
            <p>Objetivos:

                Conocer las generaciones de la telefonía móvil y sus principales hitos técnicos y comerciales.
                Conocer las principales características técnicas de la próxima generación de telefonía móvil.
            </p>
        </div>
    </section>
</main>

<?php include "Includes/footer.php" ?>
</body>
</html>
