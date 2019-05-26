<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/controller/database.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/model/Trabajador.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/controller/DAO/interfaces/iTrabajadorDAO.interface.php');

/**
* 25xN9KMCwh/SU *
 * Clase que representa el Data Access Object (DAO) de los trabajadores
 * @author Daniel Beltrán Penagos
 * <br>
 * <center> <b> Universidad El Bosque<br>
 * Ingeniería de Software<br>
 * Profesor Ricardo Camargo Lemos <br>
 * Proyecto E.R.P Bienes y Servicios de Manufactura</b> </center>
 */
class TrabajadorDAO implements iTrabajadorDAO
{
    public function deleteTrabajador($cod_trabajador)
    {}

    public function save($trabajador)
    {}

    public function getTrabajador($cod_usuario)
    {
        $db = new Database();
        $db->connect();
        
        $query = "SELECT * FROM TRABAJADOR WHERE cod_usuario='".$cod_usuario."';";
        $db->doQuery($query, SELECT_QUERY);
        $trArr = $db->results[0];
        
        $pNombre = $trArr['nombre_trabajador'];
        $pCorreo = $trArr['correo_trabajador'];
        $pImagen = $trArr['img_trabajador'];
        
        $trabajador = new Trabajador($pNombre, $pCorreo, $pImagen);
        
        
        $db->disconnect();
        
        return $trabajador;
        
    }

    public function updateTrabajador($cod_usuario, $pNombre, $pCorreo)
    {
        $db = new Database();
        $db->connect();
        $db->conn->set_charset("utf8");
        
        $pNombre = mysqli_real_escape_string($db->conn, $pNombre);
       
        $query = "UPDATE TRABAJADOR SET nombre_trabajador='" . $pNombre . "', correo_trabajador='" . $pCorreo . "' WHERE cod_usuario = " . $cod_usuario . "; ";
        $db->doQuery($query, SELECT_QUERY);
        
        $db->disconnect();
    }

    public function listarTrabajadores()
    {
        $db = new Database();
        $db->connect();
        
        $query = "SELECT * FROM TRABAJADOR";
        $db->doQuery($query, SELECT_QUERY);
        $trArr = $db->results;

        $codigo = $trArr[0]['cod_usuario'];

        $queryX = "SELECT * FROM USUARIO";
        $db->doQuery($queryX, SELECT_QUERY);
        $usArr = $db->results;
        
        $trabajadores = array();
        
        for ($i = 0; $i < sizeof($trArr); $i++)
        {
            $trabajadores[] = [
                "codigo_trabajador" => $trArr[$i]['codigo_trabajador'],
                "cod_usuario" => $trArr[$i]['cod_usuario'],
                "nombre_trabajador" => $trArr[$i]['nombre_trabajador'],
                "username_usuario" => $usArr[$i]['username_usuario'],
                "correo_trabajador" => $trArr[$i]['correo_trabajador'],
                "tel_trabajador" => $trArr[$i]['tel_trabajador'],
                "img_trabajador" => $trArr[$i]['img_trabajador']
            ];
        }
        
        $db->disconnect();
        
        return $trabajadores;
    }
    
    public function totalTrabajadores(){
        
        $db = new Database();
        $db->connect();
        
        $query = "SELECT COUNT(trabajador.codigo_trabajador) total FROM TRABAJADOR;";
        $db->doQuery($query, SELECT_QUERY);
        $proCom = $db->results;
        
        $db->disconnect();
        
        return $proCom[0]['total'];
        
    }
}
?>