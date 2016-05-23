<?php
/*PHP CONSOLE*/
require_once('php-console/src/PhpConsole/__autoload.php');
$handler = PhpConsole\Handler::getInstance();
$handler->start();

function gafa($var, $tags = null) {
    PhpConsole\Connector::getInstance()->getDebugDispatcher()->dispatchDebug($var, $tags, 1);
}

$servername = "localhost";
$username = "socket";
$password = "socket";
$dbname = "socket";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
unset($servername,$username,$password,$dbname);