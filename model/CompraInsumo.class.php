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
class CompraInsumo
{
    var $codigo;
    
    var $codigo_compra;

    var $nombre;

    var $cantidad;

    var $precio;

    var $total;

    var $fecha;

    function CompraInsumo($pCodigo, $pCodigo_compra, $pNombre, $pCantidad, $pPrecio, $pTotal, $pFecha)
    {
        $this->codigo = $pCodigo;
        $this->codigo_compra = $pCodigo_compra;
        $this->nombre = $pNombre;
        $this->cantidad = $pCantidad;
        $this->precio = $pPrecio;
        $this->total = $pTotal;
        $this->fecha = $pFecha;
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
    public function getCodigoCompra()
    {
        return $this->codigo_compra;
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
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * @return mixed
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }
}
?>