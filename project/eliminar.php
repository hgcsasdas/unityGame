<?php
require "Php/Controlador/Controller.php";
require "php/Modelo/classes.bd.php";
$controller = new controller();
if(isset($_GET) && !empty($_GET)){
    if ($controller->eliminarEnDB("classes",$_GET)) {
        echo '<div><script type="module">correctRegister()</script></div>';
       header("Location: modulos.php");
    } else {
        echo '<div><script type="module">failedRegister()</script></div>';
       header("Location: classCreator.php?id=" . $_GET['id_modulo'] . "&c=" . $_GET['codigo_clase'], false);

    }
}
?>
<script>
    function correctRegister(){
        Swal.fire(
            'Eliminada!',
            'La clase ha sido eliminada satisfactoriamente.',
            'success'
        );
    }
    function failedRegister() {
        Swal.fire(
            icon: 'error',
            title: 'Oops...',
            text: 'Ha habido un error, intentalo de nuevo!'
        );
    }
</script>
