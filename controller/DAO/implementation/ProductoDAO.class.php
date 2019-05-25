<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/controller/database.class.php');
require($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/model/Producto.class.php');
require($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/controller/DAO/interfaces/iProductoDAO.interface.php');

/**
 * Clase que representa el Data Access Object (DAO) de los productos
 * @author Santiago Correa Vera
 * <br>
 * <center> <b> Universidad El Bosque<br>
 * Ingeniería de Software<br>
 * Profesor Ricardo Camargo Lemos <br>
 * Proyecto E.R.P Bienes y Servicios de Manufactura</b> </center>
 */
class ProductoDAO implements iProductoDAO
{
    public function updateProducto($nom_producto)
    {}

    public function getProducto($nom_producto)
    {
        $db = new Database();
        $db->connect();
        
        $query = "SELECT * FROM PRODUCTO WHERE nom_producto = '".$nom_producto."';";
        $db->doQuery($query, SELECT_QUERY);
        $trArr = $db->results;
        
        $productos = array();
        
        $produc = $trArr[0];
        
        if ($produc != null)
        {
            $productos[]= new Producto($produc['cod_producto'], $produc['nom_producto'], $produc['vl_unitario_producto'], $produc['iva_producto']);
        }
        
        $db->disconnect();
        
        return $productos;
    }

    public function save($nom_producto, $iva_producto, $val_unitario_porducto)
    {
        $db = new Database();
        $db->connect();
        
        $query = "INSERT INTO PRODUCTO VALUES (0, '".$nom_producto."', ".$iva_producto.", ".$val_unitario_porducto.");";
        $db->doQuery($query, INSERT_QUERY);
    
        $db->disconnect();
    }

    public function deleteProducto($nom_producto)
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