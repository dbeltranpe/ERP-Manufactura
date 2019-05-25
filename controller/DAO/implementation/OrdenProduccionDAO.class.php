<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/controller/database.class.php');
require($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/model/OrdenProduccion.class.php');
require($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/controller/DAO/interfaces/iOrdenProduccionDAO.interface.php');

/**
 * Clase que representa el Data Access Object (DAO) de la orden de producción
 * @author Santiago Correa Vera
 * <br>
 * <center> <b> Universidad El Bosque<br>
 * Ingeniería de Software<br>
 * Profesor Ricardo Camargo Lemos <br>
 * Proyecto E.R.P Bienes y Servicios de Manufactura</b> </center>
 */
class OrdenProduccionDAO implements iOrdenProduccionDAO
{
    
    public function deleteOrdenProduccion($codigo)
    {
        $db = new Database();
        $db->connect();
        
        $query = "DELETE FROM ITEM_PRODUCTO WHERE cod_orden_produccion=".$codigo.";";
        $db->doQuery($query, DELETE_QUERY);
        
        $query = "DELETE FROM ORDENES_PRODUCCION WHERE cod_orden_produccion=".$codigo.";";
        $db->doQuery($query, DELETE_QUERY);
        
        $db->disconnect();
       
    }

    public function updateOrdenProduccion($codigo, $cantidad)
    {
        $db = new Database();
        $db->connect();
       
        $query = "UPDATE ORDEN_PRODUCCION SET cantidad=".$cantidad." WHERE cod_orden='".$codigo."';";
        $db->doQuery($query, UPDATE_QUERY);
        
        $db->disconnect();
    }

    public function getOrdenProduccion($codigo)
    {
        $db = new Database();
        $db->connect();
        
        $query = "SELECT * FROM ORDENES_PRODUCCION WHERE cod_orden_produccion='".$codigo."';";
        $db->doQuery($query, SELECT_QUERY);
        $trArr = $db->results[0];
        
        $pCodigo_orden = $trArr['cod_orden_produccion'];
        $pNom_producto = $trArr['nom_producto'];
        $pFecha_i = $trArr['fecha_inicio'];
        $pFecha_entrega = $trArr['fecha_entrega'];
        $pCosto_fabricacion = $trArr['costo_fabricacion'];
        $pCantidad = $trArr['cantidad'];
        $pAlmacen = $trArr['almacen'];
        $pEstado = $trArr['estado'];
        
        $OrProcc = new OrdenProduccion($pCodigo_orden, $pNom_producto, $pFecha_i, $pFecha_entrega, $pCosto_fabricacion, $pCantidad, $pAlmacen, $pEstado);
        
        $db->disconnect();
        
        return $OrProcc;
    }
    
    public function getOrdenProduccionByName($name)
    {
        $db = new Database();
        $db->connect();
        
        $query = "SELECT * FROM ORDENES_PRODUCCION WHERE nom_producto='".$name."';";
        $db->doQuery($query, SELECT_QUERY);
        $trArr = $db->results[0];
        
        $pCodigo_orden = $trArr['cod_orden_produccion'];
        $pNom_producto = $trArr['nom_producto'];
        $pFecha_i = $trArr['fecha_inicio'];
        $pFecha_entrega = $trArr['fecha_entrega'];
        $pCosto_fabricacion = $trArr['costo_fabricacion'];
        $pCantidad = $trArr['cantidad'];
        $pAlmacen = $trArr['almacen'];
        $pEstado = $trArr['estado'];
        
        $OrProcc = new OrdenProduccion($pCodigo_orden, $pNom_producto, $pFecha_i, $pFecha_entrega, $pCosto_fabricacion, $pCantidad, $pAlmacen, $pEstado);
        
        $db->disconnect();
        
        return $OrProcc;
    }

    public function save($nom_producto, $cantidad, $fechaI, $fechaE, $pCostoProduccion,$almacen, $estado)
    {
        $db = new Database();
        $db->connect();
        
        $query = "INSERT INTO ORDENES_PRODUCCION VALUES(0,'" .$nom_producto."', '".$fechaI."', '".$fechaE."', ".$pCostoProduccion.", ".$cantidad.", '".$almacen."', ".$estado.");";
        $db->doQuery($query, INSERT_QUERY); 
        

        $db->disconnect();
    }
    
    public function selectionarOrden($pCodigoproduccion)
    {
        $db = new Database();
        $db->connect();
        
        $query = "SELECT * FROM ORDEN_PRODUCCION WHERE cod_produccion = ".$pCodigoproduccion."";
        $db->doQuery($query, SELECT_QUERY);
        $trArr = $db->results;
        
        $orden = $trArr[0];
        
        $db->disconnect();
        
        return $orden;
    }
    
    public function listarInventarioInsumos()
    {
        $db = new Database();
        $db->connect();
        
        $query = "SELECT fecha, cantidad, nom_insumo, valor_insumo, iva_insumo, (cantidad*(valor_insumo+(valor_insumo*iva_insumo))) as total FROM INSUMO, INV_INSUMO WHERE INSUMO.cod_insumo = INV_INSUMO.cod_insumo;";
        $db->doQuery($query, SELECT_QUERY);
        $trArr = $db->results;
        
        $insumos = array();
        
        for ($i = 0; $i < sizeof($trArr); $i++)
        {
            $insumos[] = [
                "fecha" => $trArr[$i]['fecha'],
                "cantidad" => $trArr[$i]['cantidad'],
                "nom_insumo" => $trArr[$i]['nom_insumo'],
                "valor_insumo" => $trArr[$i]['valor_insumo'],
                "iva_insumo" => $trArr[$i]['iva_insumo'],
                "total" => $trArr[$i]['total']
            ];
        }
        
        $db->disconnect();
        
        return $insumos;
    }
    
    public  function obtenerInsumo($codInsumo)
    {
        $db = new Database();
        $db->connect();
        
        $query = "SELECT nom_insumo FROM INSUMO, INV_INSUMO WHERE INV_INSUMO.cod_inv_insumo = ".$codInsumo." AND INV_INSUMO.cod_insumo = INSUMO.cod_insumo";
        $db->doQuery($query, SELECT_QUERY);
        $trArr = $db->results;
        
        $nomInsumo = $trArr[0];
        
        $db->disconnect();
        
        return $nomInsumo;
    }
    
    public function listarOrdenesProduccion() 
    {
        $db = new Database();
        $db->connect();
        
        $query = "SELECT cod_orden_produccion, nom_producto, cantidad, fecha_inicio, fecha_entrega, almacen, estado FROM ORDENES_PRODUCCION";
        $db->doQuery($query, SELECT_QUERY);
        $trArr = $db->results;
        
        $ordenes = array();
        
        for ($i = 0; $i < sizeof($trArr); $i++)
        {
             $ordenes[] = [
                 "cod_orden" => $trArr[$i]['cod_orden_produccion'],
                 "cantidad" => $trArr[$i]['nom_producto'],
                 "producto_ar" => $trArr[$i]['cantidad'],
                 "fecha_entrega" => $trArr[$i]['fecha_inicio'],
                 "fecha_solicitud" => $trArr[$i]['fecha_entrega'],
                 "almacen_destino" => $trArr[$i]['almacen'],
                 "estado" => $trArr[$i]['estado']
             ];
        }
        
        $db->disconnect();
        
        return $ordenes;
    }
    
    public function obtenerCodUltimaFila() 
    {
        $db = new Database();
        $db->connect();
        
        $query = "SELECT * FROM ordenes_produccion ORDER BY cod_orden_produccion DESC LIMIT 1;";
        $db->doQuery($query, SELECT_QUERY);
        $trArr = $db->results;
        
        $codigo = $trArr[0]['cod_orden_produccion'];
        
        $db->disconnect();
        
        return $codigo;
    }
    
}

?>