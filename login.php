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
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
        }

        .login-box {
            text-align: center;
        }

        input[type="text"],
        input[type="password"] {
            width: 200px;
            padding: 5px;
            margin: 5px 0;
        }

        input[type="submit"] {
            padding: 5px 15px;
            margin-top: 10px;
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
