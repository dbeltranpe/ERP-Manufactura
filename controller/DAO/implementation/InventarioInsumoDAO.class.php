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
    
    public function deleteInventarioInsumos($codigo)
    {}

    public function updateInventarioInsumos($codigo, $cantidad)
    {}

    public function getInventarioInsumos($codigo)
    {}

    public function save($codigo)
    {}

   
}

?>