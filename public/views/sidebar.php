<?php
// /public/views/sidebar.php

// Esta barra lateral es fija y ocupa toda la altura (100vh)

// Definimos la URL base para los enlaces
$baseUrl = 'index.php?controller=';
?>
<head>
    <link rel="stylesheet" href="public/css/estilos.css">
</head>
<div class="sidebar-moonlight p-3" style="width: 250px; height: 100vh; position: fixed; top: 0; left: 0; z-index: 1000;">
    
    <div class="text-center mb-4 mt-2">
        <img src="public/img/logo.jpg" alt="Logo" style="width: 80px; border-radius: 50%; border: 2px solid #00E5FF; box-shadow: 0 0 10px rgba(0, 229, 255, 0.5);">
        
        <div class="sidebar-logo-text mt-3">MOON<span>LIGHT</span></div>
        <div style="color: #8A5BB2; font-size: 0.7rem; font-family: 'Orbitron', sans-serif; letter-spacing: 1px;">GAMES AND GEEK</div>
        
        <hr class="sidebar-divider">
    </div>
    
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="btn-sidebar-neon btn-sidebar-magenta text-start w-100" href="<?php echo $baseUrl; ?>Dashboard&action=index">
                🏠 Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="btn-sidebar-neon btn-sidebar-cyan text-start w-100" href="<?php echo $baseUrl; ?>Inventario&action=listar">
                📦 Inventario
            </a>
        </li>
        <li class="nav-item">
            <a class="btn-sidebar-neon btn-sidebar-purple text-start w-100" href="<?php echo $baseUrl; ?>Cliente&action=listar">
                👤 Clientes
            </a>
        </li>
        <li class="nav-item">
            <a class="btn-sidebar-neon btn-sidebar-magenta text-start w-100" href="<?php echo $baseUrl; ?>Venta&action=pos">
                💰 Punto de Venta
            </a>
        </li>
        <?php if ($_SESSION['rol'] !== 'Vendedor'): ?>
        <li class="nav-item">
            <a class="btn-sidebar-neon btn-sidebar-cyan text-start w-100" href="<?php echo $baseUrl; ?>Reporte&action=index">
                📊 Reportes
            </a>
        </li>
        <?php endif; ?>
    </ul>

    <hr class="sidebar-divider" style="position: absolute; bottom: 70px; width: calc(100% - 32px);">
    
    <div style="position: absolute; bottom: 20px; width: calc(100% - 32px);">
        <a href="<?php echo $baseUrl; ?>Usuario&action=logout" class="btn-sidebar-neon btn-sidebar-logout text-center w-100">
            🚫 Cerrar Sesión
        </a>
    </div>
</div>