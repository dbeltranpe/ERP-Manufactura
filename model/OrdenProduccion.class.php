<?php

/**
 * Esta clase representa a las Ordenes de producción del sistema E.R.P.
 * @author Santiago Correa Vera
 * <br>
 * <center> <b> Universidad El Bosque<br>
 * Ingeniería de Software<br>
 * Profesor Ricardo Camargo Lemos <br>
 * Proyecto E.R.P Bienes y Servicios de Manufactura</b> </center>
 */
class OrdenProduccion
{
    
    private $cod_orden_produccion;
    private $nom_producto;
    private $fecha_inicio;
    private $fecha_entrega;
    private $costo_fabricacion;
    private $cantidad;
    private $almacen;
    private $estado;
    
    function OrdenProduccion($pCod_orden, $pNombre_porducto, $pFecha_inicio, $pFecha_entrega, $pCosto_fabricacion, $pCantidad, $pAlmacen, $pEstado)
    {
        $this->cod_orden_produccion = $pCod_orden;
        $this->nom_producto = $pNombre_porducto;
        $this->fecha_inicio = $pFecha_inicio;
        $this->fecha_entrega = $pFecha_entrega;
        $this->costo_fabricacion = $pCosto_fabricacion;
        $this->cantidad = $pCantidad;
        $this->almacen = $pAlmacen;
        $this->estado = $pEstado;
    }
    
    /**
     * @return mixed
     */
    public function getCod_orden_produccion()
    {
        return $this->cod_orden_produccion;
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
    public function getFecha_inicio()
    {
        return $this->fecha_inicio;
    }

    /**
     * @return mixed
     */
    public function getFecha_entrega()
    {
        return $this->fecha_entrega;
    }

    /**
     * @return mixed
     */
    public function getCosto_fabricacion()
    {
        return $this->costo_fabricacion;
    }

    /**
     * @return mixed
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * @return mixed
     */
    public function getAlmacen()
    {
        return $this->almacen;
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param mixed $cod_orden_produccion
     */
    public function setCod_orden_produccion($cod_orden_produccion)
    {
        $this->cod_orden_produccion = $cod_orden_produccion;
    }

    /**
     * @param mixed $nom_producto
     */
    public function setNom_producto($nom_producto)
    {
        $this->nom_producto = $nom_producto;
    }

    /**
     * @param mixed $fecha_inicio
     */
    public function setFecha_inicio($fecha_inicio)
    {
        $this->fecha_inicio = $fecha_inicio;
    }

    /**
     * @param mixed $fecha_entrega
     */
    public function setFecha_entrega($fecha_entrega)
    {
        $this->fecha_entrega = $fecha_entrega;
    }

    /**
     * @param mixed $costo_fabricacion
     */
    public function setCosto_fabricacion($costo_fabricacion)
    {
        $this->costo_fabricacion = $costo_fabricacion;
    }

    /**
     * @param mixed $cantidad
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }

    /**
     * @param mixed $almacen
     */
    public function setAlmacen($almacen)
    {
        $this->almacen = $almacen;
    }

    /**
     * @param mixed $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

}

?>