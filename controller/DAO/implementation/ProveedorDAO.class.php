<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/controller/database.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/model/Proveedor.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/controller/DAO/interfaces/iProveedorDAO.interface.php');

/**
 * Clase que representa el Data Access Object (DAO) del inventario de insumos
 * @author Daniel Beltrán Penagos
 * <br>
 * <center> <b> Universidad El Bosque<br>
 * Ingeniería de Software<br>
 * Profesor Ricardo Camargo Lemos <br>
 * Proyecto E.R.P Bienes y Servicios de Manufactura</b> </center>
 */
class ProveedorDAO implements iProveedorDAO
{
    public function listarProveedores()
    {
        $db = new Database();
        $db->connect();
        
        $query = "SELECT * FROM PROVEEDOR;";
        $db->doQuery($query, SELECT_QUERY);
        $proArr = $db->results;
        
        $proveedores = array();
        
        for ($i = 0; $i < sizeof($proArr); $i++) 
        {
            $proveedores[] = [
                "cod_proveedor" => $proArr[$i]['cod_proveedor'],
                "nom_proveedor" => $proArr[$i]['nom_proveedor'],
                "tel_proveedor" => $proArr[$i]['tel_proveedor'],
                "correo_proveedor" => $proArr[$i]['correo_proveedor'],
                "img_proveedor" => $proArr[$i]['img_proveedor']
            ]; 
        }
        
        $db->disconnect();
        
        return $proveedores;
    }
}
?>