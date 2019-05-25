<?php

/**
 * Interface que representa el Data Access Object (DAO) del Item Producto
 * @author Santiago Correa Vera
 *
 * <br><br>
 * <center> <b> Universidad El Bosque<br>
 * Ingeniería de Software<br>
 * Profesor Ricardo Camargo Lemos <br>
 * Proyecto E.R.P Bienes y Servicios de Manufactura</b> </center>
 */
interface iItemProductoDAO
{
    
    public function save($cod_orden_produccion, $nombre_Insumo, $cantidad);
    
    public function getItemProduccion($codigo);
    
    public function updateItemProduccion($codigo, $cantidad);
    
    public function deleteItemProduccion($codigo);
    
}

?>