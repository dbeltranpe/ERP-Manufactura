<?php

/**
 * Interface que representa el Data Access Object (DAO) de un item de una factura
 * @author Daniel Beltrán Penagos
 *
 * <br><br>
 * <center> <b> Universidad El Bosque<br>
 * Ingeniería de Software<br>
 * Profesor Ricardo Camargo Lemos <br>
 * Proyecto E.R.P Bienes y Servicios de Manufactura</b> </center>
 */
interface iItemFacturaDAO
{
    
    public function save($cod_factura, $cod_producto, $cantidad);
    
    public function getItemFactura($codigo);
    
    public function updateItemFactura($codigo);
    
    public function deleteItemFactura($codigo);
    
}

?>