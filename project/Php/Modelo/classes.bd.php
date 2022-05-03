<?php
require_once "bd.php";
class BdClasses extends Bd {


    public function __construct() {
        parent::__construct();
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
    public function actualizarClases($datos){

            $registroExitoso = 1;
            $idExamen = "";
            $idLeccion = "";
            $clavesLeccion = [];
            $clavesExamen = [];
            $valoresLeccion = [];
            $valoresExamen = [];

            foreach ($datos as $clave => $valor){
                    if($clave == "id"){
                            $clavesExamen[] = addslashes("cod_examen");
                        }else if($clave == "duracionEx"){
                            $clavesExamen[] =  addslashes("duracion");
                        }else if($clave == "examen"){
                            $clavesExamen[] =  addslashes("contenido");
                        }else {
                        $clavesLeccion[] = addslashes($clave);
                    }
                    if ($clave == "video") {
                        $valorRespaldo = $valor;
                        try {
                            if(isset(explode("=", $valor)[1]) && explode("=", $valor)[1] != ""){
                                $urlFragmentos = explode("&", explode("=", $valor)[1]);
                                $valor = "https://www.youtube.com/embed/" . $urlFragmentos[0];
                            }else{
                                $valor = $valorRespaldo;
                            }
                        } catch (TypeError $te) {
                            $valor = $valorRespaldo;
                        }
                    }
                    if ($clave == "examen") {
                        $valorRespaldo = $valor;
                        $urlFragmentos = explode("worksheet", explode('" style="width:100 % ">', $valor)[0]);
                        if(isset(explode("span>", $valor)[1]) && explode("span>", $valor)[1] != ""){
                        $urlFragmentos2 = explode("span>", $valor)[1];
                        $urlIdExamen = explode('" style="', $urlFragmentos[1])[0];
                        $valor = $urlFragmentos[0] . 'worksheet' . $urlIdExamen . '"> ' . $urlFragmentos2;
                        $valor = str_replace("'", '"', $valor);

                    }else{
                        $valor = $valorRespaldo;
                    }
                    }
                    if ($clave == "id" || $clave== "duracionEx" || $clave == "examen") {
                        $valoresExamen[] = ("'" . addslashes($valor) . "'");
                        if($clave == "examen"){
                            $idExamen = $valor;
                        }
                    } else {
                        if($clave == "codigo_clase"){
                            $idLeccion = $valor;
                        }
                    $valoresLeccion[] = ("'" . addslashes($valor) . "'");
                }
                }

        $sqlExamenes = "update exam set ";
        $sqlLecciones = "update classes set ";
        for ($i = 0; $i < sizeof($clavesLeccion); $i++) {
            if ($i == sizeof($clavesLeccion) - 1) {
                $sqlLecciones .= " where " . $clavesLeccion[$i] . " = " . $valoresLeccion[$i];
            } else {
                if ($i != 0) {
                    $sqlLecciones .= ", ";
                }
                $sqlLecciones .= $clavesLeccion[$i] . " = " . $valoresLeccion[$i];
            }
        }

        for ($i = 0; $i < sizeof($clavesExamen); $i++) {
            if ($i == sizeof($clavesExamen) - 1) {
                $sqlExamenes .= " where " . $clavesExamen[$i] . " = " . $valoresExamen[$i];
            } else {
                if ($i != 0) {
                    $sqlExamenes .= ", ";
                }
                $sqlExamenes .= $clavesExamen[$i] . " = " . $valoresExamen[$i];
            }
        }

        $resultado = $this->conexion->query($sqlExamenes);
        $resultado2 = $this->conexion->query($sqlLecciones);


        if ($resultado < 0 || $resultado2 < 0) {
            $registroExitoso = 0;
        } else {
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


}
?>