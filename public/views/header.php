<?php
// /public/views/header.php

// Este encabezado usa los estilos 'app-header' definidos en estilos.css
?>
<head>
    <link rel="stylesheet" href="public/css/estilos.css">
</head>
<header class="header-moonlight">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <h1 class="d-flex align-items-center">
            <img src="public/img/logo.jpg" alt="Logo de la Tienda" style="width: 40px; margin-right: 10px;">
            Sistema Moonlight
        </h1>
        <div class="text-end">
            <span class="text-white me-2">Usuario: <?php echo htmlspecialchars($_SESSION['nombre_usuario']); ?></span>
            <span class="badge bg-warning text-dark"><?php echo htmlspecialchars($_SESSION['rol']); ?></span>
        </div>
    </div>
</header>