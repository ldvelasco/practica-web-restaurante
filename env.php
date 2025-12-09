<?php
// carga variables
function cargarEnv($ruta) {
    if (!file_exists($ruta)) die("Falta archivo .env");
    foreach (parse_ini_file($ruta) as $clave => $valor) {
        putenv("$clave=$valor");
        $_ENV[$clave] = $valor;
    }
}
cargarEnv(__DIR__ . '/.env');
?>