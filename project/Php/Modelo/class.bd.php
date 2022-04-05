<?php

class Bd{

    private $server = "localhost:3360";
    private $usuario = "root";
    private $pass = "1234";
    private $basedatos = "indomath";

    private $conexion;


    public function __construct(){

        $this->conexion = new mysqli($this->server, $this->usuario, $this->pass, $this->basedatos);
        $this->conexion->select_db($this->basedatos);
        $this->conexion->query("SET NAMES 'utf8'");
    }

    /**
     * Metodo que lanza un insert a la BD con la posibilidad de incluir una foto.
     * Para que funcione, deben llamarse igual los campos del formulario y los atributos de la bd
     */

    public function insertarUsuarios($datos){

        $registroExitoso = 1;
        $campoEmail = 3;
        $contadorCampos=0;
        $claves  = array();
        $valores = array();
        foreach ($datos as $clave => $valor){

            if($clave != "id" && $clave != "confirmacion" && $clave != "h-captcha-response" && $clave != "g-recaptcha-response") {
                $claves[] = addslashes($clave);
                if($clave == "mail") {
                    $campoEmail=$contadorCampos;
                }
                    if($clave != "contrasena") {
                    $valores[] = ("'" . addslashes($valor) . "'");
                }else{
                    $valores[] = ("'" . $this->asignarContrasena($valor) . "'");
                }
            }
            $contadorCampos++;
        }

        if($this->verificarUsuario($valores[$campoEmail])==0) {
            $sql = "insert into users (" . implode(', ', $claves) . ") values (" . implode(', ', $valores) . ")";
            $resultado = $this->conexion->query($sql);
        }else{
            $registroExitoso=0;
        }

        return $registroExitoso;
    }

    public function verificarUsuario($email){
        $userExistente = 0;
        $existeEmail = 'select * from users where mail = ' . $email;
        $result = $this->conexion->query($existeEmail)->num_rows;
        if ($result != 0){
            $userExistente = 1;
        }
        return $userExistente;
    }

    public function asignarContrasena($contrasena){
        return password_hash($contrasena, PASSWORD_DEFAULT);
    }



    public function consultaSimple($consulta){
        //echo "el sql".$consulta ."fin";
        $resultado =   $this->conexion->query($consulta);

        $res = mysqli_fetch_assoc($resultado);

        return $res;
    }


    public function consultarUsuarios($datos){
        $tabla = "users";
        $validadoCorrecto = 0;
        foreach ($datos as $clave => $valor){
            $$clave = $valor;
        }
        $sql = 'select contrasena from '.$tabla.' where mail = "' . $mail.'"';
        $resultado =   $this->conexion->query($sql);
        try {
            $pass = implode(mysqli_fetch_assoc($resultado));
            if (password_verify($contrasena, $pass)) {
                $validadoCorrecto = 1;
            }
        }catch (TypeError $te){
            $validadoCorrecto = 0;
        }
        return $validadoCorrecto;
    }
  
    public function consultarClases($datos){
        $tabla = "classes";

        $codigoModulo = $datos['id'];
        $sql  = 'select m.id_modulo, upper(m.titulo) as titulo, c.nombre, m.resumen, (select count(*) from ' . $tabla . ' as c join modules m on c.codigo_modulo = '.$codigoModulo.' where c.codigo_modulo = m.id_modulo) as "numLecciones", c.duracion as cduracion, e.duracion as eduracion, e.contenido as examenURL, c.video, c.contenido from ' . $tabla . ' as c join modules m on c.codigo_modulo = m.id_modulo join exam e on e.cod_examen = c.codigo_examen where codigo_modulo=' . $codigoModulo ;
        $data = $this->conexion->query($sql);
        $dataarray = (mysqli_fetch_assoc($data));
        return $dataarray;
    }


    public function listarClases($datos){
        $tabla = "classes";

        $codigoModulo = $datos['id'];
        $sql  = 'select c.codigo_clase, m.id_modulo, upper(m.titulo) as titulo, c.nombre, m.resumen, (select count(*) from ' . $tabla . ' as c join modules m on c.codigo_modulo = '.$codigoModulo.' where c.codigo_modulo = m.id_modulo) as "numLecciones", c.duracion as cduracion, c.codigo_examen, e.duracion as eduracion, e.contenido as examenURL, c.video, c.contenido from ' . $tabla . ' as c join modules m on c.codigo_modulo = m.id_modulo join exam e on e.cod_examen = c.codigo_examen where codigo_modulo=' . $codigoModulo ;
        $data = $this->conexion->query($sql);
        $clases=array();
        while($row = mysqli_fetch_assoc($data)){
            $clases[] = $row;
        }
        $lecciones = json_encode($clases);

        return $lecciones;

    }

    public function insertarClases($datos){

            $registroExitoso = 1;
            $campoExamen = "";
            $clavesLeccion  = [addslashes("codigo_examen"), addslashes("codigo_profesor"), addslashes("codigo_alumno")];
            $clavesExamen  = [addslashes("id_profesor"), addslashes("id_alumno")];
            $valoresLeccion = [addslashes("1"),addslashes("1")];
            $valoresExamen = [addslashes("1"),addslashes("1")];
            foreach ($datos as $clave => $valor){

                if ($clave != "id") {
                    if ($clave == "duracionEx" || $clave == "examen") {
                        if($clave == "examen"){
                            $clavesExamen[] = addslashes("contenido");
                        }else{
                            $clavesExamen[] =  addslashes("duracion");
                        }
                    }else {
                        $clavesLeccion[] = addslashes($clave);
                    }
                    if ($clave == "video") {
                        try {
                            $urlFragmentos = explode("&", explode("=", $valor)[1]);
                            $valor = "https://www.youtube.com/embed/" . $urlFragmentos[0];
                        } catch (TypeError $te) {
                            $valor = "https://www.youtube.com/embed/xoidoibP1Qs";
                        }
                    }
                    if ($clave == "examen") {
                        $urlFragmentos = explode("worksheet", explode('" style="width:100 % ">', $valor)[0]);
                        $urlFragmentos2 = explode("span>", $valor)[1];
                        $urlIdExamen = explode('" style="', $urlFragmentos[1])[0];
                        $valor = $urlFragmentos[0] . 'worksheet' . $urlIdExamen . '"> ' . $urlFragmentos2;
                        $valor = str_replace("'", '"', $valor);
                        $campoExamen = $valor;
                    }
                    if ($clave == "duracionEx" || $clave == "examen") {

                        $valoresExamen[] = ("'" . addslashes($valor) . "'");
                    } else {
                    $valoresLeccion[] = ("'" . addslashes($valor) . "'");
                }
                }
            }

                $sqlExamenes = "insert into exam (" . implode(', ', $clavesExamen) . ") values (" . implode(', ', $valoresExamen) . ")";
                $resultado = $this->conexion->query($sqlExamenes);
                $sqlCodigoExamen = 'select cod_examen from exam where cod_examen = (select count(*) from exam)';
                $codigoExamen = $this->conexion->query($sqlCodigoExamen);
                $sqlLecciones = "insert into classes (" . implode(', ', $clavesLeccion) . ") values (" . implode(mysqli_fetch_assoc($codigoExamen)).', '. implode(', ', $valoresLeccion) . ")";
                $resultado2 = $this->conexion->query($sqlLecciones);

                if($resultado<0 || $resultado2<0){
                    $registroExitoso = 0;
                }else{
                    $registroExitoso = 1;
                }

            return $registroExitoso;
        }

    public function listarCursos(){
        $tabla = "modules";
        $sql  = 'select * from ' . $tabla;
        $data = $this->conexion->query($sql);
        $curses=array();
        while($row = mysqli_fetch_assoc($data)){
            $curses[] = $row;
        }
        $modules = json_encode($curses);
        return $modules;

    }

    public function insertarCursos($datos){
            $registroExitoso = 1;
            $claves  = [addslashes("id_profesor")];
            $valores = [addslashes("1")];

            foreach ($datos as $clave => $valor){
                if ($clave != "id") {
                    $claves[] = addslashes($clave);
                    $valores[] = ("'" . addslashes($valor) . "'");

                }
            }

                $sql = "insert into modules (" . implode(', ', $claves) . ") values (" . implode(', ', $valores) . ")";
                $resultado = $this->conexion->query($sql);
                if($resultado<0){
                    $registroExitoso = 0;
                }

            return $registroExitoso;
        }


    public function consultarModulos($datos){
        $sql = 'select id_modulo, titulo from modules';
        $data = $this->conexion->query($sql);
        $modulos =[];
        $valores =[];
        while($row = mysqli_fetch_array($data)) {
            array_push($modulos,$row[0]);
            array_push($valores,$row[1]);
        }
        $courses=[];
        for($i = 0;$i<sizeof($modulos);$i++){
            array_push($courses,array("id" => $modulos[$i], "name"=>$valores[$i]));

        }
        return $courses;

    }

    public function consulta($consulta){
        $resultado =   $this->conexion->query($consulta);
        $res = $resultado ;
        return $res;
    }


}
?>