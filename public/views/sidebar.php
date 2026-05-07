<?php
// /public/views/sidebar.php

// Esta barra lateral es fija y ocupa toda la altura (100vh)

// Definimos la URL base para los enlaces
$baseUrl = 'index.php?controller=';
?>
<div class="sidebar bg-dark p-3" style="width: 250px; height: 100vh; position: fixed; top: 0; left: 0; z-index: 1000; box-shadow: 2px 0 5px rgba(0,0,0,0.5);">
    
    <div class="text-center mb-4">
        <img src="public/img/logo.jpg" alt="Logo" style="width: 80px; margin-bottom: 10px;">
        <h4 class="text-white">MOONLIGHT GEEK</h4>
        <hr style="border-color: #7b1fa2;">
    </div>
    
    <ul class="nav flex-column">
        <li class="nav-item mb-2">
            <a class="btn btn-secondary w-100 text-start" href="<?php echo $baseUrl; ?>Dashboard&action=index">🏠 Dashboard</a>
        </li>
        <li class="nav-item mb-2">
            <a class="btn btn-info w-100 text-start" href="<?php echo $baseUrl; ?>Inventario&action=listar">📦 Inventario</a>
        </li>
        <li class="nav-item mb-2">
            <a class="btn btn-primary w-100 text-start" href="<?php echo $baseUrl; ?>Cliente&action=listar">👤 Clientes</a>
        </li>
        <li class="nav-item mb-2">
            <a class="btn btn-success w-100 text-start" href="<?php echo $baseUrl; ?>Venta&action=pos">💰 Punto de Venta</a>
        </li>
        <li class="nav-item mb-2">
            <a class="btn btn-warning w-100 text-start text-dark" href="<?php echo $baseUrl; ?>Reporte&action=index">📊 Reportes</a>
        </li>
    </ul>

    <hr style="border-color: #7b1fa2;">
    
    <div style="position: absolute; bottom: 20px; width: 80%;">
        <a href="<?php echo $baseUrl; ?>Usuario&action=logout" class="btn btn-danger w-100">🚫 Cerrar Sesión</a>
    </div>
</div>