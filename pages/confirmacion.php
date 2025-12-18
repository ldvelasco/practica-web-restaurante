<?php session_start(); include "../includes/cabecera.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./icon.png" type="image/x-icon">
    <title>Confirmación</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f7f7f7;
            color: #333;
        }

        /* Contenedor principal */
        .container {
            max-width: 1000px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            animation: fadeIn 0.6s ease-out;
        }

        h2 {
            background: #f7f7f7;
            color: #333;
            padding: 20px 30px;
            text-align: left;
            font-size: 24px;
            font-weight: 500;
            margin: 0;
            border-bottom: 1px solid #eee;
        }

        .table-container {
            padding: 30px;
        }

        p {
            margin-bottom: 15px;
            line-height: 1.5;
        }

        strong {
            color: #667eea;
            font-weight: 600;
        }

        /* Enlace seguir comprando */
        .link {
            display: block;
            width: fit-content;
            margin: 30px 30px 30px 30px;
            padding: 12px 25px;
            background: #333;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 500;
            letter-spacing: 0;
            box-shadow: none;
            transition: background-color 0.3s ease;
        }
        .link:hover {
            background-color: #555;
            transform: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>¡Pedido realizado con éxito!</h2>
        <div class="table-container">
            <p>Tu pedido número <strong><?= $_GET['pedido'] ?? 'desconocido' ?></strong> ha sido enviado.</p>
            <p>Recibirás un correo de confirmación en breve.</p>
            <a href="../pages/categorias.php" class="link" >Volver al catálogo</a>
        </div>
    </div>
</body>
</html>