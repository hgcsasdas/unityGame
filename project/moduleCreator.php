<!doctype html>
<html lang="es">
<link rel="stylesheet" href="Css/crearClase.css">
<script src="https://cdn.tiny.cloud/1/xdvnk6dzaz519bjr5uc1teocywbt1optp7hlrn0rodbhump8/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
include "Includes/head.php";
include "Includes/nav.php";
require "php/Modelo/Usuario.php";
require "php/Modelo/classes.bd.php";
require "php/Controlador/Controller.php";
?>
<?php
$controller = new controller();

if (isset($_POST) && !empty($_POST)){

    $fotoURL ="";
    try {
        $path =  'Imgs/cursos/';

        if (move_uploaded_file($_FILES['foto']['tmp_name'],$path.$_FILES['foto']['name'])){

            $fotoURL = $path.$_FILES['foto']['name'];
        }
    }catch (Exception $e) {
            $fotoURL = 'Imgs/cursos/1bach.jpg';
    }
    $_POST['foto']=$fotoURL;

    if ($controller->guardarEnDB("cursos",$_POST)) {
            echo '<div><script type="module">correctRegister()</script></div>';
        } else {
            echo '<div><script type="module">failedRegister()</script></div>';
        }
    }

?>
<body>

<script class="sweetAlertFunctions">
    function correctRegister() {
        Swal.fire({
            icon: 'success',
            title: 'Se ha creado el curso satisfactoriamente!',
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

<section>

    <div class="container-formulario-anadir">
        <form class="rellenar" action="<?php $_SERVER['PHP_SELF']?>" method="post" autocomplete="off" onsubmit="alert(examen.innerText)" enctype="multipart/form-data">
            <ul class="listaFormulario">
                <li><label for="titulo"> Título del curso:</label><input name="titulo" type="text" required></li>
                <li><label for="foto"> Foto del curso:</label><input name="foto" type="file" required></li>
                <li><label for="resumen"> Resumen:</label></li><br>
                <li><textarea name="resumen" class="descripcion"></textarea></li>

                <li><input  class="buttonFormulario" type="submit"></li>
            </ul>

        </form>
    </div>

</section>
<?php include "Includes/footer.php"?>

</body>
</html>