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
class Compra
{
    var $codigo;
    
    var $f_pago;

    var $usuario;

    var $proveedor;

    function Compra($pCodigo, $pF_Pago, $pUsuario, $pProveedor)
    {
        $this->codigo = $pCodigo;
        $this->f_pago = $pF_Pago;
        $this->usuario = $pUsuario;
        $this->proveedor = $pProveedor;
    }
    
    /**
     * @return mixed
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @return mixed
     */
    public function getPago()
    {
        return $this->f_pago;
    }

    /**
     * @return mixed
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @return mixed
     */
    public function getProveedor()
    {
        return $this->proveedor;
    }
}
?>