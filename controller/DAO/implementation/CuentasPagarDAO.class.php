<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/controller/database.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/model/CuentasPagar.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/controller/DAO/interfaces/iCuentasPagarDAO.interface.php');

/**
 * Clase que representa el Data Access Object (DAO) del inventario de insumos
 * @author Daniel Beltrán Penagos
 * <br>
 * <center> <b> Universidad El Bosque<br>
 * Ingeniería de Software<br>
 * Profesor Ricardo Camargo Lemos <br>
 * Proyecto E.R.P Bienes y Servicios de Manufactura</b> </center>
 */
class CuentasPagarDAO implements iCuentasPagarDAO
{
    public function listarCuentasPagar()
    {
        $db = new Database();
        $db->connect();
        
        $query = "SELECT * FROM CUENTAS_PAGAR";
        $db->doQuery($query, SELECT_QUERY);
        $cuenArr = $db->results;
        
        $Cuentas = array();
        
        for ($i = 0; $i < sizeof($cuenArr); $i++) 
        {
            $Cuentas[] = [
                "cod_cxp" => $cuenArr[$i]['cod_cxp'],
                "cod_factura" => $cuenArr[$i]['cod_compra'],
                "val_factura" => $cuenArr[$i]['val_compra'],
                "f_pago" => $cuenArr[$i]['f_pago'],
                "fecha" => $cuenArr[$i]['fecha'],
                "estado" => $cuenArr[$i]['estado']
            ]; 
        }
        
        $db->disconnect();
        
        return $Cuentas;
    }

    public function updateEstado($codigo){

        $db = new Database();
        $db->connect();

        $update = "UPDATE CUENTAS_PAGAR SET estado = 'Pagada' WHERE cod_cxp = $codigo";
        $db->doQuery($update, UPDATE_QUERY);

        $db->disconnect();
    }
}
?>