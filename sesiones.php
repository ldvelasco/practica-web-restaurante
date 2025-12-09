<?php
$usuario_valido = "madrid1@empresa.com";
$password_valido = "1234";

$usuario = $_POST['usuario'] ?? '';
$password = $_POST['password'] ?? '';
$recordarme = isset($_POST['recordarme']);

if ($usuario === $usuario_valido && $password === $password_valido) {
    if ($recordarme) {
        setcookie("usuario", $usuario, time() + (86400 * 7), "/"); 

        // Guarda sessión
        session_start();
        $_SESSION["usuario"] = $usuario;
        // $_SESSION["codRes"] = 1;
        header("Location: categorias.php");
        exit();
    } else {
        setcookie("usuario", $usuario, 0, "/"); 
    }

    header("Location: categorias.php");
    exit();
} else {
    header("Location: login.php");
    exit();
}
