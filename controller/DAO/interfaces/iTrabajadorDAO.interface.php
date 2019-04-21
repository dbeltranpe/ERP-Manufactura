<?php

/**
 * Interface que representa el Data Access Object (DAO) de los trabajadores
 * @author Daniel Beltrán Penagos
 *
 * <br><br>
 * <center> <b> Universidad El Bosque<br>
 * Ingeniería de Software<br>
 * Profesor Ricardo Camargo Lemos <br>
 * Proyecto E.R.P Bienes y Servicios de Manufactura</b> </center>
 */
interface iTrabajadorDAO
{
    /**
     * Guarda un trabajador en la base de datos<br>
     * <b> post:</b> Se guardó el trabajador en la base de datos<br>
     * @param trabajador trabajador a guardar
     */
    public function save($trabajador);
    
    /**
     * Obtiene un trabajador en referencia al id por parámetro
     * @param number cod_usuario del trabajador a buscar
     * @return Trabajador encontrado con las características del buscado
     */
    public function getTrabajador($cod_usuario);
    
    
    /**
     * Modifica un trabajador de la base de datos en referencia a su id<br>
     * <b> post:</b> Se modificó el trabajador de la base de datos<br>
     * @param number cod_usuario trabajador referencia a actualizar
     * @param String pNombre Nuevo nombre del Trabajador
     * @param String pCorreo Nuevo Correo del trabajador
     */
    public function updateTrabajador($cod_usuario, $pNombre, $pCorreo);
    
    /**
     * Elimina un trabajador de la base de datos en referencia a su id<br>
     * <b> post:</b> Se eliminó el trabajador de la base de datos<br>
     * @param number cod_trabajador trabajador referencia a actualizar
     */
    public function deleteTrabajador($cod_trabajador);
    
    
}

?>