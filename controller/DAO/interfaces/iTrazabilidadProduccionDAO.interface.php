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
interface iTrazabilidadProduccionDAO
{
    
    public function save($accion_realizada, $numero_orden, $nom_producto, $cantidad, $costo);
    
    public function getTrazabilidad($codigo);
    
    public function updateTrazabilidad($codigo, $cantidad);
    
    public function deleteTrazabilidad($codigo);
    
}

?>