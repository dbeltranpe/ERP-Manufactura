<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/controller/database.class.php');

/**
 * Clase que representa el Data Access Object (DAO) del Hist�rico
 * @author Daniel Beltrán Penagos
 * <br>
 * <center> <b> Universidad El Bosque<br>
 * Ingeniería de Software<br>
 * Profesor Ricardo Camargo Lemos <br>
 * Proyecto E.R.P Bienes y Servicios de Manufactura</b> </center>
 */
class HistoricoDAO
{
    public function listarHistoria()
    {
        $db = new Database();
        $db->connect();
        
        $query = "SELECT * FROM HISTORICO;";
        $db->doQuery($query, SELECT_QUERY);
        $trArr = $db->results;
        
        $historia = array();
        
        for ($i = 0; $i < sizeof($trArr); $i++) 
        {
            $historia[]= 
            [
                "fecha"=>$trArr[$i]['fecha'], 
                "nro_insumos"=>$trArr[$i]['nro_insumos'],
                "nro_productos"=>$trArr[$i]['nro_productos'],
                "nro_empleados"=>$trArr[$i]['nro_empleados'],
                "nro_ordenes"=>$trArr[$i]['nro_ordenes'],
                "vl_compras"=>$trArr[$i]['vl_compras'], 
                "vl_ventas"=>$trArr[$i]['vl_ventas']
            ];  
        }
        
        $db->disconnect();
        
        return $historia;
    }
}
?>