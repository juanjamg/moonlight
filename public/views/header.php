<?php
// /public/views/header.php

// Este encabezado usa los estilos 'app-header' definidos en estilos.css
?>
<head>
    <link rel="stylesheet" href="public/css/estilos.css">
</head>
<header class="header-moonlight">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        
        <div class="d-flex align-items-center">
            <img src="public/img/logo.jpg" alt="Logo de la Tienda" class="header-logo-img">
            <h1 class="header-title">SISTEMA <span>MOONLIGHT</span></h1>
        </div>
        
        <div class="text-end d-flex align-items-center">
            <span class="header-user-text me-3">
                USUARIO: <span class="header-user-name"><?php echo htmlspecialchars($_SESSION['nombre_usuario']); ?></span>
            </span>
            <span class="badge badge-neon-role">
                <?php echo htmlspecialchars($_SESSION['rol']); ?>
            </span>
        </div>

    </div>
</header>