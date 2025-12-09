<?php
session_start();
include "cabecera.php";

// SI LLEGAN DATOS DESDE productos.php → AÑADIR AL CARRITO
if (isset($_GET["codigo"]) && isset($_GET["categoria"]) && isset($_GET["unidades"])) {

    $codigo = $_GET["codigo"];
    $categoria = $_GET["categoria"];
    $unidades = intval($_GET["unidades"]);

    // Crear clave única: ej. "1-3"
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

<h2>Carrito de la compra</h2>

<?php if (empty($productosCarrito)): ?>
<p>El carrito está vacío.</p>

<?php else: ?>

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
                <input type="submit" value="Eliminar">
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php endif; ?>

<p><a href="categorias.php">Seguir comprando</a></p>
<form action="procesar_pedido.php" method="post">
    <button type="submit">Realizar Pedido</button>
</form>
