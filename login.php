<?php
if (isset($_COOKIE['usuario'])) {
    header("Location: categorias.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
    <style>
        body{
            justify-content: center;
        }
        form {
            display: inline-block;
            text-align: left;
            margin-top: 20px;
        }
        .formulario{
            text-align: center;
        }
    </style>
</head>
<body>
<div class="formulario">
<h2>Acceso al sistema</h2>

<?php
if (isset($_GET['error'])) {
    echo "<p style='color:red;'> Usuario o contraseña no son correctos</p>";
}
?>

<form action="sesiones.php" method="POST">
    <label>Usuario:</label>
    <input type="text" name="usuario" required><br><br>

    <label>Contraseña:</label>
    <input type="password" name="password" required><br><br>

    <label>
        <input type="checkbox" name="recordarme"> Recordarme
    </label><br><br>

    <input type="submit" value="Ingresar">
</form>
</div>
</body>
</html>