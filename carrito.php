<?php
session_start();
include "cabecera.php";

if (isset($_GET["codigo"]) && isset($_GET["categoria"]) && isset($_GET["unidades"])) {

    $codigo = $_GET["codigo"];
    $categoria = $_GET["categoria"];
    $unidades = intval($_GET["unidades"]);

    // Crea clave única: ej. "1-3"
    $clave = $categoria . "-" . $codigo;

    // Si no existe en la sesión, crear con 0
    if (!isset($_SESSION["carrito"][$clave])) {
        $_SESSION["carrito"][$clave] = 0;
    }

    // Sumar unidades
    $_SESSION["carrito"][$clave] += $unidades;
}


// ---- MOSTRAR CARRITO ----

$productosCarrito = [];

if (isset($_SESSION["carrito"])) {

    foreach ($_SESSION["carrito"] as $clave => $unidades) {

        list($categoria, $codigo) = explode("-", $clave);

        // MISMAS LISTAS QUE USAS EN productos.php
        if($categoria == 1){
            $productos = [
                1 => ["Nombre"=>"Cerveza Alhambra","Descripcion"=>"24 Botellas 33cl","Peso"=>"10"],
                2 => ["Nombre"=>"Cerveza Mahou","Descripcion"=>"24 Botellas 33cl","Peso"=>"10"],
                3 => ["Nombre"=>"Vino Tinto","Descripcion"=>"6 botellas 0.75","Peso"=>"5.5"],
            ];
        }
        elseif($categoria == 2){
            $productos = [
                1 => ["Nombre"=>"Agua Mineral","Descripcion"=>"24 Botellas","Peso"=>"6"],
                2 => ["Nombre"=>"Coca-Cola","Descripcion"=>"24 Botellas","Peso"=>"12"],
                3 => ["Nombre"=>"Zumo Naranja","Descripcion"=>"6 bricks","Peso"=>"5"],
            ];
        }
        elseif($categoria == 3){
            $productos = [
                1 => ["Nombre"=>"Paella","Descripcion"=>"Paella mixta","Peso"=>"1.2"],
                2 => ["Nombre"=>"Hamburguesa","Descripcion"=>"Con queso","Peso"=>"0.25"],
                3 => ["Nombre"=>"Pizza","Descripcion"=>"Margarita","Peso"=>"0.8"],
            ];
        }

        // Recuperar producto
        $prod = $productos[$codigo];
        $prod["unidades"] = $unidades;
        $prod["clave"] = $clave;

        $productosCarrito[] = $prod;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./icon.png" type="image/x-icon">
    <title>Carrito</title>
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
        .rm-button {
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

        .rm-button:hover {
            background-color: #555; /* Oscurecer un poco en hover */
        }
        /* Enlace "Ir al carrito" */
        .link {
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
        .link:hover {
            background-color: #555;
            transform: none;
        }

        .vacio {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Carrito de la compra</h2>

        <?php if (empty($productosCarrito)): ?>
        <p class="vacio">El carrito está vacío.</p>

        <?php else: ?>
        
        <div class="table-container">
            <table border="1">
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Peso</th>
                    <th>Unidades</th>
                    <th>Eliminar</th>
                </tr>

                <?php foreach ($productosCarrito as $prod): ?>
                <tr>
                    <td><?= $prod["Nombre"] ?></td>
                    <td><?= $prod["Descripcion"] ?></td>
                    <td><?= $prod["Peso"] ?></td>
                    <td><?= $prod["unidades"] ?></td>

                    <td>
                        <form action="eliminar.php" method="POST">
                            <input type="hidden" name="cod" value="<?= $prod['clave'] ?>">
                            <input type="number" name="unidades" min="1" max="<?= $prod['unidades'] ?>" value="1">
                            <input type="submit" class="rm-button" value="Eliminar">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </table>
            <?php endif; ?>
        </div>
        
        <p><a href="categorias.php" class="link">Seguir comprando</a></p>
        <form action="procesar_pedido.php" method="post">
            <button type="submit" class="link">Realizar Pedido</button>
        </form>
    </div>
    
</body>
</html>
