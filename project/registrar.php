<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://js.hcaptcha.com/1/api.js" async defer></script>

<?php
require "php/Modelo/Usuario.php";
require "php/Modelo/class.bd.php";
require "php/Controlador/Controller.php";

?>
<?php

$controlador = new Controller();
$modulos =  $controlador->leerEnDB("modules", "clases");

echo "<script type='module'>mostrarModulos($modulos)</script>";
?>
<?php
if (isset($_POST) && !empty($_POST)) {
    $user = new Usuario();
    $controlador = new Controller();
    if ($controlador->verificarCaptcha($_POST['h-captcha-response'])) {
        if ($controlador->guardarEnDB("users",$_POST)) {
            echo '<div><script type="module">correctRegister()</script></div>';
        } else {
            echo '<div><script type="module">failedRegister()</script></div>';
        }
    } else {
        echo '<script type="module">errorCaptchaImpresion()</script>';

    }
}

?>
<!doctype html>
<html lang="es">
<?php include "Includes/head.php" ?>
<script class="mostrarModulos">
    //import {mostrarModulos} from "./js/mostrarModulos.js"; intentar en otros modulos
    //mostrarModulos();
    function mostrarModulos(cursos){
        let modulos = document.querySelector("#curso");
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
            let personalizeOption = document.createTextNode(cursos[i]["titulo"]);
            option.value=cursos[i]["id_modulo"];
            option.appendChild(personalizeOption);
            modulos.appendChild(option);
        }
    }
</script>
<script class="sweetAlertFunctions">
    function correctRegister() {
        Swal.fire({
            icon: 'success',
            title: 'Te has registrado satisfactoriamente!',
            showConfirmButton: false,
            timer: 1500
        });
    }

    function failedRegister() {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Ya te encuentras registrado en nuestro sistema!'
        });
    }

</script>
<script>
    function verificarDatos() {

        let formulario = document.formDatosPersonales;
        let ok = false;

        if (validarVacio(formulario) && validarContrasena()) {
            ok = true;
        }

        //validar

        if (!ok){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ha habido un problema, intenta de nuevo!'
            })
        }
        return ok;
    }

    function validarVacio(formulario) {

        let ok = true;
        let cont = 0;
        while (ok === true && cont < formulario.getElementsByTagName('input').length) {

            if (formulario.getElementsByTagName('input')[cont].value === "") {
                ok = false;
                alert("Te faltan campos por rellenar")
            }
            cont++;
        }
        if (formulario.getElementsByTagName('select')[0].value < 1 || formulario.getElementsByTagName('select')[0].value > 5) {
            ok = false;
        }
        return ok;
    }

    function validarContrasena() {
        let match = false;
        if (document.getElementById('contrasena').value === document.getElementById('confirmacion').value) {
            match = true;
        }
        return match;
    }
    function errorCaptchaImpresion() {
        let error = document.getElementById('errorCaptcha');
        error.innerHTML = '<p>Por favor, verifica que no eres un robot.</p>';
    }

</script>
<!doctype html>
<html lang="es">
<?php include "Includes/head.php" ?>
<body>
<?php include "Includes/nav.php" ?>

<section>
    <div class="contenedor">
        <div class="logoIni">
            <img src="Imgs/logo.jpeg" alt="">
        </div>
        <div class="tituloRegis">
            <h1>Registrate gratis</h1>
            <p>Volver al inicio <a href="index.php">aqui</a></p>
        </div>
        <form name="formDatosPersonales" action="<?PHP $_SERVER['PHP_SELF'] ?>" onsubmit="return verificarDatos();" method="post" enctype="application/x-www-form-urlencoded">
            <label for="nombre">Nombre: </label><input name="nombre" id="nombre" type="text" maxlength="20" placeholder="Nombre">
            <label for="apellido">Apellido: </label><input name="apellido" id="apellido" type="text" maxlength="20" placeholder="Apellidos">
            <label for="nickname">Nickname: </label><input name="nickname" id="nickname" type="text" maxlength="20" placeholder="Nickname">
            <label for="mail">Correo electrónico: </label><input name="mail" id="mail" type="email" placeholder="Mail">
            <label for="contrasena">Contraseña: </label><input name="contrasena" id="contrasena" type="password" minlength="8" placeholder="Contraseña">
            <label for="confirmacion">Confirma la contraseña: </label><input name="confirmacion" id="confirmacion" type="password" minlength="8" placeholder="Contraseña">
            <label for="edad">Edad: </label><input name="edad" id="edad" type="number" placeholder="15" min="15">
            <label for="curso">Matemáticas que estás estudiando: </label><select name="curso" id="curso"></select>
            <div id="errorCaptcha"></div>
            <div class="h-captcha" id="captcha" data-sitekey="eb2c600f-ee5c-40b1-a0cb-26e2a0c4da53" ></div>
            <input type="submit" value="Enviar datos"/>
        </form>

        <div class="textoRegis">
            <p>¿Tienes ya cuenta? <a class="iniEnlace" href="iniciarsesion.php">Iniciar sesion</a></p>
        </div>
    </div>
</section>
<?php include "Includes/footer.php" ?>
</body>
</html>