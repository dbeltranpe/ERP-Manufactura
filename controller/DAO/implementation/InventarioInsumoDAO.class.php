<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/controller/database.class.php');
require($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/model/InventarioInsumo.class.php');
require($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/controller/DAO/interfaces/iInventarioInsumoDAO.interface.php');

/**
 * Clase que representa el Data Access Object (DAO) del inventario de insumos
 * @author Daniel Beltrán Penagos
 * <br>
 * <center> <b> Universidad El Bosque<br>
 * Ingeniería de Software<br>
 * Profesor Ricardo Camargo Lemos <br>
 * Proyecto E.R.P Bienes y Servicios de Manufactura</b> </center>
 */
class InventarioInsumoDAO implements iInventarioInsumoDAO
{
    
    public function deleteInventarioInsumo($codigo)
    {
        $db = new Database();
        $db->connect();
       
        $query = "DELETE FROM INV_INSUMO  WHERE cod_insumo='".$codigo."';";
        $db->doQuery($query, DELETE_QUERY);
        
        $db->disconnect();
       
    }

    public function updateInventarioInsumo($codigo, $cantidad)
    {
        $db = new Database();
        $db->connect();
       
        $query = "UPDATE INV_INSUMO SET cantidad=".$cantidad." WHERE cod_insumo='".$codigo."';";
        $db->doQuery($query, UPDATE_QUERY);
        
        $db->disconnect();
    }

    public function getInventarioInsumo($codigo)
    {
        $db = new Database();
        $db->connect();
        
        $query = "SELECT * FROM INV_INSUMO WHERE cod_insumo='".$codigo."';";
        $db->doQuery($query, SELECT_QUERY);
        $trArr = $db->results[0];
        
        $pCodigoInsumo = $trArr['cod_insumo'];
        $pCantidad = $trArr['cantidad'];
        $pFecha = $trArr['fecha'];
        
        $InvIns = new InventarioInsumo($pCodigoInsumo, $pCantidad, $pFecha);
        
        $db->disconnect();
        
        return $InvIns;
    }

    public function save($pCodigoInsumo, $pCantidad)
    {
        $db = new Database();
        $db->connect();
        
        $invInsumo = $this->getInventarioInsumo($pCodigoInsumo);
        
        if($invInsumo->getCodigoInsumo() == null)
        {            
            $query = "INSERT INTO INV_INSUMO VALUES(0,".$pCodigoInsumo.", ".$pCantidad.", SYSDATE());";
            $db->doQuery($query, INSERT_QUERY);    
        }
        else
        {
            $cantidad = $pCantidad + $invInsumo->getCantidad();
            $this->updateInventarioInsumo($pCodigoInsumo, $cantidad);
        }
        
        $db->disconnect();
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

   
}

?>