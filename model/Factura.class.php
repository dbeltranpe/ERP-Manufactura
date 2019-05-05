<?php

/**
 * Esta clase representa una factura del sistema E.R.P.
 * @author Daniel Beltrán Penagos
 * <br>
 * <center> <b> Universidad El Bosque<br>
 * Ingeniería de Software<br>
 * Profesor Ricardo Camargo Lemos <br>
 * Proyecto E.R.P Bienes y Servicios de Manufactura</b> </center>
 */
class Factura
{
    
    private $codigo;
    private $nombre;
    private $ccnit;
    private $direccion;
    private $telefono;
    private $medio;
    private $fecha;
    private $subtotal;
    private $iva;
    private $total;
    
    public function Factura($pCodigo, $pNombre, $pCCNIT, $pDireccion, $pTelefono, $pMedio, $pFecha, $pSubtotal, $pIva, $pTotal)
    {
        $this->codigo    = $pCodigo;
        $this->nombre    = $pNombre;
        $this->ccnit     = $pCCNIT;
        $this->direccion = $pDireccion;
        $this->telefono  = $pTelefono;
        $this->medio     = $pMedio;
        $this->fecha     = $pFecha;
        $this->subtotal  = $pSubtotal;
        $this->iva       = $pIva;
        $this->total     = $pTotal;
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
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @return mixed
     */
    public function getCcnit()
    {
        return $this->ccnit;
    }

    /**
     * @return mixed
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @return mixed
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * @return mixed
     */
    public function getMedio()
    {
        return $this->medio;
    }

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @return mixed
     */
    public function getSubtotal()
    {
        return $this->subtotal;
    }

    /**
     * @return mixed
     */
    public function getIva()
    {
        return $this->iva;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    

    
    


}

?>