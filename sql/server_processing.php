<?php

/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

// DB table to use
$table = 'final_view';

// Table's primary key
$primaryKey = 'idmeta';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array('db' => 'idmeta', 'dt' => 0 ),
    array('db' => 'tipo', 'dt' => 1),
    array('db' => 'identificador',  'dt' => 2 ),
    array('db' => 'unidad',     'dt' => 3 ),
    array('db' => 'numero_indicador', 'dt'=> 4),
    array('db'  => 'indicador','dt' => 5),
    array('db'  => 'medida','dt' => 6),
    array('db'  => 'sf','dt' => 7),
    array('db'  => 'ai','dt' => 8),
    array('db'  => 'aie','dt' => 9),
    array('db'  => 'descripcion','dt' => 10),
    array('db'  => 'objetivo','dt' => 11),
    array('db'  => 'accion','dt' => 12),
    array('db'  => 'institucion','dt' => 13),
    array('db'  => 'instrumento','dt' => 14),
    array('db'  => 'nivel_mir','dt' => 15),
    array('db'  => 'tipo_instrumento','dt' => 16),
    array('db'  => 'subprograma','dt' => 17),
    array('db' => 'idmeta', 'dt' => 18 ),
    array('db'  => 'total','dt' => 19),
    array('db'  => 'ene','dt' => 20),
    array('db'  => 'feb','dt' => 21),
    array('db'  => 'mar','dt' => 22),
    array('db'  => 'abr','dt' => 23),
    array('db'  => 'may','dt' => 24),
    array('db'  => 'jun','dt' => 25),
    array('db'  => 'jul','dt' => 26),
    array('db'  => 'ago','dt' => 27),
    array('db'  => 'sep','dt' => 28),
    array('db'  => 'oct','dt' => 29),
    array('db'  => 'nov','dt' => 30),
    array('db'  => 'dic','dt' => 31)
);

// SQL server connection information
$sql_details = array(
	'user' => 'root',
	'pass' => '',
	'db'   => 'evaluacion',
	'host' => 'localhost'
);


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

require( 'ssp.class.php' );

echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);


