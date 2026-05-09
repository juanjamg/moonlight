<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Moonlight Geek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/estilos.css">
</head>
<body>
    <?php require_once 'header.php'; ?>

    <div class="main-content"> 
        
        <div class="alert alert-neon-success mt-4">
            ✨ ¡El inicio de sesión y la seguridad funcionan! Ya puedes acceder a la información.
        </div>
        
        <h3 class="mt-5 neon-title">Módulos Principales</h3>
        
        <div class="d-flex flex-wrap gap-4 mt-4">
            <a href="index.php?controller=Inventario&action=listar" class="btn-neon btn-neon-blue">📦 Gestión de Inventario</a>
            <a href="index.php?controller=Cliente&action=listar" class="btn-neon btn-neon-purple">👤 Gestión de Clientes</a>
            <a href="index.php?controller=Venta&action=pos" class="btn-neon btn-neon-pink">💰 Punto de Venta (POS)</a>
            <a href="index.php?controller=Reporte&action=index" class="btn-neon btn-neon-blue">📊 Reportes y Análisis</a>
            <a href="<?php echo $baseUrl; ?>Usuario&action=logout" class="btn-neon btn-neon-red">🚫 Cerrar Sesión</a>
        </div>
    </div> 
</body>
</html>