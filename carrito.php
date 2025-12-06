<?php
session_start();
include "cabecera.php";  

// Solo para test
// unset($_SESSION['carrito']);

// ---- Recuperar carrito ----
$productosCarrito = [];

if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {

    foreach ($_SESSION['carrito'] as $clave => $unidades) {

        if (strpos($clave, '-') === false) continue;
        list($categoria, $codigo) = explode('-', $clave);


        // Misma lista de productos que productos.php
        if($categoria == 1){
            $productos = [
                1 => ["CodProd"=>1,"Nombre"=>"Cerveza Alhambra","Descripcion"=>"24 botellas 33cl","Peso"=>"10"],
                2 => ["CodProd"=>2,"Nombre"=>"Cerveza Mahou","Descripcion"=>"24 botellas 33cl","Peso"=>"10"],
                3 => ["CodProd"=>3,"Nombre"=>"Vino Tinto","Descripcion"=>"6 botellas","Peso"=>"5.5"],
            ];
        }
        elseif($categoria == 2){
            $productos = [
                1 => ["CodProd"=>1,"Nombre"=>"Agua Mineral","Descripcion"=>"24 botellas","Peso"=>"6"],
                2 => ["CodProd"=>2,"Nombre"=>"Coca-Cola","Descripcion"=>"24 botellas","Peso"=>"12"],
                3 => ["CodProd"=>3,"Nombre"=>"Zumo Naranja","Descripcion"=>"6 bricks","Peso"=>"5"],
            ];
        }
        elseif($categoria == 3){
            $productos = [
                1 => ["CodProd"=>1,"Nombre"=>"Paella","Descripcion"=>"Mixta","Peso"=>"1.2"],
                2 => ["CodProd"=>2,"Nombre"=>"Hamburguesa","Descripcion"=>"Con queso","Peso"=>"0.25"],
                3 => ["CodProd"=>3,"Nombre"=>"Pizza","Descripcion"=>"Margarita","Peso"=>"0.8"],
            ];
        }

        $prod = $productos[$codigo];
        $prod['unidades'] = $unidades;
        $prod['clave'] = $clave;     

        $productosCarrito[] = $prod;
    }
}

// ---- eliminar ----
if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $clave = $_POST['cod'];
    $uds = $_POST['unidades'];

    if(isset($_SESSION['carrito'][$clave])) {
        $_SESSION['carrito'][$clave] -= $uds;
        if($_SESSION['carrito'][$clave] <= 0) unset($_SESSION['carrito'][$clave]);
    }

    header("Location: carrito.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            text-align: center;
        }
        table {
            margin: 0 auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px 15px;
        }
    </style>
</head>
<body>
    <h2>Carrito de la compra</h2>

    <?php if (empty($productosCarrito)): ?>
    <p>El carrito está vascío.</p>
    <?php else: ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Peso (kg)</th>
                    <th>Unidades</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productosCarrito as $prod): ?>
                    <tr>
                        <td><?= htmlspecialchars($prod['Nombre']) ?></td>
                        <td><?= htmlspecialchars($prod['Descripcion']) ?></td>
                        <td><?= $prod['Peso'] ?></td>
                        <td><?= $prod['unidades'] ?></td>
                        <td>
                            <form method="post" action="carrito.php">
                                <input type="hidden" name="cod" value="<?= $prod['clave'] ?>">
                                <input type="number" name="unidades" min="1" max="<?= $prod['unidades'] ?>" value="1" required>
                                <button type="submit">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
    </table>
    <p><a href="procesar_pedido.php">Realizar pedido</a></p>
    <?php endif; ?>

    <p><a href="categorias.php">Seguir comprando</a></p>
</body>
</html>

