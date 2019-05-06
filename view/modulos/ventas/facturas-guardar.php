<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/controller/DAO/implementation/ItemFacturaDAO.class.php');
echo '<script>alert("Estoy aca")</script>';

$data = json_decode(file_get_contents("php://input"),true);
print_r($data);

for ($i = 0; $i < sizeof($data); $i++) 
{
    $itemDAO = new ItemFacturaDAO();
    $itemDAO->save($data[$i]['description'], $data[$i]['description'], $data[$i]['qty']);
    
} 

?>