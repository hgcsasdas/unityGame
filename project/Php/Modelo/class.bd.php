<?php

class Bd{

    private $server = "localhost:3360";
    private $usuario = "root";
    private $pass = "1234";
    private $basedatos = "indomath";

    private $conexion;
    private $resultado;


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

        $registroExitoso = true;
        $campoEmail = 3;
        $contadorCampos=0;
        $claves  = array();
        $valores = array();

        foreach ($datos as $clave => $valor){

            if($clave != "id" && $clave != "confirmacion") {
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
            $sql = "insert into users (" . implode(',', $claves) . ") 
            values  (" . implode(',', $valores) . ")";
            $this->resultado = $this->conexion->query($sql);

        }else{
            $registroExitoso=false;
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
        $this->resultado =   $this->conexion->query($consulta);

        $res = mysqli_fetch_assoc($this->resultado);

        return $res;
    }


    public function consultarUsuarios($datos){
        $tabla = "users";
        $validadoCorrecto = 0;
        foreach ($datos as $clave => $valor){
            $$clave = $valor;
        }
        $sql = 'select contrasena from '.$tabla.' where mail = "' . $mail.'"';
        $this->resultado =   $this->conexion->query($sql);
        try {
            $pass = implode(mysqli_fetch_assoc($this->resultado));
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
        $sql  = 'select upper(m.titulo) as titulo, c.nombre, (select count(*) from ' . $tabla . ' as c join modules m on c.codigo_modulo = m.id_modulo where c.codigo_modulo = m.id_modulo) as "numLecciones", c.duracion as cduracion, e.duracion as eduracion, c.video, c.contenido from ' . $tabla . ' as c join modules m on c.codigo_modulo = m.id_modulo join exam e on e.cod_examen = c.codigo_examen where codigo_modulo=' . $codigoModulo ;
        $data = $this->conexion->query($sql);

        $dataarray = (mysqli_fetch_assoc($data));

        return $dataarray;

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
        $this->resultado =   $this->conexion->query($consulta);
        $res = $this->resultado ;
        return $res;
    }


}
?>