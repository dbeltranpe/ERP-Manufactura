<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/controller/database.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/model/Rol.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/controller/DAO/interfaces/iRolDAO.interface.php');

/**
 * Clase que representa el Data Access Object (DAO) del inventario de insumos
 * @author Daniel Beltrán Penagos
 * <br>
 * <center> <b> Universidad El Bosque<br>
 * Ingeniería de Software<br>
 * Profesor Ricardo Camargo Lemos <br>
 * Proyecto E.R.P Bienes y Servicios de Manufactura</b> </center>
 */
class RolDAO implements iRolDAO
{
    public function listarRoles()
    {
        $db = new Database();
        $db->connect();
        
        $query = "SELECT * FROM ROL;";
        $db->doQuery($query, SELECT_QUERY);
        $trArr = $db->results;
        
        $roles = array();
        
        for ($i = 0; $i < sizeof($trArr); $i++) 
        {
            $roles[]= new Rol($trArr[$i]['cod_rol'], $trArr[$i]['nom_rol']);  
        }
        
        $db->disconnect();
        
        return $roles;
    }
}
?>