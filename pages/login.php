<?php
if (isset($_COOKIE['usuario'])) {
    header("Location: ../pages/categorias.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
    <link rel="shortcut icon" href="../assets/icon.png" type="image/x-icon">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f7f7f7;
        }

        h2 {
            color: #333;
            margin-bottom: 25px;
            font-size: 24px;
            font-weight: 500;
            text-align: left;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .formulario {
            background: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            width: 100%;
            max-width: 400px;
        }
        .formulario:hover {
            transform: translateY(-5px);
        }
        
        .error-message {
            color: #d32f2f;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
            font-size: 14px;
        }
        input[type="text"],
        input[type="password"] {
            width: 94%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            transition: border-color 0.3s ease;
            background: #fafafa;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #667eea;
            background: #fff;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
        }

        input[type="checkbox"] {
            margin-right: 8px;
            width: 16px;
            height: 16px;
        }

        .checkbox-group label {
            margin: 0;
            cursor: pointer;
            user-select: none;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background: #333;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #555;
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

        <form action="../includes/sesiones.php" method="POST">
            <div class="form-group">
                <label>Usuario:</label>
                <input type="text" name="usuario" required><br><br>
            </div>
            
            <div class="form-group">
                <label>Contraseña:</label>
                <input type="password" name="password" required><br><br>
            </div>
            <div class="checkbox-grop">
                <input type="checkbox" id="recordarme" name="recordarme">
                <label for="recordarme">Recordarme</label>
            </div>
                
            </label>

            <input type="submit" value="Ingresar">
        </form>
    </div>
</body>
</html>