<?php

 class controller{


     public function guardarEnDB($tabla, $datos) {
         $exito = 0;
         $conexion = new Bd();
         if ($tabla == "users") {
             $exito = $conexion->insertarUsuarios($datos);
         }elseif ($tabla == "classes") {
             $exito = $conexion->insertarClases($datos);
         }elseif ($tabla == "cursos") {
             $exito = $conexion->insertarCursos($datos);
         }
         return $exito;
     }

     public function leerEnDB($tabla, $datos) {
         $exito = false;
         $conexion = new Bd();
         if ($tabla == "users") {
             $exito = $conexion->consultarUsuarios($datos);
         }elseif ($tabla == "classes") {
             $exito = $conexion->consultarClases($datos);
         }elseif ($tabla == "classes2") {
             $exito = $conexion->listarClases($datos);
         }elseif ($tabla == "modules"){
             $exito = $conexion->listarCursos();
         }

         return $exito;
     }



    public function verificarCaptcha($captcha) {
        $privatekey = "0xB5ba8764f740eb8631D4652cd5363a15fbdA5e96";

        $data = array(
            'secret' => $privatekey,
            'response' => $captcha
        );
        $verify = curl_init();
        curl_setopt($verify, CURLOPT_URL, "https://hcaptcha.com/siteverify");
        curl_setopt($verify, CURLOPT_POST, true);
        curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($verify);
        $responseData = json_decode($response);


        return $responseData->success;
    }
}


?>