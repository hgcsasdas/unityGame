<?php

abstract class Bd{

    protected $server = "localhost:3360";
    protected $usuario = "root";
    protected $pass = "1234";
    protected $basedatos = "indomath";

    protected $conexion;


    public function __construct(){

        $this->conexion = new mysqli($this->server, $this->usuario, $this->pass, $this->basedatos);
        $this->conexion->select_db($this->basedatos);
        $this->conexion->query("SET NAMES 'utf8'");
    }

}
?>