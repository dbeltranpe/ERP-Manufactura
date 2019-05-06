<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/controller/database.class.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/model/ItemFactura.class.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/controller/DAO/interfaces/iItemFacturaDAO.interface.php');

/**
 * Clase que representa el Data Access Object (DAO) de un item de una factura
 *
 * @author Daniel Beltrán Penagos
 *         <br>
 *         <center> <b> Universidad El Bosque<br>
 *         Ingeniería de Software<br>
 *         Profesor Ricardo Camargo Lemos <br>
 *         Proyecto E.R.P Bienes y Servicios de Manufactura</b> </center>
 */
class ItemFacturaDAO implements iItemFacturaDAO
{
    public function save($cod_factura, $cod_producto, $cantidad)
    {
        $db = new Database();
        $db->connect();
        
        $query = "INSERT INTO ITEM_FACTURA VALUES(1," . $cod_producto . "," . $cantidad . ");" ;
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