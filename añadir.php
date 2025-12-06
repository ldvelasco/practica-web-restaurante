<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// ---- recibir datos ----
$cod  = isset($_POST['codigo']) ? (int)$_POST['codigo'] : 0;
$unidades = isset($_POST['unidades']) ? (int)$_POST['unidades'] : 0;
$categoria = isset($_POST['categoria']) ? (int)$_POST['categoria'] : 0;

if ($cod <= 0 || $unidades <= 0 || $categoria <= 0) {
    header("Location: productos.php?categoria=$categoria");
    exit;
}

$clave = $categoria . "-" . $cod;

// ---- añadir al carrito ----
if (!isset($_SESSION['carrito'])) $_SESSION['carrito'] = [];
$_SESSION['carrito'][$clave] = ($_SESSION['carrito'][$clave] ?? 0) + $unidades;

// ---- volver a la lista ----
header("Location: productos.php?categoria=$categoria");
exit;
?>
