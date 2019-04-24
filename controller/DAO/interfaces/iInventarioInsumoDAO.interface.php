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
interface iInventarioInsumoDAO
{
    
    public function save($pCodigoInsumo, $pCantidad);
    
    public function getInventarioInsumo($codigo);
    
    public function updateInventarioInsumo($codigo, $cantidad);
    
    public function deleteInventarioInsumo($codigo);
    
    
}

?>