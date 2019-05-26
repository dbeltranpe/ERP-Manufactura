<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/controller/database.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/model/TrazabilidadProduccion.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/controller/DAO/interfaces/iTrazabilidadProduccionDAO.interface.php');

/**
 * Clase que representa el Data Access Object (DAO) de la trazabilidad
 * @author Santiago Correa Vera
 * <br>
 * <center> <b> Universidad El Bosque<br>
 * Ingeniería de Software<br>
 * Profesor Ricardo Camargo Lemos <br>
 * Proyecto E.R.P Bienes y Servicios de Manufactura</b> </center>
 */

class TrazabilidadProduccionDAO implements iTrazabilidadProduccionDAO
{
    public function getTrazabilidad($codigo)
    {
        
    }

    public function updateTrazabilidad($codigo, $cantidad)
    {
        
    }

    public function deleteTrazabilidad($codigo)
    {
        
    }

    public function save($accion_realizada, $numero_orden, $nom_producto, $cantidad, $costo)
    {
        $db = new Database();
        $db->connect();
        
        $query = "INSERT INTO TRAZABILIDAD_PRODUCCION VALUES(0,'" .$accion_realizada."', '".$numero_orden."', '".$nom_producto."', '".$cantidad."', '".$costo."', SYSDATE());";
        $db->doQuery($query, INSERT_QUERY);
        
        
        $db->disconnect();
    }
    
    public function listarTrazabilidad()
    {
        $db = new Database();
        $db->connect();
        
        $query = "SELECT * FROM TRAZABILIDAD_PRODUCCION";
        $db->doQuery($query, SELECT_QUERY);
        $trArr = $db->results;
        
        $traza = array();
        
        for ($i = 0; $i < sizeof($trArr); $i++)
        {
            $traza[] = [
                "cod_trazabilidad" => $trArr[$i]['cod_trazabilidad'],
                "accion_realizada" => $trArr[$i]['accion_realizada'],
                "numero_orden" => $trArr[$i]['numero_orden_produccion'],
                "nom_produc" => $trArr[$i]['nom_producto'],
                "cantidad_produc" => $trArr[$i]['cantidad_producto'],
                "costo" => $trArr[$i]['costo'],
                "fecha" => $trArr[$i]['fecha']
            ];
        }
        
        $db->disconnect();
        
        return $traza;
    }
    
    public function listarTrazabilidadActiva()
    {
        $db = new Database();
        $db->connect();
        
        $query = "SELECT * FROM TRAZABILIDAD_PRODUCCION WHERE accion_realizada = 'Agrego Orden'";
        $db->doQuery($query, SELECT_QUERY);
        $trArr = $db->results;
        
        $traza = array();
        
        for ($i = 0; $i < sizeof($trArr); $i++)
        {
            $traza[] = [
                "cod_trazabilidad" => $trArr[$i]['cod_trazabilidad'],
                "accion_realizada" => $trArr[$i]['accion_realizada'],
                "numero_orden" => $trArr[$i]['numero_orden_produccion'],
                "nom_produc" => $trArr[$i]['nom_producto'],
                "cantidad_produc" => $trArr[$i]['cantidad_producto'],
                "costo" => $trArr[$i]['costo'],
                "fecha" => $trArr[$i]['fecha']
            ];
        }
        
        $db->disconnect();
        
        return $traza;
    }
    
    public function listarTrazabilidadEliminada()
    {
        $db = new Database();
        $db->connect();
        
        $query = "SELECT * FROM TRAZABILIDAD_PRODUCCION WHERE accion_realizada = 'Elimino Orden'";
        $db->doQuery($query, SELECT_QUERY);
        $trArr = $db->results;
        
        $traza = array();
        
        for ($i = 0; $i < sizeof($trArr); $i++)
        {
            $traza[] = [
                "cod_trazabilidad" => $trArr[$i]['cod_trazabilidad'],
                "accion_realizada" => $trArr[$i]['accion_realizada'],
                "numero_orden" => $trArr[$i]['numero_orden_produccion'],
                "nom_produc" => $trArr[$i]['nom_producto'],
                "cantidad_produc" => $trArr[$i]['cantidad_producto'],
                "costo" => $trArr[$i]['costo'],
                "fecha" => $trArr[$i]['fecha']
            ];
        }
        
        $db->disconnect();
        
        return $traza;
    }
    
}
?>