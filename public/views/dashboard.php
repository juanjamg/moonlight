<?php
$baseUrl = 'index.php?controller=';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Tienda de Videojuegos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/css/estilos.css" rel="stylesheet"> 
</head>
<body>
    <?php require_once 'header.php'; ?>

    <div class="main-content"> 
        
        <div class="alert alert-success mt-4">
            ¡El inicio de sesión y la seguridad funcionan! Ya puedes acceder a la información.
        </div>
        
        <h3 class="mt-4">Módulos Principales</h3>
        
        <div class="d-flex flex-wrap gap-3">
            <a href="index.php?controller=Inventario&action=listar" class="btn btn-info btn-lg">📦 Gestión de Inventario</a>
            <a href="index.php?controller=Cliente&action=listar" class="btn btn-primary btn-lg">👤 Gestión de Clientes</a>
            <a href="index.php?controller=Venta&action=pos" class="btn btn-success btn-lg">💰 Punto de Venta (POS)</a>
            <a href="index.php?controller=Reporte&action=index" class="btn btn-warning btn-lg">📊 Reportes y Análisis</a>
            <a href="<?php echo $baseUrl; ?>Usuario&action=logout" class="btn btn-warning btn-lg">🚫 Cerrar Sesión</a>
        </div>
    </div> 
</body>
</html>