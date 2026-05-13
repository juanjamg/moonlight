<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Clientes | Moonlight Geek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/estilos.css">
    
    <style>
        /* Reutilizamos el estilo compacto para botones de tabla que usamos en Inventario */
        .btn-neon-sm {
            padding: 4px 12px;
            font-size: 0.85rem;
            border-radius: 50px;
        }

        /* Insignia personalizada para los Puntos Acumulados */
        .badge-puntos {
            background-color: rgba(0, 229, 255, 0.05);
            border: 1px solid var(--accent-cyan);
            color: var(--accent-cyan);
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 600;
            box-shadow: 0 0 8px rgba(0, 229, 255, 0.2);
        }
    </style>
</head>
<body>
    <?php require_once 'sidebar.php'; ?>

    <div class="main-content" style="margin-left: 260px; padding: 20px;"> 

        <h1 class="mb-4 neon-title">👤 GESTIÓN DE CLIENTES</h1>
        
        <div class="d-flex justify-content-between mb-4">
            <a href="index.php?controller=Cliente&action=mostrarFormulario" class="btn-neon btn-neon-blue">
                ➕ Agregar Cliente
            </a>
        </div>

        <?php if (isset($_GET['msg'])): ?>
            <?php if ($_GET['msg'] == 'success'): ?>
                <div class="alert alert-neon-success">✨ Operación realizada con éxito.</div>
            <?php elseif ($_GET['msg'] == 'error'): ?>
                <div class="alert alert-neon-danger">❌ Error al realizar la operación.</div>
            <?php endif; ?>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-dark-custom table-hover mt-2">
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
                    if (isset($clientes) && is_array($clientes) && !empty($clientes)):
                        foreach ($clientes as $c): 
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($c['id_cliente']); ?></td>
                        <td class="fw-bold" style="color: #ffffff;"><?php echo htmlspecialchars($c['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($c['telefono'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($c['email'] ?? 'N/A'); ?></td>
                        <td style="text-transform: uppercase;"><?php echo htmlspecialchars($c['rfc'] ?? 'N/A'); ?></td> 
                        
                        <td>
                            <span class="badge-puntos">
                                <?php echo htmlspecialchars($c['puntos_acumulados']); ?>
                            </span>
                        </td>

                        <td>
                            <div class="d-flex gap-2">
                                <a href="index.php?controller=Cliente&action=mostrarFormulario&id=<?php echo $c['id_cliente']; ?>" class="btn-neon btn-neon-yellow btn-neon-sm text-decoration-none">
                                    Editar
                                </a>
                                <?php if ($_SESSION['rol'] !== 'Vendedor'): ?>
                                    <a href="index.php?controller=Cliente&action=eliminar&id=<?php echo $c['id_cliente']; ?>" class="btn-neon btn-neon-pink btn-neon-sm text-decoration-none" onclick="return confirm('¿Está seguro de eliminar a este cliente?');">
                                        Eliminar
                                    </a>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php 
                        endforeach;
                    else: 
                    ?>
                        <tr>
                            <td colspan="7" class="text-center py-4" style="color: #8A5BB2;">No hay clientes registrados en la galaxia.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</body>
</html>