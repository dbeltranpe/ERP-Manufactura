<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/controller/database.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/model/Compra.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/controller/DAO/interfaces/iCompraDAO.interface.php');

/**
 * Clase que representa el Data Access Object (DAO) del inventario de insumos
 * @author Daniel Beltrán Penagos
 * <br>
 * <center> <b> Universidad El Bosque<br>
 * Ingeniería de Software<br>
 * Profesor Ricardo Camargo Lemos <br>
 * Proyecto E.R.P Bienes y Servicios de Manufactura</b> </center>
 */
class CompraDAO implements iCompraDAO
{
	public function save($user, $arrNoms, $arrCans, $arrPres, $arrTots, $pro, $pago, $time, $totCan, $totSum){

		$db = new Database();
        $db->connect();

        $count = "SELECT * FROM COMPRA ORDER BY cod_compra DESC";
        $db->doQuery($count, SELECT_QUERY);
        $num = $db->results[0];
        $codigo = $num['cod_compra'];

        $tiempo = "";

        if ($time == 1) {
        	$tiempo = "Inmediato";
            $insert = "INSERT INTO COMPRA VALUES($codigo+1, $pago, '$user', $pro, $totCan, $totSum, '$tiempo', SYSDATE())";
            $db->doQuery($insert, INSERT_QUERY);
        } else {
        	$tiempo = "Plazos";
            $insert = "INSERT INTO COMPRA VALUES($codigo+1, $pago, '$user', $pro, $totCan, $totSum, '$tiempo', SYSDATE())";
            $db->doQuery($insert, INSERT_QUERY);

        	$conCue = "SELECT * FROM CUENTAS_PAGAR ORDER BY cod_cxp DESC";
	        $db->doQuery($conCue, SELECT_QUERY);
	        $data = $db->results[0];
	        $indice = $data['cod_cxp'];

        	$cxp = "INSERT INTO CUENTAS_PAGAR VALUES($indice+1, $codigo+1, $totSum, $pago, SYSDATE(), 'Pendiente')";
        	$db->doQuery($cxp, INSERT_QUERY);

        	$finanza = "UPDATE FINANZAS SET total_proceso = total_proceso+$totSum";
        	$db->doQuery($finanza, UPDATE_QUERY);
        }

        $cuenta = "SELECT * FROM COMPRA_INSUMO ORDER BY cod_com_insumo DESC";
        $db->doQuery($cuenta, SELECT_QUERY);
        $cod = $db->results[0];
        $code = $cod['cod_com_insumo'];

        $contar = "SELECT * FROM INSUMO ORDER BY cod_insumo DESC";
        $db->doQuery($contar, SELECT_QUERY);
        $ins = $db->results[0];
        $codIns = $ins['cod_insumo'];

        $contado = "SELECT * FROM INV_INSUMO ORDER BY cod_inv_insumo DESC";
        $db->doQuery($contado, SELECT_QUERY);
        $inv = $db->results[0];
        $codInve = $inv['cod_inv_insumo'];

        for ($i=0; $i < sizeof($arrCans); $i++) {
        	$compra = "INSERT INTO COMPRA_INSUMO VALUES($code+1+$i, $codigo+1, '$arrNoms[$i]', $arrCans[$i], $arrPres[$i], $arrTots[$i], SYSDATE())";
        	$db->doQuery($compra, INSERT_QUERY);

        	$insumo = "INSERT INTO INSUMO VALUES($codIns+1+$i, '$arrNoms[$i]', $arrPres[$i], 0.19)";
        	$db->doQuery($insumo, INSERT_QUERY);

        	$inventario = "INSERT INTO INV_INSUMO VALUES($codInve+1+$i, $codIns+1+$i, $arrCans[$i], SYSDATE())";
        	$db->doQuery($inventario, INSERT_QUERY);
        }

        $db->disconnect();
	}
        public function listarCompras(){
        
        $db = new Database();
        $db->connect();
        
        $query = "SELECT * FROM COMPRA;";
        $db->doQuery($query, SELECT_QUERY);
        $proCom = $db->results;
        
        $compras = array();
        
        for ($i = 0; $i < sizeof($proCom); $i++) 
        {
            $compras[] = [
                "cod_compra" => $proCom[$i]['cod_compra'],
                "f_pago" => $proCom[$i]['f_pago'],
                "usuario_compra" => $proCom[$i]['usuario_compra'],
                "proveedor_compra" => $proCom[$i]['proveedor_compra'],
                "cantidades_compra" => $proCom[$i]['cantidades_compra'],
                "total_compra" => $proCom[$i]['total_compra'],
                "tiempo_compra" => $proCom[$i]['tiempo_compra'],
                "fecha_compra" => $proCom[$i]['fecha_compra']
            ]; 
        }
        
        $db->disconnect();
        
        return $compras;
    }
}
?>