<?php

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
    {}

    public function getUsuario($cod_usuario)
    {}

    public function getUsuarioLogin($userName, $password)
    {}

    public function updateUsuario($cod_usuario)
    {}

    public function getUsuarioPorNombre($userName)
    {}

    
   
}

?>