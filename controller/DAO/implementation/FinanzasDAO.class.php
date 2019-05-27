<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/controller/database.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/model/Finanzas.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/controller/DAO/interfaces/iFinanzasDAO.interface.php');

/**
 * Clase que representa el Data Access Object (DAO) del inventario de insumos
 * @author Daniel Beltrán Penagos
 * <br>
 * <center> <b> Universidad El Bosque<br>
 * Ingeniería de Software<br>
 * Profesor Ricardo Camargo Lemos <br>
 * Proyecto E.R.P Bienes y Servicios de Manufactura</b> </center>
 */
class FinanzasDAO implements iFinanzasDAO
{
    public function listarFinanzas()
    {
        $db = new Database();
        $db->connect();
        
        $query = "SELECT * FROM FINANZAS;";
        $db->doQuery($query, SELECT_QUERY);
        $finArr = $db->results;
        
        $finanzas = array();
        
        for ($i = 0; $i < sizeof($finArr); $i++) 
        {
            $finanzas[] = [
                "cod_proceso" => $finArr[$i]['cod_proceso'],
                "nombre_proceso" => $finArr[$i]['nombre_proceso'],
                "total_proceso" => $finArr[$i]['total_proceso']
            ]; 
        }
        
        $db->disconnect();
        
        return $finanzas;
    }
    public function movimientos(){

        $db = new Database();
        $db->connect();

        $cxp = "SELECT total_proceso FROM FINANZAS WHERE cod_proceso = 1";
        $db->doQuery($cxp, SELECT_QUERY);
        $dataA = $db->results[0]['total_proceso'];

        $cxc = "SELECT total_proceso FROM FINANZAS WHERE cod_proceso = 2";
        $db->doQuery($cxc, SELECT_QUERY);
        $dataB = $db->results[0]['total_proceso'];;

        $inI = "SELECT total_proceso FROM FINANZAS WHERE cod_proceso = 3";
        $db->doQuery($inI, SELECT_QUERY);
        $dataC = $db->results[0]['total_proceso'];;

        $inP = "SELECT total_proceso FROM FINANZAS WHERE cod_proceso = 4";
        $db->doQuery($inP, SELECT_QUERY);
        $dataD = $db->results[0]['total_proceso'];;

        $ventas = "SELECT total_proceso FROM FINANZAS WHERE cod_proceso = 5";
        $db->doQuery($ventas, SELECT_QUERY);
        $dataE = $db->results[0]['total_proceso'];;

        $compras = "SELECT total_proceso FROM FINANZAS WHERE cod_proceso = 6";
        $db->doQuery($compras, SELECT_QUERY);
        $dataF = $db->results[0]['total_proceso'];;

        $nomina = "SELECT total_proceso FROM FINANZAS WHERE cod_proceso = 7";
        $db->doQuery($nomina, SELECT_QUERY);
        $dataG = $db->results[0]['total_proceso'];

        $activos = $dataB+$dataE;
        $pasivos = $dataA+$dataF+$dataG;
        $patrimonio = $dataC+$dataD;

        $datos = array($activos, $pasivos, $patrimonio, $dataG);

        return $datos;
    }
}
?>