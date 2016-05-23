<?php
require_once( "connect.php" );
set_time_limit( 0 );

$fecha_ac = isset( $_POST[ 'timestamp' ] ) ? (int)$_POST[ 'timestamp' ] : 0;

if( is_null( $fecha_ac ) ){
    die('nooo');
}

$fecha_bd = 0;

$testeo = 0;

if( $fecha_ac !== 0 ){
    while ( $fecha_bd <= $fecha_ac /*&& $testeo < 5*/ ) {
        $query3 = "SELECT * FROM mensajes ORDER BY timestamp DESC LIMIT 1";
        $pregunta = mysqli_query( $conn, $query3 ) or die( mysqli_error( $conn ) );
        $respuesta = mysqli_fetch_object( $pregunta );

        usleep(100000);
        clearstatcache();
        $fecha_bd  = @strtotime( $respuesta->timestamp );
        $testeo++;
    }
}

$query3 = "SELECT * FROM mensajes ORDER BY timestamp DESC LIMIT 1";
$pregunta = mysqli_query( $conn, $query3 ) or die( mysqli_error( $conn ) );
$respuesta = mysqli_fetch_object( $pregunta );

echo json_encode( array(
                      'timestamp' => @strtotime( $respuesta->timestamp ),
                      'mensaje'   => $respuesta->mensaje,
                      'ID'        => $respuesta->ID,
                      'posicion'  => $respuesta->posicion,
                      '$fecha_ac'  => $fecha_ac,
                      '$fecha_bd'  => $fecha_bd,
                      '$testeo'  => $testeo,
                      '$respuesta'  => $respuesta,
                  ) );