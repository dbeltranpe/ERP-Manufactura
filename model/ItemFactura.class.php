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
class ItemFactura
{
    
    private $codigo_factura;
    private $codigo_producto;
    private $cantidad;
    
    public function ItemFactura($codigo_factura, $codigo_producto, $cantidad)
    {
        $this->codigo_factura    = $codigo_factura;
        $this->codigo_producto = $codigo_producto;
        $this->cantidad = $cantidad;
    }
    
    /**
     * @return mixed
     */
    public function getCodigo_factura()
    {
        return $this->codigo_factura;
    }

    /**
     * @return mixed
     */
    public function getCodigo_producto()
    {
        return $this->codigo_producto;
    }

    /**
     * @return mixed
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

   
   

}

?>