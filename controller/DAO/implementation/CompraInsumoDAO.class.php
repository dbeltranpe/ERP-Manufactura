<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/controller/database.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/model/CompraInsumo.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/controller/DAO/interfaces/iCompraInsumoDAO.interface.php');

/**
 * Clase que representa el Data Access Object (DAO) del inventario de insumos
 * @author Daniel Beltrán Penagos
 * <br>
 * <center> <b> Universidad El Bosque<br>
 * Ingeniería de Software<br>
 * Profesor Ricardo Camargo Lemos <br>
 * Proyecto E.R.P Bienes y Servicios de Manufactura</b> </center>
 */
class CompraInsumoDAO implements iCompraInsumoDAO
{
    public function listarComprasInsumo()
    {
        $db = new Database();
        $db->connect();
        
        $query = "SELECT * FROM COMPRA_INSUMO";
        $db->doQuery($query, SELECT_QUERY);
        $comArr = $db->results;
        
        $Compras = array();
        
        for ($i = 0; $i < sizeof($comArr); $i++) 
        {
            $Compras[] = [
                "cod_com_insumo" => $comArr[$i]['cod_com_insumo'],
                "cod_compra" => $comArr[$i]['cod_compra'],
                "nom_insumo" => $comArr[$i]['nom_insumo'],
                "cantidad_compra" => $comArr[$i]['cantidad_compra'],
                "precio_insumo" => $comArr[$i]['precio_insumo'],
                "precio_total" => $comArr[$i]['precio_total']
            ]; 
        }
        
        $db->disconnect();
        
        return $Compras;
    }
    public function save($ComprarInsumo)
    {}

}
?>