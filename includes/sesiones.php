<?php
$usuario_valido = "madrid1@empresa.com";
$password_valido = "1234";

session_start();

$usuario = $_POST['usuario'] ?? '';
$password = $_POST['password'] ?? '';
$recordarme = isset($_POST['recordarme']);

if ($usuario === $usuario_valido && $password === $password_valido) {
    $_SESSION["usuario"] = $usuario;
    $_SESSION["codRes"] = 1;
    if ($recordarme) {
        setcookie("usuario", $usuario, time() + (86400 * 7), "/"); 
    } else {
        setcookie("usuario", $usuario, 0, "/"); 
    }
    header("Location: categorias.php");
    exit();
} else {
    header("Location: login.php");
    exit();
}
