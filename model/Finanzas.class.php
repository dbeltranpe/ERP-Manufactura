<?php

/**
 * Esta clase representa al inventario de un insumo del sistema E.R.P.
 * @author Daniel Beltrán Penagos
 * <br>
 * <center> <b> Universidad El Bosque<br>
 * Ingeniería de Software<br>
 * Profesor Ricardo Camargo Lemos <br>
 * Proyecto E.R.P Bienes y Servicios de Manufactura</b> </center>
 */
class Finanzas
{
    
    private $codigo;
    private $nombre;
    private $total;
    
    function Finanzas($pCodigo, $pNombre, $pTotal)
    {
        $this->codigo = $pCodigo;
        $this->nombre = $pNombre;
        $this->total = $pTotal;
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
    public function getTotal()
    {
        return $this->total;
    }
}

?>