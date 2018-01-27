<?php
header( 'Content-Type: application/json' );
$btc_array = json_decode( file_get_contents( '../data.json' ) );

$response = array(
	'echo'     => 1,
	'filtered' => count( $btc_array ),
	'data'     => $btc_array
);

echo json_encode( $response );
