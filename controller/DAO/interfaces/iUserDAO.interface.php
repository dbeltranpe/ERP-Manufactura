<?php

/**
 * Interface que representa el Data Access Object (DAO) de los usuarios
 * @author Daniel Beltrán Penagos
 * 
 * <br><br>
 * <center> <b> Universidad El Bosque<br>
 * Ingeniería de Software<br>
 * Profesor Ricardo Camargo Lemos <br>
 * Proyecto E.R.P Bienes y Servicios de Manufactura</b> </center>
 */
interface iUserDAO
{
    /**
     * Guarda un usuario en la base de datos<br>
     * <b> post:</b> Se guardó el usuario en la base de datos<br>
     * @param usuario Usuario a guardar
     */
    public function save($usuario);
    
    /**
     * Obtiene un usuario en referencia al id por parámetro
     * @param number cod_usuario del usuario a buscar
     * @return usuario encontrado con las características del buscado
     */
    public function getUsuario($cod_usuario);
    
    
    /**
     * Modifica un usuario de la base de datos en referencia a su id<br>
     * <b> post:</b> Se modificó el usuario de la base de datos<br>
     * @param number cod_usuario usuario referencia a actualizar
     * @param String pPassword contraseña nueva
     */
    public function updateUsuario($cod_usuario, $pPassword);
    
    /**
     * Obtiene un usuario con respecto a su username y contraseña
     * @param userName Cadena de texto con el username del usuario
     * @param password Cadena de texto con la contraseña del usuario
     * @return Usuario usuario encontrado con las características del buscado
     */
    public function getUsuarioLogin($userName, $password);

    
    /**
     * Obtiene un usuario con respecto a su username
     * @param userName Cadena de texto con el username del usuario
     * @return Usuario usuario encontrado con las características del buscado
     */
    public function getUsuarioPorNombre($userName);
    
}

?>