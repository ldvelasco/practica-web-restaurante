<?php
/*
Insertar los pedidos en la bd, envia correos de confirmacion y muestra mensajes de erroro éxito 
*/

require_once 'database/bd.php';
require_once 'correo.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit;
}

function insertarPedidos($CodPed, $fecha, $enviado, $peso, $restaurante) {
    $sql = '\INSERT INTO Pedidos (CodPed, fecha, enviado, peso, restaurante) VALUES (?,?,?,?,?)';
    $pdo = conexion();
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$CodPed, $fecha, $enviado, $peso, $restaurante]);
    // correoDeConfirmacion();
}

?>