<?php
/*
Insertar los pedidos en la bd, envia correos de confirmacion y muestra mensajes de erroro éxito 
*/
require_once 'env.php';
session_start();

require_once 'database/bd.php';
require_once 'correo.php';

if (!isset($_SESSION['usuario']) || !isset($_SESSION['codRes'])) {
    header("Location: login.php");
    exit;
}

if (empty($_SESSION['carrito'])) {
    header("Location: carrito.php?error=vacio");
    exit;
}

$codRes = $_SESSION['codRes'];
$carrito = $_SESSION['carrito'];
$pesoTotal = 0;

$correoRestaurante = $_SESSION['usuario'];

try {
    $codPed = guardarPedidoCompleto($codRes, $carrito);

    $detalles = "
        <h1>Pedido nº {$codPed}</h1>
        <h2>Restaurante: {$correoRestaurante}</h2>
        <strong>Detalle del pedido</strong>
        <table border='1' cellpadding='6' cellspacing='0' style='border-collapse:collapse; width:700px;'>
        <tr><th>Producto</th><th>Descripción</th><th>Peso unidad</th><th>Unidades</th><th>Peso total</th></tr>";

    $pesoTotal = 0;

    foreach ($carrito as $clave => $unidades) {
        list($cat, $cod) = explode("-", $clave);

        if ($cat == 1) {
            $productos = [1=>["Nombre"=>"Cerveza Alhambra","Desc"=>"24 Botellas 33cl","Peso"=>10.0],
                          2=>["Nombre"=>"Cerveza Mahou","Desc"=>"24 Botellas 33cl","Peso"=>10.0],
                          3=>["Nombre"=>"Vino Tinto","Desc"=>"6 botellas 0.75l","Peso"=>5.5]];
        } elseif ($cat == 2) {
            $productos = [1=>["Nombre"=>"Agua Mineral","Desc"=>"24 Botellas","Peso"=>6.0],
                          2=>["Nombre"=>"Coca-Cola","Desc"=>"24 Botellas","Peso"=>12.0],
                          3=>["Nombre"=>"Zumo Naranja","Desc"=>"6 bricks","Peso"=>5.0]];
        } elseif ($cat == 3) {
            $productos = [1=>["Nombre"=>"Paella","Desc"=>"Paella mixta","Peso"=>1.2],
                          2=>["Nombre"=>"Hamburguesa","Desc"=>"Con queso","Peso"=>0.25],
                          3=>["Nombre"=>"Pizza","Desc"=>"Margarita","Peso"=>0.8]];
        }

        $prod = $productos[$cod] ?? null;
        if ($prod) {
            $pesoLinea = $prod['Peso'] * $unidades;
            $pesoTotal += $pesoLinea;

            $detalles .= "<tr>
                <td>{$prod['Nombre']}</td>
                <td>{$prod['Desc']}</td>
                <td>{$prod['Peso']} kg</td>
                <td>{$unidades}</td>
                <td>{$pesoLinea} kg</td>
            </tr>";
        }
    }

    $detalles .= "</table><br><strong>Peso total del pedido: {$pesoTotal} kg</strong>";

    // Enviar correo
    enviarCorreoPedido($correoRestaurante, getenv('EMAIL_DEPTO'), $detalles); // 

    // Vaciar carrito y redirigir
    unset($_SESSION['carrito']);
    header("Location: confirmacion.php?exito=true&pedido={$codPed}");
    exit;

} catch (Exception $e) {
    error_log("Error procesando pedido: " . $e->getMessage());
    header("Location: carrito.php?error=bd");
    exit;
}
?>