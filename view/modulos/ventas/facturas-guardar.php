<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/controller/DAO/implementation/ItemFacturaDAO.class.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/controller/DAO/implementation/FacturaDAO.class.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/controller/DAO/implementation/InventarioProductoDAO.class.php');

$data = json_decode(file_get_contents("php://input"),true);

$nomCliente = $data[1]['nomCliente'];
$ccNit = $data[1]['ccNit'];
$direccion = $data[1]['direccion'];
$telefono = $data[1]['telefono'];
$medio = $data[1]['medio'];

$subtotal = $data[2]['subtotal'];
$iva = $data[2]['iva'];
$total = $data[2]['total'];

$invDAO = new InventarioProductoDAO();
$inventarioActual = $invDAO->listarInventarioPorNombre();
$facturable = true;
$mensaje = "";

for ($i = 0; $i < sizeof($data[0]); $i++)
{
    $key = array_search($data[0][$i]['description'], array_column($inventarioActual, 'cod_producto'));
    $cantInv = (int) $inventarioActual[$key]['cantidad'];
    $cantFac = (int) $data[0][$i]['qty'];
    
    if($cantInv < $cantFac)
    {
        $facturable=false;
        $mensaje.="No hay suficientes ". ($inventarioActual[$key]['nombre']) ." en el inventario \n";
    }
} 

if($facturable==true)
{
    $facturaDAO = new FacturaDAO();
    $facturaDAO->save($nomCliente, $ccNit, $direccion, $telefono, $medio, $subtotal, $iva, $total);
    
    $codFactura = $facturaDAO->getCodFactura($nomCliente, $ccNit, $direccion, $telefono, $medio, $subtotal, $iva, $total);
    
    for ($i = 0; $i < sizeof($data[0]); $i++)
    {
        $itemDAO = new ItemFacturaDAO();
        $itemDAO->save($codFactura, $data[0][$i]['description'], $data[0][$i]['qty']);
        
        $key = array_search($data[0][$i]['description'], array_column($inventarioActual, 'cod_producto'));
        $invDAO = new InventarioProductoDAO();
        $invDAO->save($data[0][$i]['description'], ($data[0][$i]['qty']*-1));
        

    }
    
    $mensaje.="Se ha registrado la factura";
    echo $mensaje;
}
else 
{
    echo $mensaje;
}

?>