<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/controller/database.class.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/model/Factura.class.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/controller/DAO/interfaces/iFacturaDAO.interface.php');

/**
 * Clase que representa el Data Access Object (DAO) de una factura
 *
 * @author Daniel Beltrán Penagos
 *         <br>
 *         <center> <b> Universidad El Bosque<br>
 *         Ingeniería de Software<br>
 *         Profesor Ricardo Camargo Lemos <br>
 *         Proyecto E.R.P Bienes y Servicios de Manufactura</b> </center>
 */
class FacturaDAO implements iFacturaDAO
{

    public function save($pNombre, $pCCNIT, $pDireccion, $pTelefono, $pMedio, $pSubtotal, $pIva, $pTotal)
    {
        $db = new Database();
        $db->connect();

        $query = "INSERT INTO FACTURA VALUES(0,'" . $pNombre . "','" . $pCCNIT . "','" . $pDireccion . "','" . $pTelefono . "','" . $pMedio . "','" . $pSubtotal . "','" . $pIva . "','" . $pTotal . "'," . " SYSDATE());";
        $db->doQuery($query, INSERT_QUERY);

        $db->disconnect();
    }

    public function getFactura($codigo)
    {}

    public function deleteFactura($codigo)
    {}

    public function updateFactura($codigo)
    {}
}

?>