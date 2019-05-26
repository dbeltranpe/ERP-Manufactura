<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/controller/database.class.php');
// Tener cuidado porque si se desdocumenta esto entonces al guardar la factura habra error
// require_once ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/model/Factura.class.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/controller/DAO/interfaces/iFacturaDAO.interface.php');

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
    
    public function getCodFactura($pNombre, $pCCNIT, $pDireccion, $pTelefono, $pMedio, $pSubtotal, $pIva, $pTotal)
    {
        $db = new Database();
        $db->connect();
        
        $query = "SELECT cod_factura FROM FACTURA WHERE nom_cli_factura='". $pNombre ."' AND cc_nit_factura='". $pCCNIT ."' AND dir_factura='". $pDireccion ."' AND tel_factura='". $pTelefono ."' AND cod_m_pago=". $pMedio ." AND subtotal=". $pSubtotal ." AND iva=". $pIva ." AND total=". $pTotal ." ORDER BY cod_factura desc;";
        $db->doQuery($query, SELECT_QUERY);
        
        $trArr = $db->results[0];
        $codigo = $trArr['cod_factura'];
        
        $db->disconnect();
        
        return $codigo;
    }
    
    public function getFactura($codigo)
    {}

    public function deleteFactura($codigo)
    {}

    public function updateFactura($codigo)
    {}
    
    public function totalVentas()
    {
        $db = new Database();
        $db->connect();
        
        $query = "SELECT sum(FACTURA.total) total FROM FACTURA;";
        $db->doQuery($query, SELECT_QUERY);
        $proCom = $db->results;
        
        
        $db->disconnect();
        
        return $proCom[0]['total'];
    }
}

?>