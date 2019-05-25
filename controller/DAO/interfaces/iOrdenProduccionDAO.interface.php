<?php

/**
 * Interface que representa el Data Access Object (DAO) de las ordenes de porducción
 * @author Santiago Correa Vera
 *
 * <br><br>
 * <center> <b> Universidad El Bosque<br>
 * Ingeniería de Software<br>
 * Profesor Ricardo Camargo Lemos <br>
 * Proyecto E.R.P Bienes y Servicios de Manufactura</b> </center>
 */
interface iOrdenProduccionDAO
{
    
    public function save($nom_producto, $cantidad, $fechaI, $fechaE, $costoFabricacion, $almacen, $estado);
    
    public function getOrdenProduccion($codigo);
    
    public function updateOrdenProduccion($codigo, $cantidad);
    
    public function deleteOrdenProduccion($codigo);
}

?>