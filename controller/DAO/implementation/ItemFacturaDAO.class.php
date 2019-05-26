<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/controller/database.class.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/model/ItemFactura.class.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/controller/DAO/interfaces/iItemFacturaDAO.interface.php');

/**
 * Clase que representa el Data Access Object (DAO) de un item de una factura
 *
 * @author Daniel Beltrán Penagos
 *         <br>
 *         <center> <b> Universidad El Bosque<br>
 *         Ingeniería de Software<br>
 *         Profesor Ricardo Camargo Lemos <br>
 *         Proyecto E.R.P Bienes y Servicios de Manufactura</b> </center>
 */
class ItemFacturaDAO implements iItemFacturaDAO
{
    public function save($cod_factura, $cod_producto, $cantidad)
    {
        $db = new Database();
        $db->connect();
        
        $query = "INSERT INTO ITEM_FACTURA VALUES(".$cod_factura."," . $cod_producto . "," . $cantidad . ");" ;
        $db->doQuery($query, INSERT_QUERY);
        
        $db->disconnect();
    }
    public function getItemFactura($codigo)
    {}

    public function updateItemFactura($codigo)
    {}

    public function deleteItemFactura($codigo)
    {}
    
    public function listarItemsFactura()
    {
        $db = new Database();
        $db->connect();
        
        $query = "SELECT * FROM v_item_factura;";
        $db->doQuery($query, SELECT_QUERY);
        $trArr = $db->results;
        
        $items = array();
        
        for ($i = 0; $i < sizeof($trArr); $i++)
        {
//             echo print_r($trArr[$i]);
            $items[]= ['codigo'=> $trArr[$i]['codigo'], 'producto'=> $trArr[$i]['producto'], 'cantidad'=> $trArr[$i]['cantidad'],'costo'=> $trArr[$i]['costo'], 'total'=> $trArr[$i]['total'] ];
        }
        
        $db->disconnect();
        
        return $items;
    }
    
    public function listarGananciaXProductos()
    {
        $db = new Database();
        $db->connect();
        
        $query = "SELECT * FROM v_gananciasxproducto;";
        $db->doQuery($query, SELECT_QUERY);
        $trArr = $db->results;
        
        $items = array();
        
        for ($i = 0; $i < sizeof($trArr); $i++)
        {
            $items[]= ['nombre'=> $trArr[$i]['nombre'], 'precio'=> $trArr[$i]['precio'], 'cantidad'=> $trArr[$i]['cantidad'], 'total'=> $trArr[$i]['total'] ];
        }
        
        $db->disconnect();
        
        return $items;
        
    }





}

?>