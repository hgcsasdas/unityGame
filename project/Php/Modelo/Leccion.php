<?php

class Leccion{

    private $codigo_clase;
    private $nombre;
    private $autor;
    private $duracion;
    private $nivel;
    private $contenido;
    private $video;
    private $codigo_examen;

    /**
     * @param $codigo_clase
     * @param $nombre
     * @param $autor
     * @param $duracion
     * @param $nivel
     * @param $contenido
     * @param $video
     * @param $codigo_examen
     */
    public function __construct($codigo_clase="", $nombre="", $autor="", $duracion="", $nivel="", $contenido="", $video="", $codigo_examen="") {
        $this->codigo_clase = $codigo_clase;
        $this->nombre = $nombre;
        $this->autor = $autor;
        $this->duracion = $duracion;
        $this->nivel = $nivel;
        $this->contenido = $contenido;
        $this->video = $video;
        $this->codigo_examen = $codigo_examen;
    }

    public function llenarConDatos($nombre, $autor, $duracion, $nivel, $contenido, $video, $codigo_examen) {
        $this->nombre = $nombre;
        $this->autor = $autor;
        $this->duracion = $duracion;
        $this->nivel = $nivel;
        $this->contenido = $contenido;
        $this->video = $video;
        $this->codigo_examen = $codigo_examen;
    }

    /**
     * @return mixed
     */
    public function getCodigoClase() {
        return $this->codigo_clase;
    }

    /**
     * @param mixed $codigo_clase
     */
    public function setCodigoClase($codigo_clase): void {
        $this->codigo_clase = $codigo_clase;
    }

    /**
     * @return mixed
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getAutor() {
        return $this->autor;
    }

    /**
     * @param mixed $autor
     */
    public function setAutor($autor): void {
        $this->autor = $autor;
    }

    /**
     * @return mixed
     */
    public function getDuracion() {
        return $this->duracion;
    }

    /**
     * @param mixed $duracion
     */
    public function setDuracion($duracion): void {
        $this->duracion = $duracion;
    }

    /**
     * @return mixed
     */
    public function getNivel() {
        return $this->nivel;
    }

    /**
     * @param mixed $nivel
     */
    public function setNivel($nivel): void {
        $this->nivel = $nivel;
    }

    /**
     * @return mixed
     */
    public function getContenido() {
        return $this->contenido;
    }

    /**
     * @param mixed $contenido
     */
    public function setContenido($contenido): void {
        $this->contenido = $contenido;
    }

    /**
     * @return mixed
     */
    public function getVideo() {
        return $this->video;
    }

    /**
     * @param mixed $video
     */
    public function setVideo($video): void {
        $this->video = $video;
    }

    /**
     * @return mixed
     */
    public function getCodigoExamen() {
        return $this->codigo_examen;
    }

    /**
     * @param mixed $codigo_examen
     */
    public function setCodigoExamen($codigo_examen): void {
        $this->codigo_examen = $codigo_examen;
    }




}
?>