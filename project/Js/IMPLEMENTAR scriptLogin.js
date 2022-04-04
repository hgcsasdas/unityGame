import "//cdn.jsdelivr.net/npm/sweetalert2@11";

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
//sweetAlertFunctions

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

