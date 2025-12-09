<?php session_start(); include "cabecera.php"; ?>
<h2>¡Pedido realizado con éxito!</h2>
<p>Tu pedido número <strong><?= $_GET['pedido'] ?? 'desconocido' ?></strong> ha sido enviado.</p>
<p>Recibirás un correo de confirmación en breve.</p>
<a href="categorias.php">Volver al catálogo</a>