<?php
$baseUrl = 'index.php?controller=';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Moonlight Games and Geek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Rajdhani:wght@400;600&display=swap" rel="stylesheet">
    <link href="public/css/estilos.css" rel="stylesheet"> 
</head>
<body>
    <?php require_once 'header.php'; ?>

    <div class="main-content"> 
        
        <div class="alert alert-neon-success mt-4">
            ✨ ¡El inicio de sesión y la seguridad funcionan! Ya puedes acceder a la información.
        </div>
        
        <h3 class="mt-5 neon-title">Módulos Principales</h3>
        
        <div class="btn-neon">
            <a href="index.php?controller=Inventario&action=listar" class="btn-neon-blue">📦 Gestión de Inventario</a>
            <a href="index.php?controller=Cliente&action=listar" class="btn-neon-purple">👤 Gestión de Clientes</a>
            <a href="index.php?controller=Venta&action=pos" class="btn-neon-pink">💰 Punto de Venta (POS)</a>
            <a href="index.php?controller=Reporte&action=index" class="btn-neon-yellow">📊 Reportes y Análisis</a>
            <a href="<?php echo $baseUrl; ?>Usuario&action=logout" class="btn-neon-yellow">🚫 Cerrar Sesión</a>
        </div>
    </div> 
</body>
</html>