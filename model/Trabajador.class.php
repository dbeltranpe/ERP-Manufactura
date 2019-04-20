<?php

/**
 * Esta clase representa a un trabajador del sistema E.R.P.
 * @author Daniel Beltrán Penagos
 * <br>
 * <center> <b> Universidad El Bosque<br>
 * Ingeniería de Software<br>
 * Profesor Ricardo Camargo Lemos <br>
 * Proyecto E.R.P Bienes y Servicios de Manufactura</b> </center>
 */
class Trabajador
{
    
    var $nombre;
    var $correo;
    var $imagen;
    
    function Trabajador($pNombre, $pCorreo, $pImagen)
    {
        $this->nombre = $pNombre;
        $this->correo = $pCorreo;
        $this->imagen = $pImagen;
    }
    
    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @return mixed
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * @return mixed
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @param mixed $correo
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }

    /**
     * @param mixed $imagen
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

}

?>