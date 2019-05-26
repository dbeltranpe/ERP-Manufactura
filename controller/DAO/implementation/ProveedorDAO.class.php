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
        
        $query = "SELECT * FROM PROVEEDOR ORDER BY cod_proveedor DESC;";
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

    public function updateProveedor($cCodProveedor, $pNombre, $pCorreo, $pTelefono) {
        $db = new Database();
        $db->connect();

        $query = "UPDATE PROVEEDOR SET nom_proveedor='" . $pNombre . "', correo_proveedor='" . $pCorreo . "', tel_proveedor='$pTelefono' WHERE cod_proveedor = " . $cCodProveedor . "; ";
        $db->doQuery($query, UPDATE_QUERY);

        $db->disconnect();
    }

    public function saveProveedor($pNombre, $pCorreo, $pTelefono, $pImg) {
        $db = new Database();
        $db->connect();

        $count = "SELECT * FROM PROVEEDOR ORDER BY cod_proveedor DESC";
        $db->doQuery($count, SELECT_QUERY);
        $num = $db->results[0];
        $codigo = $num['cod_proveedor'];

        $query = "INSERT INTO PROVEEDOR VALUES($codigo+1, '$pNombre', '$pTelefono', '$pCorreo', '$pImg');";
        $db->doQuery($query, INSERT_QUERY);

        $db->disconnect();
    }
}
?>