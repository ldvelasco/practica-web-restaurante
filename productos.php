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
<h2><?php echo $titulo; ?></h2>
<table border="1">
    <tr>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Peso</th>
        <th>Stock</th>
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
                    <input type="submit" value="Comprar">
                </form>

            </td>
        </tr>
    <?php endforeach; ?>
</table>
