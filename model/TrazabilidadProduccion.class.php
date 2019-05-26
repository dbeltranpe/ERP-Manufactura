<?php

/**
 * Esta clase representa La tarzabilidad de la producción
 * @author Santiago Correa Vera
 * <br>
 * <center> <b> Universidad El Bosque<br>
 * Ingeniería de Software<br>
 * Profesor Ricardo Camargo Lemos <br>
 * Proyecto E.R.P Bienes y Servicios de Manufactura</b> </center>
 */
class TrazabilidadProduccion
{

    private $codigo;
    private $accion;
    private $num_orden;
    private $nom_producto;
    private $cantidad_producto;
    private $costo;
    private $fecha;
    
    
    public function TrazabilidadProduccion($pCodigo, $pAccion, $pNum_Orden, $pNom_producto, $pCant_producto, $pCosto,$pFecha)
    {
        $this->codigo = $pCodigo;
        $this->accion = $pAccion;
        $this->num_orden = $pNum_Orden;
        $this->nom_producto = $pNom_producto;
        $this->cantidad_producto = $pCant_producto;
        $this->costo = $pCosto;
        $this->fecha = $pFecha;
    }
    
    /**
     * @return mixed
     */
    public function getNom_producto()
    {
        return $this->nom_producto;
    }

    /**
     * @return mixed
     */
    public function getCantidad_producto()
    {
        return $this->cantidad_producto;
    }

    /**
     * @return mixed
     */
    public function getCosto()
    {
        return $this->costo;
    }

    /**
     * @param mixed $nom_producto
     */
    public function setNom_producto($nom_producto)
    {
        $this->nom_producto = $nom_producto;
    }

    /**
     * @param mixed $cantidad_producto
     */
    public function setCantidad_producto($cantidad_producto)
    {
        $this->cantidad_producto = $cantidad_producto;
    }

    /**
     * @param mixed $costo
     */
    public function setCosto($costo)
    {
        $this->costo = $costo;
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
    public function getAccion()
    {
        return $this->accion;
    }

    /**
     * @return mixed
     */
    public function getNum_orden()
    {
        return $this->num_orden;
    }

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param mixed $codigo
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    /**
     * @param mixed $accion
     */
    public function setAccion($accion)
    {
        $this->accion = $accion;
    }

    /**
     * @param mixed $num_orden
     */
    public function setNum_orden($num_orden)
    {
        $this->num_orden = $num_orden;
    }

    /**
     * @param mixed $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }
    
}
?>