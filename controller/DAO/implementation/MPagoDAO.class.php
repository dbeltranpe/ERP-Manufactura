<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/controller/database.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/model/MPago.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/controller/DAO/interfaces/iMPagoDAO.interface.php');

/**
 * Clase que representa el Data Access Object (DAO) del inventario de insumos
 * @author Daniel Beltrán Penagos
 * <br>
 * <center> <b> Universidad El Bosque<br>
 * Ingeniería de Software<br>
 * Profesor Ricardo Camargo Lemos <br>
 * Proyecto E.R.P Bienes y Servicios de Manufactura</b> </center>
 */
class MPagoDAO implements iMPagoDAO
{
    public function listarPagos()
    {
        $db = new Database();
        $db->connect();
        
        $query = "SELECT * FROM M_PAGO";
        $db->doQuery($query, SELECT_QUERY);
        $pagosArr = $db->results;
        
        $pagos = array();
        
        for ($i = 0; $i < sizeof($pagosArr); $i++) 
        {
            $pagos[] = [
                "cod_m_pago" => $pagosArr[$i]['cod_m_pago'],
                "nom_m_pago" => $pagosArr[$i]['nom_m_pago']
            ]; 
        }
        
        $db->disconnect();
        
        return $pagos;
    }
}
?>