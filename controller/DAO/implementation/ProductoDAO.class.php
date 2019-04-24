<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/controller/database.class.php');
require($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/model/Producto.class.php');
require($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/controller/DAO/interfaces/iProductoDAO.interface.php');

/**
 * Clase que representa el Data Access Object (DAO) del inventario de insumos
 * @author Daniel Beltrán Penagos
 * <br>
 * <center> <b> Universidad El Bosque<br>
 * Ingeniería de Software<br>
 * Profesor Ricardo Camargo Lemos <br>
 * Proyecto E.R.P Bienes y Servicios de Manufactura</b> </center>
 */
class ProductoDAO implements iProductoDAO
{
    public function updateProducto($codigo)
    {}

    public function getProducto($codigo)
    {}

    public function save($codigo)
    {}

    public function deleteProducto($codigo)
    {}
    
    public function listarProductos()
    {
        $db = new Database();
        $db->connect();
        
        $query = "SELECT * FROM PRODUCTO;";
        $db->doQuery($query, SELECT_QUERY);
        $trArr = $db->results;
        
        $productos = array();
        
        for ($i = 0; $i < sizeof($trArr); $i++) 
        {
            $productos[]= new Producto($trArr[$i]['cod_producto'], $trArr[$i]['nom_producto'], $trArr[$i]['vl_unitario_producto'], $trArr[$i]['iva_producto']);  
        }
        
        $db->disconnect();
        
        return $productos;
    }

}

?>