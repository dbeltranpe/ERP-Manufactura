<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/controller/database.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/model/Insumo.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/controller/DAO/interfaces/iInsumoDAO.interface.php');

/**
 * Clase que representa el Data Access Object (DAO) del inventario de insumos
 * @author Daniel Beltrán Penagos
 * <br>
 * <center> <b> Universidad El Bosque<br>
 * Ingeniería de Software<br>
 * Profesor Ricardo Camargo Lemos <br>
 * Proyecto E.R.P Bienes y Servicios de Manufactura</b> </center>
 */
class InsumoDAO implements iInsumoDAO
{
    public function updateInsumo($codigo)
    {}

    public function getInsumo($codigo)
    {}

    public function save($codigo)
    {}

    public function deleteInsumo($codigo)
    {}
    
    public function listarInsumos()
    {
        $db = new Database();
        $db->connect();
        
        $query = "SELECT * FROM INSUMO;";
        $db->doQuery($query, SELECT_QUERY);
        $trArr = $db->results;
        
        $insumos = array();
        
        for ($i = 0; $i < sizeof($trArr); $i++) 
        {
            $insumos[]= new Insumo($trArr[$i]['cod_insumo'], $trArr[$i]['nom_insumo'], $trArr[$i]['valor_insumo'], $trArr[$i]['iva_insumo']);  
        }
        
        $db->disconnect();
        
        return $insumos;
    }

}

?>