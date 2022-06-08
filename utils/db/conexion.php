<?php

$servidor = 'localhost';
$usuario = 'root';
$clave = '';
$base = 'user-system';

$conexion = mysqli_connect($servidor, $usuario, $clave, $base);

function clean_data($data, $db_conexion) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    if ($db_conexion) {
        $data = mysqli_real_escape_string($db_conexion, $data);
    }
    return $data;
};

?>