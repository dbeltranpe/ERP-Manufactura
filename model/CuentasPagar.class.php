<?php

/**
 * Esta clase representa a un usuario del sistema E.R.P.
 * @author Daniel Beltrán Penagos
 * <br>
 * <center> <b> Universidad El Bosque<br>
 * Ingeniería de Software<br>
 * Profesor Ricardo Camargo Lemos <br>
 * Proyecto E.R.P Bienes y Servicios de Manufactura</b> </center>
 */
class CuentasPagar
{
    var $codigo;
    
    var $codigo_factura;

    var $valor_factura;

    var $f_pago;

    var $fecha;

    var $estado;

    function CuentasPagar($pCodigo, $pCodigo_factura, $pValor_factura, $F_pago, $pPrecio, $pFecha, $pEstado)
    {
        $this->codigo = $pCodigo;
        $this->codigo_factura = $pCodigo_factura;
        $this->valor_factura = $pValor_factura;
        $this->f_pago = $F_pago;
        $this->fecha = $pFecha;
        $this->estado = $pEstado;
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
    public function getCodigoFactura()
    {
        return $this->codigo_factura;
    }

    /**
     * @return mixed
     */
    public function getValorFactura()
    {
        return $this->valor_factura;
    }

    /**
     * @return mixed
     */
    public function getFPago()
    {
        return $this->f_pago;
    }

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }
}
?>