<?php
include "cabecera.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Categorías</title>
    <style>
body {
    margin: 20px;
    font-family: Arial, sans-serif;
}

h2 {
    color: #333;
    margin-bottom: 15px;
}

ul {
    list-style: none;
    padding: 0;
    max-width: 300px;
}

li {
    background: #f0f0f0;
    padding: 10px;
    margin-bottom: 8px;
    border-radius: 5px;
}

a {
    text-decoration: none;
    color: #0056b3;
    font-weight: bold;
}

a:hover {
    text-decoration: underline;
}

    </style>
</head>

<body>

<div class="login-box">  
    <h2>Lista de categorías</h2>

    <ul style="list-style:none; padding:0;">
        <li><a href="productos.php?categoria=1">Bebidas con alcohol</a></li>
        <li><a href="productos.php?categoria=2">Bebidas sin alcohol</a></li>
        <li><a href="productos.php?categoria=3">Comida</a></li>
    </ul>
</div>

</body>
</html>

