<?php include "cabecera.php"; ?>

<?php

$categoria = $_GET['categoria'] ?? '';

if ($categoria == 1) {
    $titulo = "Bebidas con alcohol";
    $productos = [
        [
            "Codigo" => "1",
            "Nombre" => "Cerveza Alhambra",
            "Descripcion" => "24 Botellas de 33cl",
            "Peso" => "10",
            "Stock" => "15"
        ],
        [
            "Codigo" => "2",
            "Nombre" => "Cerveza Mahou",
            "Descripcion" => "24 Botellas de 33cl",
            "Peso" => "10",
            "Stock" => "20"
        ],
        [
            "Codigo" => "3",
            "Nombre" => "Vino Tinto",
            "Descripcion" => "6 Botellas de 0.75",
            "Peso" => "5.5",
            "Stock" => "10"
        ],

    ];
} elseif ($categoria == 2) {
    $titulo = "Bebidas sin alcohol";
    $productos = [
        [
            "Codigo" => "1",
            "Nombre" => "Agua Mineral",
            "Descripcion" => "24 Botellas de 33cl",
            "Peso" => "6",
            "Stock" => "35"
        ],
        [
            "Codigo" => "2",
            "Nombre" => "Coca-Cola",
            "Descripcion" => "24 Botellas de 33cl",
            "Peso" => "12",
            "Stock" => "25"
        ],
        [
            "Codigo" => "3",
            "Nombre" => "Zumo de Naranja",
            "Descripcion" => "6 Bricks de 33cl",
            "Peso" => "5",
            "Stock" => "18"
        ],
    ];
} elseif ($categoria == 3) {
    $titulo = "Comida";
    $productos = [
        [
            "Codigo" => "1",
            "Nombre" => "Paella",
            "Descripcion" => "Paella Mixta",
            "Peso" => "1.2",
            "Stock" => "12"
        ],
        [
            "Codigo" => "2",
            "Nombre" => "Hamburguesa",
            "Descripcion" => "Hamburguesa con Queso",
            "Peso" => "0.25",
            "Stock" => "18"
        ],
        [
            "Codigo" => "3",
            "Nombre" => "Pizza",
            "Descripcion" => "Pizza Margarita",
            "Peso" => "0.8",
            "Stock" => "14"
        ],
    ];
} else {
    $titulo = "Categoría no válida";
    exit();

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./icon.png" type="image/x-icon">
    <title>Productos</title>
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
        
        /* Animación simple */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Título de la categoría */
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

        /* Contenedor de la tabla */
        .table-container {
            padding: 30px;
            overflow-x: auto;
        }

        /* Tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            background: #ffffff;
            border-radius: 4px;
            border: none;
        }
        
        /* Encabezados de tabla */
        th {
            background: #e9e9e9;
            color: #333;
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0;
            border-bottom: 2px solid #ddd;
        }
        
        /* Celdas de tabla */
        td {
            padding: 12px 15px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 14px;
            color: #555;
            transition: background-color 0.2s ease;
        }
        
        /* Efecto hover en filas */
        tr:hover td {
            background-color: #fafafa;
        }
        
        /* Última fila sin borde inferior */
        tr:last-child td {
            border-bottom: none;
        }

        /* Campo de entrada de número */
        input[type="number"] {
            width: 50px;
            padding: 6px 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 13px;
            text-align: center;
            transition: border-color 0.3s ease;
        }
        
        input[type="number"]:focus {
            border-color: #333; /* Foco simple */
            outline: none;
        }

        /* Botón de compra */
        .buy-button {
            background: #333;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-transform: none;
            letter-spacing: 0;
            margin-left: 10px;
        }
        
        .buy-button:hover {
            background-color: #555; /* Oscurecer un poco en hover */
        }

        /* Enlace "Ir al carrito" */
        .cart-link {
            display: block;
            width: fit-content;
            margin: 20px 30px 30px 30px;
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
        
        .cart-link:hover {
            background-color: #555;
            transform: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2><?php echo $titulo; ?></h2>
        <div class="table-container">
            <table border="1">
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Peso</th>
                <th>Stock</th>
                <th>Comprar</th>
            </tr>
            <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?php echo $producto['Nombre']; ?></td>
                    <td><?php echo $producto['Descripcion']; ?></td>
                    <td><?php echo $producto['Peso']; ?></td>
                    <td><?php echo $producto['Stock']; ?></td>

                    <td>
                        <form action="carrito.php" method="GET">
                            <input type="number" name="unidades" min="1" max="<?= $producto['Stock'] ?>" value="1" required>
                            <input type="hidden" name="codigo" value="<?= $producto['Codigo'] ?>">
                            <input type="hidden" name="categoria" value="<?= $categoria ?>">
                            <input type="submit" class="buy-button" value="Comprar">
                        </form>

                    </td>
                </tr>
            <?php endforeach; ?>
            </table>

            <a href="carrito.php" class="cart-link">Ir al carrito</a>
        </div>
    </div>
</body>
</html>