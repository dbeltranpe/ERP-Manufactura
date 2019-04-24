<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/controller/database.class.php');
require($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/model/InventarioProducto.class.php');
require($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/controller/DAO/interfaces/iInventarioProductoDAO.interface.php');

/**
 * Clase que representa el Data Access Object (DAO) del inventario de insumos
 * @author Daniel Beltrán Penagos
 * <br>
 * <center> <b> Universidad El Bosque<br>
 * Ingeniería de Software<br>
 * Profesor Ricardo Camargo Lemos <br>
 * Proyecto E.R.P Bienes y Servicios de Manufactura</b> </center>
 */
class InventarioProductoDAO implements iInventarioProductoDAO
{
    
    public function deleteInventarioProducto($codigo)
    {
        $db = new Database();
        $db->connect();
       
        $query = "DELETE FROM INV_PRODUCTO  WHERE cod_producto='".$codigo."';";
        $db->doQuery($query, DELETE_QUERY);
        
        $db->disconnect();
       
    }

    public function updateInventarioProducto($codigo, $cantidad)
    {
        $db = new Database();
        $db->connect();
       
        $query = "UPDATE INV_PRODUCTO SET cantidad=".$cantidad." WHERE cod_producto='".$codigo."';";
        $db->doQuery($query, UPDATE_QUERY);
        
        $db->disconnect();
    }

    public function getInventarioProducto($codigo)
    {
        $db = new Database();
        $db->connect();
        
        $query = "SELECT * FROM INV_PRODUCTO WHERE cod_producto='".$codigo."';";
        $db->doQuery($query, SELECT_QUERY);
        $trArr = $db->results[0];
        
        $pCodigoProducto = $trArr['cod_producto'];
        $pCantidad = $trArr['cantidad'];
        $pFecha = $trArr['fecha'];
        
        $InvProd = new InventarioProducto($pCodigoProducto, $pCantidad, $pFecha);
        
        $db->disconnect();
        
        return $InvProd;
    }

    public function save($pCodigoProducto, $pCantidad)
    {
        $db = new Database();
        $db->connect();
        
        $invProducto = $this->getInventarioProducto($pCodigoProducto);
        
        if($invProducto->getCodigoProducto() == null)
        {            
            $query = "INSERT INTO INV_PRODUCTO VALUES(0,".$pCodigoProducto.", ".$pCantidad.", SYSDATE());";
            $db->doQuery($query, INSERT_QUERY);    
        }
        else
        {
            $cantidad = $pCantidad + $invProducto->getCantidad();
            $this->updateInventarioProducto($pCodigoProducto, $cantidad);
        }
        
        $db->disconnect();
    }
    
    public function listarInventarioProductos()
    {
        $db = new Database();
        $db->connect();
        
        $query = "SELECT fecha, cantidad, nom_producto, vl_unitario_producto, iva_producto, (cantidad*(vl_unitario_producto+(vl_unitario_producto*iva_producto))) as total FROM PRODUCTO, INV_PRODUCTO WHERE PRODUCTO.cod_producto = INV_PRODUCTO.cod_producto;";
        $db->doQuery($query, SELECT_QUERY);
        $trArr = $db->results;
        
        $productos = array();
        
        for ($i = 0; $i < sizeof($trArr); $i++)
        {
            $productos[] = [
                "fecha" => $trArr[$i]['fecha'],
                "cantidad" => $trArr[$i]['cantidad'],
                "nom_producto" => $trArr[$i]['nom_producto'],
                "valor_producto" => $trArr[$i]['vl_unitario_producto'],
                "iva_producto" => $trArr[$i]['iva_producto'],
                "total" => $trArr[$i]['total']
            ];
        }
        
        $db->disconnect();
        
        return $productos;
    }

   
}

?>