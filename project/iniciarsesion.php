<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://js.hcaptcha.com/1/api.js" async defer></script>

<?php
require "php/Modelo/Usuario.php";
require "php/Modelo/class.bd.php";
require "php/Controlador/Controller.php";
?>
<?php
if(isset($_POST) && !empty($_POST)){
    $user = new Usuario();
    $controlador = new Controller();
if($controlador->verificarCaptcha($_POST['h-captcha-response'])) {
    if($controlador->leerEnDB($_POST)){

        echo '<div><script type="module">correctLogin()</script></div>';
    }else{
        echo '<div><script type="module">failedLogin()</script></div>';
    }
}else{
        echo '<script type="module">errorCaptchaImpresion()</script>';

}
}

?>

<html lang="es">
<?php include "Includes/head.php"?>
<script>
    function verificarDatos() {

        let formulario = document.formDatosPersonales;
        let ok = false;

        if (validarVacio(formulario)) {
            ok = true;
        }

        //validar

        if (!ok){
            errorDatos("Llena todos los campos");
        }
        return ok;
    }

    function validarVacio(formulario) {

        let ok = true;
        let cont = 0;
        while (ok === true && cont < formulario.getElementsByTagName('input').length) {

            if (formulario.getElementsByTagName('input')[cont].value === "") {

                ok = false;
            }
            cont++;
        }

        if (formulario.getElementsByTagName('select')[0].value < 1 || formulario.getElementsByTagName('select')[0].value > 5) {
            ok = false;
        }
        return ok;
    }
    function errorCaptchaImpresion() {
        let error = document.getElementById('errorCaptcha');
        error.innerHTML = '<p>Por favor, verifica que no eres un robot.</p>';
    }
</script>
    <script class="sweetAlertFunctions">
        function correctLogin(){
        Swal.fire({
            icon: 'success',
            title: 'HOLA',
            showConfirmButton: false,
            timer: 1500
        });
    }

        function failedLogin(){
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Usuario o contraseña incorrecta!'
        });
    }

        function errorDatos(problema){
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: problema
        });
    }

</script>
<body>
<?php include "Includes/nav.php"?>
<div class="contenedor">
    <div class="logoIni">
        <img src="Imgs/logo.jpeg" alt="">
    </div>
    <div class="tituloRegis">
        <h1>Inicia sesión</h1>
        <p>Volver al inicio <a href="index.php">aqui</a></p>
    </div>

    <div class="formulario">

        <form name="formDatosPersonales" action="#" target="" onsubmit="return verificarDatos();" method="post" enctype="application/x-www-form-urlencoded">

            <label for="mail">Correo electrónico: </label><input name="mail" id="mail" required type="email" placeholder="Mail">
            <label for="contrasena">Contraseña: </label><input name="contrasena" id="contrasena" required type="password" minlength="8" placeholder="Contraseña">
            <div id="errorCaptcha"></div>
            <div class="h-captcha" id="captcha" data-sitekey="eb2c600f-ee5c-40b1-a0cb-26e2a0c4da53" ></div>
            <input type="submit" value="Enviar datos"/>

        </form>
    </div>
    <div class="textoRegis">
        <p>¿No tienes cuenta? <a class="iniEnlace" href="registrar.php">Registrarse</a></p>
    </div>

</div>

<?php include "Includes/footer.php"?>
</body>
</html>
