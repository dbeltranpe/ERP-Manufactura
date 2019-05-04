<?php
if (!defined("CONN_ERROR")) define("CONN_ERROR", "Error connecting DB");
if (!defined("NO_DATA")) define("NO_DATA", 0);
if (!defined("BAD_QUERY")) define("BAD_QUERY", 1);
if (!defined("INSERT_OK")) define("INSERT_OK", 2);
if (!defined("DELETE_OK")) define("DELETE_OK", 3);
if (!defined("UPDATE_OK")) define("UPDATE_OK", 4);
if (!defined("QUERY_OK")) define("QUERY_OK", 5);
if (!defined("SELECT_QUERY")) define("SELECT_QUERY", 1);
if (!defined("INSERT_QUERY")) define("INSERT_QUERY", 2);
if (!defined("DELETE_QUERY")) define("DELETE_QUERY", 3);
if (!defined("UPDATE_QUERY")) define("UPDATE_QUERY", 4);

// define("CONN_ERROR","Error connecting DB");
// define("NO_DATA",0);
// define("BAD_QUERY",1);
// define("INSERT_OK",2);
// define("DELETE_OK",3);
// define("UPDATE_OK",4);
// define("QUERY_OK",5);
// define("SELECT_QUERY",1);
// define("INSERT_QUERY",2);
// define("DELETE_QUERY",3);
// define("UPDATE_QUERY",4);

/**
 * Clase que representa la conexión con la base de datos
 * @author Daniel Beltrán Penagos
 * <br>
 * <center> <b> Universidad El Bosque<br>
 * Ingeniería de Software<br>
 * Profesor Ricardo Camargo Lemos <br>
 * Proyecto E.R.P Bienes y Servicios de Manufactura</b> </center>
 */
class Database
{
    /**
     * Atributo de conexión con la base de datos
     */
    var $conn;
    
    /**
     * Usuario de la base de datos
     */
    var $user;
    
    /**
     * Contraseña del usuario de la base de datos
     */
    var	$pwd;
    
    /**
     * Nombre de la base de datos
     */
    var $db;
    
    /**
     * Resultados de consulta
     */
    var $results;
    
    /**
     * Filas dadas por consulta
     */
    var $rows;
    
    /**
     * Arreglo de mensajes
     */
    var $messages;
    
    /**
     * URL
     */
    var $path;
    
    /**
     * Host de la base de datos
     */
    var $host;
    
    /**
     * Constructor de la clase Database
     * @author Daniel Beltrán Penagos
     */
    function Database()
    {
        $this->conn = null;
        $this->results = null;
        $this->db = "erp";
        $this->user = "root";
        $this->pwd = "";
        $this->host = "localhost";
        $this->path = "http://localhost/erpbienesyservicios";
        $this->rows = 0;
        $this->messages = array("Error en la conexi&oacute;n","No se pudo realizar la operaci&oacute;n, comun&iacute;quese con el administrador");
        $this->connect();
    }
    
    /**
     * Conecta a la base de datos<br>
     * <b> pre:</b> Se han inicializado los atributos (host,user,pwd) con los valores de la base de datos
     * @return boolean|NULL donde se establece el valor de la conexión
     * @author Daniel Beltrán Penagos
     */
    function connect()
    {
        $this->conn = new mysqli($this->host, $this->user, $this->pwd, $this->db);
       
        if (!$this->conn)
        {
            die($this->messages[CONN_ERROR]);
            return false;
        }
        
        return $this->conn;
    }
    
    /**
     * Ejecuta un comando sql a la base de datos<br>
     * <b> pre:</b> Se ha establecido la conexión con la base de datos<br>
     * <b> post:</b> En caso del DML a excepción del SELECT se afectará la base de datos
     * @param String $query Comando sql a ejecutar
     * @param String $type Tipo de query
     * @return boolean donde true si se ejecutó, de lo contrario false
     * @author Daniel Beltrán Penagos
     */
    function doQuery($query,$type)
    {
        $this->results=null;
        
        if (!$execute = $this->conn->query($query))
        {
            die('Invalid query: '.utf8_encode($query).'-'. $this->conn->error);
            return null;
        }
        else
        {
            switch($type)
            {
                case SELECT_QUERY:
                    $this->rows = $execute->num_rows;
                 
                    $i = 0;
                    while ($i < $this->rows)
                    {
                        $this->results[$i] = $execute->fetch_assoc();
                        $i++;
                    }
                    return true;
                    break;
                case INSERT_QUERY:
                    return true;
                    break;
                case UPDATE_QUERY:
                    return true;
                    break;
                case DELETE_QUERY:
                    return true;
                    break;
            }
        }
    }
    
    
    function doQueryPaginator($execute){
        $this->results = null;
        mysql_query("SET NAMES utf8");
        if($execute)
        {
            $this->rows = mysql_num_rows($execute);
            
            $i = 0;
            while ($i < $this->rows)
            {
                $this->results[$i] = mysql_fetch_assoc($execute);
                $i++;
            }
        }
    }
    
    /**
     * Retorna la cantidad de fila de los resultados 
     * @return number con la cantidad de fila de los resultados 
     * @author Daniel Beltrán Penagos
     */
    function getNumResults()
    {
        return $this->rows;
    }
    
    /**
     * Retorna los resultados de un query
     * @return array con los resultados de un query
     * @author Daniel Beltrán Penagos
     */
    function getResults()
    {
        return $this->results;
    }
    
    /**
     * Recupera el ID generado por la consulta anterior (normalmente INSERT) para una columna AUTO_INCREMENT
     * @return number con el id generado
     * @author Daniel Beltrán Penagos
     */
    function getLastId()
    {
        return mysql_insert_id($this->conn);
    }
    
    /**
     * Desconecta la base de datos
     * @author Daniel Beltrán Penagos
     */
    function disconnect()
    {
        if($this->conn)
            $this->conn->close();
    }
       
}
?>