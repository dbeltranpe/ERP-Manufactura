<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/controller/DAO/implementation/ItemFacturaDAO.class.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/controller/DAO/implementation/FacturaDAO.class.php');

$data = json_decode(file_get_contents("php://input"),true);
print_r($data);

$nomCliente = $data[1]['nomCliente'];
$ccNit = $data[1]['ccNit'];
$direccion = $data[1]['direccion'];
$telefono = $data[1]['telefono'];
$medio = $data[1]['medio'];

// $subtotal = $_POST['subtotal'];
// $iva = $_POST['iva'];
// $total = $_POST['total'];

$facturaDAO = new FacturaDAO();
$facturaDAO->save($nomCliente, $ccNit, $direccion, $telefono, $medio, 0, 0, 0);

for ($i = 0; $i < sizeof($data); $i++) 
{
    $itemDAO = new ItemFacturaDAO();
    $itemDAO->save($data[0][$i]['description'], $data[0][$i]['description'], $data[0][$i]['qty']);
    
} 

?>