<?php
/*Para agrupar las funciones de la bd */

function conexion() : PDO {
    $dbh = null;

    $dsn = 'mysql:host=localhost;dbname=restaurante';
    $user = 'root';
    $pass = '';
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    try {
        $dbh = new PDO($dsn, $user, $pass, $options);
    } catch (PDOException $e) {
        echo 'Error de conexion: ' . $e->getMessage();
    }
    return  $dbh;
}

function generarCodigoUnico($tabla, $campoID) : string{
    $pdo = conexion();
    $intentos = 0;

    do {
        $codigo = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $stmt = $pdo->prepare("SELECT 1 FROM $tabla WHERE $campoID = ? LIMIT 1");
        $stmt->execute([$codigo]);
        $existe = $stmt->fetchColumn();

        if (++$intentos > 50) {
            // Muy raro, pero por si acaso
            throw new Exception("No se pudo generar código único para $tabla");
        }
    } while ($existe);
    return $codigo;
}

function insertarPedido($codRes, $pesoTotal) : string {
    $pdo = conexion();
    $codPed = generarCodigoUnico('Pedidos', 'CodPed');

    $fecha = date("Y-m-d");
    $enviado = 0;

    $sql = "INSERT INTO Pedidos (CodPed, Fecha, Enviado, Peso, Restaurante) 
        VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$codPed, $fecha, $enviado, $pesoTotal, $codRes]);
    return $codPed;
}

function insertarPedidoProducto($codPed, $codProd, $unidades) {
    $pdo = conexion();
    $codPedProd = generarCodigoUnico('PedidosProductos', 'CodPedProd');

    $sql = "INSERT INTO PedidosProductos (CodPedProd, Pedido, Producto, Unidades) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$codPedProd, $codPed, $codProd, $unidades]);
}

function guardarPedidoCompleto(int $codRes, array $carrito): string {
    $pdo = conexion();

    try {
        $pdo->beginTransaction();

        // Crear cabecera del pedido
        $codPed = insertarPedido($codRes, 0);

        // Insertar todos los productos
        $stmt = $pdo->prepare("INSERT INTO PedidosProductos (CodPedProd, Pedido, Producto, Unidades) 
                               VALUES (?, ?, ?, ?)");

        $pesoTotal = 0;

        foreach ($carrito as $clave => $unidades) {
            list($categoria, $codProd) = explode("-", $clave);

            // Obtener peso del producto (misma lógica que tienes en carrito.php)
            $pesoUnitario = match((int)$categoria) {
                1 => [1=>10,   2=>10,   3=>5.5][(int)$codProd]   ?? 0,
                2 => [1=>6,    2=>12,   3=>5][(int)$codProd]    ?? 0,
                3 => [1=>1.2,  2=>0.25, 3=>0.8][(int)$codProd]  ?? 0,
                default => 0
            };

            $pesoTotal += $pesoUnitario * $unidades;

            $codPedProd = generarCodigoUnico('PedidosProductos', 'CodPedProd');
            $stmt->execute([$codPedProd, $codPed, $codProd, $unidades]);
        };
        

        // Actualizar peso total
        $pdo->prepare("UPDATE Pedidos SET Peso = ? WHERE CodPed = ?")
              ->execute([$pesoTotal, $codPed]);

        $pdo->commit();
        return $codPed;

    } catch (Exception $e) {
        $pdo->rollBack();
        throw $e; // lo capturará procesar_pedido.php
    }
}
?>