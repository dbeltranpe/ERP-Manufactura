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
interface iFacturaDAO
{
    
    public function save($pNombre, $pCCNIT, $pDireccion, $pTelefono, $pMedio, $pSubtotal, $pIva, $pTotal);
    
    public function getFactura($codigo);
    
    public function updateFactura($codigo);
    
    public function deleteFactura($codigo);
    
}

?>