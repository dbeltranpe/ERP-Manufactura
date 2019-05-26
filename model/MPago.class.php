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
class MPago
{
    var $codigo;
    
    var $nom_mpago;

    function MPago($pCodigo, $pNom_mpago)
    {
        $this->codigo = $pCodigo;
        $this->nom_mpago = $pNom_mpago;
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
    public function getNomMPago()
    {
        return $this->nom_mpago;
    }
}
?>