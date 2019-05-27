<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/controller/database.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/model/CuentasCobrar.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/controller/DAO/interfaces/iCuentasCobrarDAO.interface.php');

/**
 * Clase que representa el Data Access Object (DAO) del inventario de insumos
 * @author Daniel Beltrán Penagos
 * <br>
 * <center> <b> Universidad El Bosque<br>
 * Ingeniería de Software<br>
 * Profesor Ricardo Camargo Lemos <br>
 * Proyecto E.R.P Bienes y Servicios de Manufactura</b> </center>
 */
class CuentasCobrarDAO implements iCuentasCobrarDAO
{
    public function listarCuentasCobrar()
    {
        $db = new Database();
        $db->connect();
        
        $query = "SELECT * FROM CUENTAS_COBRAR";
        $db->doQuery($query, SELECT_QUERY);
        $cuenArr = $db->results;
        
        $Cuentas = array();
        
        for ($i = 0; $i < sizeof($cuenArr); $i++) 
        {
            $Cuentas[] = [
                "cod_cxc" => $cuenArr[$i]['cod_cxc'],
                "cod_factura" => $cuenArr[$i]['cod_factura'],
                "val_factura" => $cuenArr[$i]['val_factura'],
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

        $update = "UPDATE CUENTAS_COBRAR SET estado = 'Cobrada' WHERE cod_cxc = $codigo";
        $db->doQuery($update, UPDATE_QUERY);

        $db->disconnect();
    }
    
    public function save($pCod_factura, $pVal_factura, $pF_pago, $pEstado)
    {
        $db = new Database();
        $db->connect();
        
        $cuenta = "SELECT * FROM CUENTAS_COBRAR ORDER BY cod_cxc DESC";
        $db->doQuery($cuenta, SELECT_QUERY);
        $cod = $db->results[0];
        $code = $cod['cod_cxc'];
        
        $query = "INSERT INTO CUENTAS_COBRAR VALUES($code+1,'" .$pCod_factura."', '".$pVal_factura."', '".$pF_pago."', SYSDATE(), '".$pEstado."');";
        $db->doQuery($query, INSERT_QUERY);
        
        
        $db->disconnect();
    }
    
}
?>