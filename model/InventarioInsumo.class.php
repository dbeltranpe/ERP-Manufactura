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
class InventarioInsumo
{
    
    private $codigoInsumo;
    private $cantidad;
    private $fecha;
    
    function InventarioInsumo($pCodigoInsumo, $pCantidad, $pFecha)
    {
        $this->codigoInsumo = $pCodigoInsumo;
        $this->cantidad = $pCantidad;
        $this->fecha = $pFecha;
    }
    
    
    /**
     * @return mixed
     */
    public function getCodigoInsumo()
    {
        return $this->codigoInsumo;
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