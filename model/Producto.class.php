<?php

/**
 * Esta clase representa un producto terminado del sistema E.R.P.
 * @author Daniel Beltrán Penagos
 * <br>
 * <center> <b> Universidad El Bosque<br>
 * Ingeniería de Software<br>
 * Profesor Ricardo Camargo Lemos <br>
 * Proyecto E.R.P Bienes y Servicios de Manufactura</b> </center>
 */
class Producto
{

    private $codigo;
    private $nombre;
    private $valor;
    private $iva;
    
    public function Producto($pCodigo, $pNombre, $pValor, $pIva)
    {
        $this->codigo = $pCodigo;
        $this->nombre = $pNombre;
        $this->valor = $pValor;
        $this->iva = $pIva;
    }
    
    /**
     * @return mixed
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @return mixed
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * @return mixed
     */
    public function getIva()
    {
        return $this->iva;
    }

 
    
    


}

?>