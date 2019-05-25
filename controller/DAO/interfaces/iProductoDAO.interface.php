<?php

/**
 * Interface que representa el Data Access Object (DAO) del inventario de insumos
 * @author Santiago Correa Vera
 *
 * <br><br>
 * <center> <b> Universidad El Bosque<br>
 * Ingeniería de Software<br>
 * Profesor Ricardo Camargo Lemos <br>
 * Proyecto E.R.P Bienes y Servicios de Manufactura</b> </center>
 */
interface iProductoDAO
{
    
    public function save($nom_producto, $iva_producto, $val_unitario_porducto);
    
    public function getProducto($nom_producto);
    
    public function updateProducto($nom_producto);
    
    public function deleteProducto($nom_producto);
    
}

?>