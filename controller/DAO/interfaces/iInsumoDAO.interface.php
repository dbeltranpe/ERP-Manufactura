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
interface iInsumoDAO
{
    
    public function save($codigo);
    
    public function getInsumo($codigo);
    
    public function updateInsumo($codigo);
    
    public function deleteInsumo($codigo);
    
    
}

?>