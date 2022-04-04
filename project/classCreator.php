<!doctype html>
<html lang="es">
<link rel="stylesheet" href="Css/crearClase.css">
<script src="https://cdn.tiny.cloud/1/xdvnk6dzaz519bjr5uc1teocywbt1optp7hlrn0rodbhump8/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<?php
include "Includes/head.php";
include "Includes/nav.php";
require "php/Modelo/Usuario.php";
require "php/Modelo/class.bd.php";
require "php/Controlador/Controller.php";
?>
<?php
//poner cursos en mayusculas
$controller = new controller();

$modulos =  $controller->leerEnDB("modules", "clases");

$clasesOfrecidas= json_encode($modulos);
    echo "<script type='module'>mostrarModulos($clasesOfrecidas)</script>";
?>
<body>

<script class="textArea-Tiny" type="text/javascript">
    tinymce.init({
        selector: '.contenido',
        language: 'es',
        plugins: 'casechange export formatpainter lists checklist permanentpen export pagebreak code emoticons image table paste lists advlist checklist link hr charmap directionality',
        toolbar: 'undo | redo | formatselect | fontselect | fontsizeselect | casechange | bold | italic | underline | strikethrough | forecolor | backcolor | subscript | superscript | bullist | numlist | aligncenter | alignleft | alignright | alignjustify | outdent | indent | export | formatpainter | emoticons | link | charmap',
        toolbar_mode: 'floating',
        statusbar: false,
        browser_spellcheck: true,
        contextmenu: false,
        menubar:false,

    });
</script>
<script class="mostrarModulos">
    //import {mostrarModulos} from "./js/mostrarModulos.js"; intentar en otros modulos
    //mostrarModulos();
    function mostrarModulos(cursos){
    let modulos = document.querySelector("#modulo");
    console.log(cursos);
        let option = document.createElement("option");
        let personalizeOption = document.createTextNode("Seleccione un curso");
        option.value="0";
        option.disabled=true;
        option.setAttribute("selected","selected"); //para que se seleccione por defecto
        option.appendChild(personalizeOption);
        modulos.appendChild(option);
        for (let i=0;i<cursos.length;i++){
            let option = document.createElement("option");
            let personalizeOption = document.createTextNode(cursos[i].name);
            option.value=cursos[i].id;
            option.appendChild(personalizeOption);
            modulos.appendChild(option);
        }
    }
</script>
<script> //CORREGIR
    let contador=0;
    function agregarLeccion(){
        let leccionNueva = "<label for='leccion"+contador+"'>Nombre: </label><input class='leccion"+contador+"' name='leccion"+contador+"' required type='text'>";
        let eliminarLeccionLink = '<a onclick="EliminarLeccion()">Eliminar lección</a>';
        document.getElementById("agregarLecciones").innerHTML+=leccionNueva;
        contador++;
        if(contador==1){
            document.getElementById("opcionesLeccion").innerHTML+=eliminarLeccionLink;
        }
    }
    function EliminarLeccion(){
        if(contador>0) {
            let lecciones = Array.from(document.getElementsByClassName("leccion" + contador));
            let agregarLeccionLink = '<a onclick="agregarLeccion()">Insertar una lección</a>';
            let leccionesFinales = lecciones.slice(0, lecciones.length-1);
            console.log(lecciones);
            document.getElementById("agregarLecciones").innerHTML = leccionesFinales.join('');
            contador--;
            if (contador == 0) {
                document.getElementById("opcionesLeccion").innerHTML = agregarLeccionLink;
            }
        }
    }
</script>

<?php
if (isset($_POST) && !empty($_POST)){

    $controller = new controller();

}
?>

<section>

    <div class="container-formulario-anadir">
        <form class="rellenar" action="<?php $_SERVER['PHP_SELF']?>" method="post" submit="return false;">
            <ul class="listaFormulario">
                <li><label for="titulo"> Título de la clase:</label><input name="titulo" type="text"></li>
                <li><label for="modulo"> Módulo de la clase:</label><select name="modulo" id="modulo"></select></li>
                <li><label for="video"> Link del vídeo:</label><input name="video" type="text"></li>
                <li><label for="duracion"> Tiempo estimado:</label><input name="duracion" type="number"> Minutos</li>
                <li><label for="descripcion"> Descripción:</label></li><br>
                <li><textarea name="descripcion" class="contenido"></textarea></li>

                <li><input  class="buttonFormulario" type="submit"></li>
            </ul>
                <!-- <div id="opcionesLeccion">
                            <a onclick="agregarLeccion()">Insertar una lección</a>


                        <div id="agregarLecciones">

                        </div>
                        </div>-->

        </form>
    </div>

</section>
<?php include "Includes/footer.php"?>

</body>
</html>