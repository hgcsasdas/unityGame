<!doctype html>
<html lang="es">
<?php include "Includes/head.php"?>
<body onload="checkCookie()">
<?php include "Includes/nav.php"?>
<section class="body">
    <div class="img-slider">
        <div class="slide active">
            <img src="Imgs/Imagen3.png" alt="">
            <div class="info">
                <h2>INDOMATH</h2>
                <p>No creemos en tus limites, vamos más allá,</p>
            </div>
        </div>
        <div class="slide">
            <img src="Imgs/Imagen6.png" alt="">
            <div class="info">
                <h2>INDOMATH</h2>
                <p>Entrega siempre más de lo que se espera de ti.</p>
            </div>
        </div>
        <div class="slide">
            <img src="Imgs/Imagen5.png" alt="">
            <div class="info">
                <h2>INDOMATH</h2>
                <p>Busca tu mejor profesor con nosotros.</p>
            </div>
        </div>
        <div class="slide">
            <img src="Imgs/Imagen4.png" alt="">
            <div class="info">
                <h2>INDOMATH</h2>
                <p>Entrega siempre más de lo que se espera de ti.</p>
            </div>
        </div>
        <div class="slide">
            <img src="Imgs/Imagen3.png" alt="">
            <div class="info">
                <h2>INDOMATH</h2>
                <p>Si puedes soñarlo, puedes hacerlo.</p>
            </div>
        </div>
        <div class="navigation">
            <div class="btn active"></div>
            <div class="btn"></div>
            <div class="btn"></div>
            <div class="btn"></div>
            <div class="btn"></div>
        </div>
    </div>
    <script type="text/javascript">
        var slides = document.querySelectorAll('.slide');
        var btns = document.querySelectorAll('.btn');
        let currentSlide = 1;

        // Javascript for image slider manual navigation
        var manualNav = function(manual){
            slides.forEach((slide) => {
                slide.classList.remove('active');

                btns.forEach((btn) => {
                    btn.classList.remove('active');
                });
            });

            slides[manual].classList.add('active');
            btns[manual].classList.add('active');
        }

        btns.forEach((btn, i) => {
            btn.addEventListener("click", () => {
                manualNav(i);
                currentSlide = i;
            });
        });

        // Javascript for image slider autoplay navigation
        var repeat = function(activeClass){
            let active = document.getElementsByClassName('active');
            let i = 1;

            var repeater = () => {
                setTimeout(function(){
                    [...active].forEach((activeSlide) => {
                        activeSlide.classList.remove('active');
                    });

                    slides[i].classList.add('active');
                    btns[i].classList.add('active');
                    i++;

                    if(slides.length == i){
                        i = 0;
                    }
                    if(i >= slides.length){
                        return;
                    }
                    repeater();
                }, 10000);
            }
            repeater();
        }
        repeat();
    </script></section>
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


<?php include "Includes/footer.php"?>

</body>
</html>