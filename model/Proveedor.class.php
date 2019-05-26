<?php

/**
 * Esta clase representa a un usuario del sistema E.R.P.
 * @author Daniel Beltrán Penagos
 * <br>
 * <center> <b> Universidad El Bosque<br>
 * Ingeniería de Software<br>
 * Profesor Ricardo Camargo Lemos <br>
 * Proyecto E.R.P Bienes y Servicios de Manufactura</b> </center>
 */
class Rol
{
    var $cod_proveedor;
    
    var $nom_proveedor;

    var $tel_proveedor;

    var $correo_proveedor;

    var $img_proveedor;

    function Rol($pCodPro, $pNomPro, $pTelPro, $pCorPro, $pImgPro)
    {
        $this->cod_proveedor = $pCodPro;
        $this->nom_proveedor = $pNomPro;
        $this->tel_proveedor = $pTelPro;
        $this->correo_proveedor = $pCorPro;
        $this->img_proveedor = $pImgPro;
    }
    
    /**
     * @return mixed
     */
    public function getCodigo()
    {
        return $this->cod_proveedor;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nom_proveedor;
    }

    /**
     * @return mixed
     */
    public function getTelefono()
    {
        return $this->tel_proveedor;
    }

    /**
     * @return mixed
     */
    public function getCorreo()
    {
        return $this->correo_proveedor;
    }

    /**
     * @return mixed
     */
    public function getImagen()
    {
        return $this->img_proveedor;
    }
}
?>