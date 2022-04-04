<!doctype html>
<html lang="es">

<?php
include "Includes/head.php";
include "Includes/nav.php";
require "php/Modelo/Usuario.php";
require "php/Modelo/class.bd.php";
require "php/Controlador/Controller.php";
?>

<link rel="stylesheet" href="Css/claseStyle.css">
<?php
if (isset($_GET) && !empty($_GET)){

    $controller = new controller();

    $exito =  $controller->leerEnDB("classes", $_GET);
    foreach ($exito as $item=>$value){
        $$item = $value;
    }
    $tituloModulo = $titulo;
    $tituloClase = $nombre;
    $introduccion = $resumen;
    $numLecciones = $numLecciones;
    $duracionLeccion = $cduracion;
    $duracionExamen = $eduracion;
    $duracionTotal = $duracionLeccion + $duracionExamen;
    $fuenteVideo = $video;
    $descripcionClase = $contenido;
    $id=$id_modulo;

}
  ?>
<main>
    <h5 class="tituloModulo"><?php echo $tituloModulo ?></h5>
    <h1 class="tituloClase"><?php echo $tituloClase ?></h1>
    <aside class="claseContenido">
        <ul class="listaClases">
            <li><a href="<?php echo 'classAssetIntroduction.php?id='.$id?>">Resumen del tema</a></li>
            <li id="lecciones">Lecciones <strong><?php echo $numLecciones?></strong></li>
            <li>
                <a href="#" class="menuClases" onclick="desplegarSubmenu2()">Leccion 1 <strong><?php echo $duracionTotal?> min</strong><i class="fa-solid fa-angle-down"></i></></a>
                <ul class="desplegableClases">
                    <li><a href="<?php echo 'classAsset.php?id='.$id?>">Estudia<strong><?php echo $duracionLeccion?> min</strong></a></li>
                    <li><a href="<?php echo 'examAsset.php?id='.$id?>">Practica<strong><?php echo $duracionExamen?> min</strong></a></li>
                </ul>
            </li>
        </ul>
    </aside>
    <section class="claseContenido">
        <div id="resumen">
        <?php echo $introduccion;?>
        </div>
    </section>
</main>

<?php include "Includes/footer.php" ?>
</body>
</html>
