<?php


$table = 'v_factura';
$primaryKey = 'cod_factura';

$columns = array(
	array(
		'db' => 'cod_factura',
		'dt' => 'DT_RowId',
		'formatter' => function( $d, $row ) {
			return 'row_'.$d;
		}
	),
	
	array( 'db' => 'cod_factura', 'dt' => 'cod_factura' ),
	array( 'db' => 'nom_cli_factura',  'dt' => 'nom_cli_factura' ),
	array( 'db' => 'cc_nit_factura',   'dt' => 'cc_nit_factura' ),
	array( 'db' => 'dir_factura',     'dt' => 'dir_factura' ),
	array( 'db' => 'tel_factura', 'dt' => 'tel_factura' ),
	array( 'db' => 'nom_m_pago',  'dt' => 'nom_m_pago' ),
	array(
	    'db'        => 'subtotal',
	    'dt'        => 'subtotal',
	    'formatter' => function( $d, $row ) {
	    return '$'.number_format($d);
	    }
	    ),
    array(
        'db'        => 'iva',
        'dt'        => 'iva',
        'formatter' => function( $d, $row ) {
        return '$'.number_format($d);
    }
    ),
    array(
        'db'        => 'total',
        'dt'        => 'total',
        'formatter' => function( $d, $row ) {
        return '$'.number_format($d);
    }
    ),
	array(
		'db'        => 'fecha',
		'dt'        => 'fecha',
		'formatter' => function( $d, $row ) {
			return date( 'jS M y', strtotime($d));
		}
	)
	
);

$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db' => 'erp',
    'host' => 'localhost'
);

require ('ssp.class.php');
echo json_encode(SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns));

?>
