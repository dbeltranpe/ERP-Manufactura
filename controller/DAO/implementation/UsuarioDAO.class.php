<?php
require($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/controller/database.class.php');
require($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/model/Usuario.class.php');
require($_SERVER['DOCUMENT_ROOT'].'/erpbienesyservicios/controller/DAO/interfaces/iUserDAO.interface.php');

/**
 * Clase que representa el Data Access Object (DAO) de los usuarios
 * @author Daniel Beltrán Penagos
 * <br>
 * <center> <b> Universidad El Bosque<br>
 * Ingeniería de Software<br>
 * Profesor Ricardo Camargo Lemos <br>
 * Proyecto E.R.P Bienes y Servicios de Manufactura</b> </center>
 */
class UsuarioDAO implements iUserDAO
{

    public function save($usuario)
    {
     
    }

    public function getUsuario($cod_usuario)
    {
        
    }

    public function getUsuarioLogin($userName, $password)
    {
        $db = new Database();
        $db->connect();
        
        $query = "SELECT * FROM USUARIO WHERE username_usuario='".$userName."' AND password_usuario='".$password."';";
        $db->doQuery($query, SELECT_QUERY);
        $usArr = $db->results[0];
        
        $pCodUsuario = $usArr['cod_usuario'];
        $pUsername = $usArr['username_usuario'];
        $pPassword = $usArr['password_usuario'];
        $pRol = $usArr['cod_rol'];
        
        $usuario = new Usuario($pCodUsuario, $pUsername, $pPassword, $pRol);
        
        $db->disconnect();
        
        return $usuario;
    }

    public function updateUsuario($cod_usuario)
    {}

    public function getUsuarioPorNombre($userName)
    {
        $db = new Database();
        $db->connect();
        
        $query = "SELECT * FROM USUARIO WHERE username_usuario='".$userName."'";
        $db->doQuery($query, SELECT_QUERY);
        $usArr = $db->results[0];
        
        $pCodUsuario = $usArr['cod_usuario'];
        $pUsername = $usArr['username_usuario'];
        $pPassword = $usArr['password_usuario'];
        $pRol = $usArr['cod_rol'];
        
        $usuario = new Usuario($pCodUsuario, $pUsername, $pPassword, $pRol);
        
        $db->disconnect();
        
        return $usuario;
        
    }

    
   
}

?>