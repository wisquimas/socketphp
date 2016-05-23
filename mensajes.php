<?php
require_once('connect.php');

$q = "SELECT * FROM mensajes";
$res = mysqli_query($conn,$q) or die( mysqli_error($conn) );

while( $timi = mysqli_fetch_object( $res ) ){
    echo $timi->mensaje.'<br/>';
}