<?php
require_once('connect.php');

$texto = isset($_POST['texto']) ? $_POST['texto'] : '';

$time = @date('Y-m-d H:i:s');

$q = "INSERT INTO mensajes VALUES ('','$texto','$time','1')";

$res = mysqli_query($conn,$q) or die(mysqli_error($conn));

header("Location: formulario.php");