<?php

/**
 * Interface que representa el Data Access Object (DAO) de los usuarios
 * @author Daniel Beltr�n Penagos
 *
 * <br><br>
 * <center> <b> Universidad El Bosque<br>
 * Ingenier�a de Software<br>
 * Profesor Ricardo Camargo Lemos <br>
 * Proyecto E.R.P Bienes y Servicios de Manufactura</b> </center>
 */
interface iCuentasCobrarDAO
{
    public function listarCuentasCobrar();
    public function save($pCod_factura, $pVal_factura, $pF_pago, $pEstado);
}
?>