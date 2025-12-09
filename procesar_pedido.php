<?php
/*
Insertar los pedidos en la bd, envia correos de confirmacion y muestra mensajes de erroro éxito 
*/

require_once 'database/bd.php';
require_once 'correo.php';
session_start();
$carrito = $_SESSION["carrito"];
$fecha = date("Y-m-d");

foreach ($carrito as $producto){
    insertarPedidos($fecha, true, 0, "madrid1@empresa.com");
}

function insertarPedidos($fecha, $enviado, $peso, $restaurante) {
    $sql = '\INSERT INTO Pedidos (CodPed, fecha, enviado, peso, restaurante) VALUES (?,?,?,?,?)';
    $pdo = conexion();
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$CodPed, $fecha, $enviado, $peso, $restaurante]);
    // correoDeConfirmacion();
}

?>
