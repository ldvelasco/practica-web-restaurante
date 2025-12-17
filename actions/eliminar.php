<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// ---- recibir datos ----
$clave = isset($_POST['cod']) ? $_POST['cod'] : '';
$unidades = isset($_POST['unidades']) ? (int)$_POST['unidades'] : 0;

if (empty($clave) || $unidades <= 0) {
    header("Location: carrito.php");
    exit();
}

// ---- eliminar del carrito ----
if (isset($_SESSION['carrito'][$clave])) {
    $_SESSION['carrito'][$clave] -= $unidades;
    
    // Si las unidades llegan a 0 o menos, eliminar completamente el producto
    if ($_SESSION['carrito'][$clave] <= 0) {
        unset($_SESSION['carrito'][$clave]);
    }
}

// ---- volver al carrito ----
header("Location: carrito.php");
exit();
?>
