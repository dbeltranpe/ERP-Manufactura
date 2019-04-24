<?php

/**
 * Esta clase representa al inventario de un insumo del sistema E.R.P.
 * @author Daniel Beltrán Penagos
 * <br>
 * <center> <b> Universidad El Bosque<br>
 * Ingeniería de Software<br>
 * Profesor Ricardo Camargo Lemos <br>
 * Proyecto E.R.P Bienes y Servicios de Manufactura</b> </center>
 */
class InventarioProducto
{
    
    private $codigoProducto;
    private $cantidad;
    private $fecha;
    
    function InventarioProducto($pCodigoProducto, $pCantidad, $pFecha)
    {
        $this->codigoProducto = $pCodigoProducto;
        $this->cantidad = $pCantidad;
        $this->fecha = $pFecha;
    }
    
    
    /**
     * @return mixed
     */
    public function getCodigoProducto()
    {
        return $this->codigoProducto;
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
    public function getFecha()
    {
        return $this->fecha;
    }





}

?>