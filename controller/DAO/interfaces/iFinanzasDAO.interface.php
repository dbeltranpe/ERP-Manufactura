<?php

/**
 * Interface que representa el Data Access Object (DAO) de una factura
 * @author Daniel Beltrán Penagos
 *
 * <br><br>
 * <center> <b> Universidad El Bosque<br>
 * Ingeniería de Software<br>
 * Profesor Ricardo Camargo Lemos <br>
 * Proyecto E.R.P Bienes y Servicios de Manufactura</b> </center>
 */
interface iFinanzasDAO
{
    public function listarFinanzas();
    
    public function movimientos();
}

?>