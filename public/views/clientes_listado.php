<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Clientes | Tienda de Videojuegos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Rajdhani:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/css/estilos.css">
</head>
<body>
    <?php require_once 'sidebar.php'; ?>

    <div class="main-content" style="margin-left: 260px; padding: 20px;"> 

        <h1 class="mb-4">👤 Gestión de Clientes</h1>
        
        <div class="d-flex justify-content-between mb-4">
            <a href="index.php?controller=Cliente&action=mostrarFormulario" class="btn-neon btn-neon-blue">
                ➕ Agregar Cliente
            </a>
        </div>

        <?php // Lógica para mostrar mensajes de éxito/error ?>
        <?php if (isset($_GET['msg']) && $_GET['msg'] == 'success'): ?>
            <div class="alert alert-success bg-dark text-success border-success">Operación realizada con éxito.</div>
        <?php elseif (isset($_GET['msg']) && $_GET['msg'] == 'error'): ?>
            <div class="alert alert-danger bg-dark text-danger border-danger">Error al realizar la operación.</div>
        <?php endif; ?>

        <table class="table table-dark-custom">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Completo</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>RFC</th> 
                    <th>Puntos</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // La variable $clientes viene del ClienteController
                if (isset($clientes) && is_array($clientes) && !empty($clientes)):
                    foreach ($clientes as $c): 
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($c['id_cliente']); ?></td>
                    <td><?php echo htmlspecialchars($c['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($c['telefono'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($c['email'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($c['rfc'] ?? 'N/A'); ?></td> 
                    
                    <td><span class="badge bg-info"><?php echo htmlspecialchars($c['puntos_acumulados']); ?></span></td>
                    <td>
                        <a href="index.php?controller=Cliente&action=mostrarFormulario&id=<?php echo $c['id_cliente']; ?>" class="btn-neon btn-neon-yellow">Editar</a>
                        <?php if ($_SESSION['rol'] !== 'Vendedor'): ?>
                        <a href="index.php?controller=Cliente&action=eliminar&id=<?php echo $c['id_cliente']; ?>" class="btn-neon btn-neon-pink" onclick="return confirm('¿Está seguro de eliminar a este cliente?');">Eliminar</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php 
                    endforeach;
                else: 
                ?>
                    <tr>
                        <td colspan="7" class="text-center" style="padding: 20px;">No hay clientes registrados en la galaxia.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

    </div>
</body>
</html>