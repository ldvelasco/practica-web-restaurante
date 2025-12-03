<?php
/*Para agrupar las funciones de la bd */

function conexion() : PDO {
    $dsn = 'mysql:host=localhost;dbname=restaurante';
    $user = 'root';
    $pass = '';
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    $dbh = null;
    $sth = null;
    try {
        $dbh = new PDO($dsn, $user, $pass, $options);
        return $dbh;
    } catch (PDOException $e) {
        echo 'Error de conexion: ' . $e->getMessage();
    }
    return  $dbh;
}

$pdo = conexion();
if ($pdo != null){
    echo 'tenemos conexion';
} else {
    echo 'no';
}
?>