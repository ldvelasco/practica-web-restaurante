<?php
if (!isset($_COOKIE['usuario'])) {
    header("Location: ../pages/login.php");
    exit();
}
$usuario = $_COOKIE['usuario'];
?>

<div style="
    background:#eee;
    padding:15px;
    font-family:Arial;
    display:flex;
    justify-content:space-between;
    align-items:center;
">

    <div>Usuario: <strong><?php echo htmlspecialchars($usuario); ?></strong></div>

    <nav>
        <a href="../pages/categorias.php" style="margin-right:15px;">Home</a>
        <a href="../pages/carrito.php" style="margin-right:15px;">Ver carrito</a>
        <a href="../actions/logout.php">Cerrar sesión</a>
    </nav>

</div>