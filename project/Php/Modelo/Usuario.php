<?php

class Usuario{

private $id;
private $nombre;
private $apellido;
private $nickname;
private $mail;
private $edad;
private $curso;
private $docente;

/**
 * @param $id
 * @param $nombre
 * @param $apellido
 * @param $nickname
 * @param $mail
 * @param $edad
 * @param $curso
 * @param $docente
 */
public function __construct($id = "", $nombre = "", $apellido = "", $nickname = "", $mail = "", $edad = "", $curso = "", $docente = "") {
    $this->id = $id;
    $this->nombre = $nombre;
    $this->apellido = $apellido;
    $this->nickname = $nickname;
    $this->mail = $mail;
    $this->edad = $edad;
    $this->curso = $curso;
    $this->docente = $docente;
}
public function llenarDesdeFormulario($nombre = "", $participantes = "", $nota = "") {
    $this->nombre = $nombre;
    $this->participantes = $participantes;
    $this->nota = $nota;

}


public function construirUsuario($datos) {

    foreach ($datos as $clave => $valor) {

        $$clave = addslashes($valor);

    }
    $this->llenarDesdeFormulario($nombre, $participantes, $nota);

}

public function imprimeFila() {

    $txt = "<tr>";
    $txt .= "<td>" . $this->id . "</td>";
    $txt .= "<td>" . $this->nombre . "</td>";
    $txt .= "<td>" . $this->participantes . "</td>";
    $txt .= "<td>" . $this->nota . "</td>";
    $txt .= "<td><a href='altaElementos.php?id=" . $this->id . "'>Editar</a></td>";

    $txt .= "</tr>";

    return $txt;


}


}
?>