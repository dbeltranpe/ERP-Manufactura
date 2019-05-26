<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/controller/database.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/model/ItemProducto.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/controller/DAO/interfaces/iItemProductoDAO.interface.php');

/**
 * Clase que representa el Data Access Object (DAO) del inventario de insumos
 * @author Santiago Correa Vera
 * <br>
 * <center> <b> Universidad El Bosque<br>
 * Ingeniería de Software<br>
 * Profesor Ricardo Camargo Lemos <br>
 * Proyecto E.R.P Bienes y Servicios de Manufactura</b> </center>
 */

class ItemProductoDAO implements iItemProductoDAO
{
    public function save($cod_orden_produccion, $nombre_Insumo, $cantidad)
    {
        $db = new Database();
        $db->connect();
        
        $query = "INSERT INTO ITEM_PRODUCTO VALUES(".$cod_orden_produccion.", '".$nombre_Insumo."', ".$cantidad.");";
        $db->doQuery($query, INSERT_QUERY);
        
        $db->disconnect();
    }

    public function getItemProduccion($codigo)
    {
        $db = new Database();
        $db->connect();
        
        $query = "SELECT * FROM ITEM_PRODUCTO WHERE cod_orden_produccion = ".$codigo.";";
        $db->doQuery($query, SELECT_QUERY);
        $trArr = $db->results[0];
        
        $pCod_orden_Produccion = $trArr['cod_orden_produccion'];
        $nom_Producto = $trArr['nom_insumo'];
        $pCantidad = $trArr['cantidad'];
        
        $item_Producc = new ItemProducto($pCod_orden_Produccion, $nom_Producto, $pCantidad);
        
        $db->disconnect();
        
        return $item_Producc;
    }

    public function updateItemProduccion($codigo, $cantidad)
    {
        
    }

    public function deleteItemProduccion($codigo)
    {
        $db = new Database();
        $db->connect();
        
        $query = "DELETE FROM ITEM_PRODUCTO WHERE cod_orden_produccion = ".$codigo.";";
        $db->doQuery($query, DELETE_QUERY);
        
        $db->disconnect();
    }

}

?>