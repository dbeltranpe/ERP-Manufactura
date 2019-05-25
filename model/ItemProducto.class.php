<?php 

/**
 * Esta clase representa a las Ordenes de producción del sistema E.R.P.
 * @author Santiago Correa Vera
 * <br>
 * <center> <b> Universidad El Bosque<br>
 * Ingeniería de Software<br>
 * Profesor Ricardo Camargo Lemos <br>
 * Proyecto E.R.P Bienes y Servicios de Manufactura</b> </center>
 */

class ItemProducto
{
    private $cod_orden_factura;
    private $cod_insumo;
    private $cantidad;
    
    function ItemProducto($pCodigo_orden, $pCod_Insumo, $pCantidad)
    {
        $this->cod_orden_factura = $pCodigo_orden;
        $this->cod_insumo = $pCod_Insumo;
        $this->cantidad = $pCantidad;
    }
    
    /**
     * @return mixed
     */
    public function getCod_orden_factura()
    {
        return $this->cod_orden_factura;
    }

    /**
     * @return mixed
     */
    public function getCod_insumo()
    {
        return $this->cod_insumo;
    }

    /**
     * @return mixed
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * @param mixed $cod_orden_factura
     */
    public function setCod_orden_factura($cod_orden_factura)
    {
        $this->cod_orden_factura = $cod_orden_factura;
    }

    /**
     * @param mixed $nom_insumo
     */
    public function setCod_insumo($cod_insumo)
    {
        $this->cod_insumo = $cod_insumo;
    }

    /**
     * @param mixed $cantidad
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }
}
?>