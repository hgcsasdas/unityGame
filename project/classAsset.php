<!doctype html>
<html lang="es">

<?php
include "Includes/head.php";
include "Includes/nav.php";
require "php/Modelo/Usuario.php";
require "php/Modelo/classes.bd.php";
require "php/Controlador/Controller.php";
?>

<link rel="stylesheet" href="Css/claseStyle.css">
<?php
if (isset($_GET) && !empty($_GET)){

    $controller = new controller();
    $clases =  $controller->leerEnDB("classes2", $_GET);
    echo "<script type='module'>imprimirClases(".$clases.")</script>";
    echo "<script type='module'>mostrarClase(".$clases.", ".$_GET['c'].")</script>";

    $exito =  $controller->leerEnDB("classes", $_GET);
    foreach ($exito as $item=>$value){
        $$item = $value;
    }
    $tituloModulo = $titulo;
    $tituloClase = $nombre;
    $numLecciones = $numLecciones;
    $duracionLeccion = $cduracion;
    $duracionExamen = $eduracion;
    $duracionTotal = $duracionLeccion + $duracionExamen;
    $fuenteVideo = $video;
    $descripcionClase = $contenido;
    $id=$id_modulo;


}
?>

<script>
    function imprimirClases(clases){
        console.log(clases);
        let lecciones = document.querySelector(".listaLecciones");
        let leccion ="";
        for (let i =0; i<clases.length; i++) {
            leccion += '<li><a href="#" class="menuClases" onclick="desplegarSubmenu2()">Leccion '+(i+1)+' <strong>'+(parseInt(clases[i]["cduracion"])+parseInt(clases[i]["eduracion"]))+' min</strong><i class="fa-solid fa-angle-down"></i></></a><ul class="desplegableClases"><li><a href="classAsset.php?id='+clases[i]["id_modulo"]+'&c='+clases[i]["codigo_clase"]+'">Estudia<strong>'+clases[i]["cduracion"]+' min</strong></a></li><li><a href="examAsset.php?id='+clases[i]["codigo_examen"]+'">Practica<strong>'+clases[i]["eduracion"]+' min</strong></a></li></ul></li>';
        }
        lecciones.innerHTML = leccion;
    }

    function mostrarClase(clases, id){
        let indiceClase = 0;
        let found = false;
        while((indiceClase < clases.length) && !found){
            if(clases[indiceClase]['codigo_clase'] == id){
                found = true;
            }else{
                indiceClase++;
            }
}

        let clase = document.querySelector("iframe");
        clase.src = clases[indiceClase]['video'];
        document.querySelector(".tituloClase").innerHTML = clases[indiceClase]['nombre'];
       document.querySelector(".contenidoClase").innerHTML = "<p><br>"+clases[indiceClase]['contenido']+"</p><br><a class= 'editarClase' href='classCreator.php?id="+clases[indiceClase]['id_modulo']+"&c="+clases[indiceClase]['codigo_clase']+"' >Editar Clase</a>";

    }

</script>
<main>
    <h5 class="tituloModulo"><?php echo $tituloModulo ?></h5>
    <h1 class="tituloClase"><?php echo $tituloClase ?></h1>
    <aside class="claseContenido">
        <ul class="listaClases">
            <li><a href="<?php echo 'classAssetIntroduction.php?id='.$id?>">Resumen del tema</a></li>
            <li id="lecciones">Lecciones <strong><?php echo $numLecciones?></strong></li>
            <ul class="listaLecciones"></ul>
        </ul>
    </aside>
    <section class="claseContenido">
        <div id="reproductor">
            <iframe width="100%" height="100%" src="<?php echo $fuenteVideo?>"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
        </div>
        <a href="<?php echo 'examAsset.php?id='.$id?>"><button id="testUnidad">Comprueba tus conocimientos</button></a>
        <div class="contenidoClase">
        </div>
    </section>
</main>

<?php include "Includes/footer.php" ?>
</body>
</html>
