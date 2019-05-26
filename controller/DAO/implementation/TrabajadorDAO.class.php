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
    public function deleteTrabajador($cCod_trabajador, $cCod_usuario)
    {
        $db = new Database();
        $db->connect();

        $query = "DELETE FROM TRABAJADOR WHERE codigo_trabajador = $cCod_trabajador;";
        $db->doQuery($query, DELETE_QUERY);

        $queryX = "DELETE FROM USUARIO WHERE cod_usuario = $cCod_usuario;";
        $db->doQuery($queryX, DELETE_QUERY);

        $nomina = "SELECT sum(sueldo) as sumando FROM TRABAJADOR";
        $db->doQuery($nomina, SELECT_QUERY);
        $sueldos = $db->results[0]['sumando'];

        $nueva = "UPDATE FINANZAS SET total_proceso=$sueldos WHERE cod_proceso = 7";
        $db->doQuery($nueva, UPDATE_QUERY);

        $db->disconnect();
        return true;
    }

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
        $db->doQuery($query, UPDATE_QUERY);
        
        $db->disconnect();
    }

    public function updateTrabajadorDos($pCod_trabajador, $pCod_usuario, $pNombre, $pCorreo, $pTelefono, $pSueldo) {
     
     $db = new Database();
     $db->connect();
     $db->conn->set_charset("utf8");

     $pNombre = mysqli_real_escape_string($db->conn, $pNombre);

     $query = "UPDATE TRABAJADOR SET nombre_trabajador='" . $pNombre . "', correo_trabajador='" . $pCorreo . "', tel_trabajador='$pTelefono', sueldo=$pSueldo WHERE cod_usuario = " . $pCod_usuario . " and codigo_trabajador = $pCod_trabajador;";
     $db->doQuery($query, UPDATE_QUERY);

     $nomina = "SELECT sum(sueldo) as sumando FROM TRABAJADOR";
     $db->doQuery($nomina, SELECT_QUERY);
     $sueldos = $db->results[0]['sumando'];

     $nueva = "UPDATE FINANZAS SET total_proceso=$sueldos WHERE cod_proceso = 7";
     $db->doQuery($nueva, UPDATE_QUERY);

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
            "sueldo" => $trArr[$i]['sueldo'],
            "tel_trabajador" => $trArr[$i]['tel_trabajador'],
            "img_trabajador" => $trArr[$i]['img_trabajador']
        ];
    }

    $db->disconnect();

    return $trabajadores;
}
public function updateImg($pCod, $img)
{
    $db = new Database();
    $db->connect();

    $nueva = "UPDATE TRABAJADOR SET img_trabajador='$img' WHERE codigo_trabajador = $pCod";
    $db->doQuery($nueva, UPDATE_QUERY);
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