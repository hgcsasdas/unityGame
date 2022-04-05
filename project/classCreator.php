<!doctype html>
<html lang="es">
<link rel="stylesheet" href="Css/crearClase.css">
<script src="https://cdn.tiny.cloud/1/xdvnk6dzaz519bjr5uc1teocywbt1optp7hlrn0rodbhump8/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

$modulos =  $controller->leerEnDB("modules", "");
    echo "<script type='module'>mostrarModulos($modulos)</script>";

if (isset($_POST) && !empty($_POST)){
    if ($controller->guardarEnDB("classes",$_POST)) {
            echo '<div><script type="module">correctRegister()</script></div>';
        } else {
            echo '<div><script type="module">failedRegister()</script></div>';
        }
    }
if(isset($_GET) && !empty($_GET)){
    $datos =  ($controller->leerEnDB("classes2", $_GET));

    echo "<script type='module'>llenarDatos(".$_GET['c'].", ".$datos.");</script>";
}

?>
<body>
<script>
    function llenarDatos(id, clase){

        let indiceClase=0;
        for (let i=0;i<clase.length;i++){
            if(clase[i]['codigo_clase']==id){
                indiceClase=i;
            }
        }

        let leccion = clase[indiceClase];
        let leccionArray = new Array();
        console.log(leccion);

        for(let i in leccion){
            leccionArray.push(leccion[i]);
        }
        console.log(leccionArray);
        let campos = document.getElementsByTagName("input");
        let modulo = document.getElementsByTagName("select");
        let desc = document.getElementsByTagName("textarea")
        // nombre: input, video: input, duracion: input, examen: input, duracionEx: input]
        campos[0].value =leccionArray[3];
        modulo[0].value =leccionArray[1];
        campos[1].value =leccionArray[10];
        campos[2].value =leccionArray[5];
        campos[3].value =leccionArray[9];
        campos[4].value =leccionArray[6];
        desc[0].value =leccionArray[11];

    }
</script>
<script class="sweetAlertFunctions">
    function correctRegister() {
        Swal.fire({
            icon: 'success',
            title: 'Se ha creado la clase satisfactoriamente!',
            showConfirmButton: false,
            timer: 1500
        });
    }

    function failedRegister() {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Ha habido un error, intentalo de nuevo!'
        });
    }

</script>
<script class="textArea-Tiny" type="text/javascript">
    tinymce.init({
        selector: '.descripcion',
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
        let option = document.createElement("option");
        let personalizeOption = document.createTextNode("Seleccione un curso");
        option.value="0";
        option.disabled=true;
        option.setAttribute("selected","selected"); //para que se seleccione por defecto
        option.appendChild(personalizeOption);
        modulos.appendChild(option);
        for (let i=0;i<cursos.length;i++){
            let option = document.createElement("option");
            let personalizeOption = document.createTextNode(cursos[i]["titulo"]);
            option.value=cursos[i]["id_modulo"];
            option.appendChild(personalizeOption);
            modulos.appendChild(option);
        }
    }
</script>

<section>

    <div class="container-formulario-anadir">
        <form class="rellenar" action="<?php $_SERVER['PHP_SELF']?>" method="post" autocomplete="off" onsubmit="alert(examen.innerText)">
            <ul class="listaFormulario">
                <li><label for="nombre"> Título de la clase:</label><input name="nombre" type="text" required></li>
                <li><label for="codigo_modulo"> Módulo de la clase:</label><select name="codigo_modulo" id="modulo" required></select></li>
                <li><label for="video"> Link del vídeo:</label><input name="video" type="text" required></li>
                <li><label for="duracion"> Tiempo estimado leccion:</label><input name="duracion" type="number" min="1" required> Minutos</li>
                <li><label for="examen"> Link del examen:</label><input name="examen" type="text" required></li>
                <li><label for="duracionEx"> Tiempo estimado examen:</label><input name="duracionEx" type="number" min="1" required> Minutos</li>
                <li><label for="contenido"> Descripción:</label></li><br>
                <li><textarea name="contenido" class="descripcion"></textarea></li>

                <li><input  class="buttonFormulario" type="submit"></li>
            </ul>

        </form>
    </div>

</section>
<?php include "Includes/footer.php"?>

</body>
</html>