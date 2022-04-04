<!doctype html>
<html lang="es">
<?php include "Includes/head.php"?>
<body onload="checkCookie()">
<?php include "Includes/nav.php"?>
<section>

    <div class="container-index">
        <!-- Aquí puedes trabajar, no te metas en el popup-container pls-->



        <!-- Hasta aquí -->
        <div class="popup-container" id="modal_container">
            <div class="modal-popup">
                <h1>Bienvenido a Indomath</h1>
                <p> Esta web utiliza cookies propias y de terceros para mejorar tu experiencia de navegación.
                    Al utilizar nuestra web, aceptas que podemos almacenar y utilizar tus datos personales para
                    mejorar nuestros servicios y para que puedas acceder a contenido más personalizado.
                    Si continua utilizando la página estará aceptando la política e privacidad de esta. <br><a href="terminosYCondiciones.php">Pulse aquí para verlos.</a></p>
                <div class="boton-popup">
                    <a href="#" onclick="cerrar()">Cerrar </a>
                </div>
            </div>
        </div>
   </div>

</section>
<?php include "Includes/footer.php"?>

</body>
</html>