<?php

/**
 * Interface que representa el Data Access Object (DAO) del inventario de insumos
 * @author Daniel Beltr�n Penagos
 *
 * <br><br>
 * <center> <b> Universidad El Bosque<br>
 * Ingenier�a de Software<br>
 * Profesor Ricardo Camargo Lemos <br>
 * Proyecto E.R.P Bienes y Servicios de Manufactura</b> </center>
 */
interface iProductoDAO
{
    
    public function save($codigo);
    
    public function getProducto($codigo);
    
    public function updateProducto($codigo);
    
    public function deleteProducto($codigo);
    
    
}

?>