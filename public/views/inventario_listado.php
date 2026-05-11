<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inventario | Moonlight Geek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/css/estilos.css" rel="stylesheet"> 
    
    <style>
        /* Ajuste para que los botones dentro de la tabla sean más pequeños y compactos */
        .btn-neon-sm {
            padding: 4px 12px;
            font-size: 0.85rem;
            border-radius: 50px;
        }

        /* Alerta personalizada estilo Neón Informativo (Morado/Cyan) */
        .alert-neon-info {
            background-color: rgba(159, 0, 255, 0.05);
            border: 1px solid var(--accent-purple);
            color: var(--accent-cyan);
            box-shadow: 0 0 15px rgba(159, 0, 255, 0.2);
            border-radius: 8px;
            padding: 15px;
        }
    </style>
</head>
<body>
    <?php require_once 'sidebar.php'; ?>

    <div class="main-content" style="margin-left: 260px; padding: 20px;"> 
        
        <h1 class="mb-4 neon-title">📦 GESTIÓN DE INVENTARIO</h1>
        
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            
            <a href="index.php?controller=Inventario&action=mostrarFormulario" class="btn-neon btn-neon-blue">
                ➕ Agregar Producto
            </a>

            <form action="index.php?controller=Inventario&action=importarXML" method="POST" enctype="multipart/form-data" class="d-flex gap-2 align-items-center p-2 rounded" style="background: rgba(20, 20, 25, 0.6); border: 1px solid rgba(0, 229, 255, 0.2);">
                <span style="font-size: 0.9rem; color: var(--accent-cyan);" class="me-1 fw-bold">📥 Importar XML:</span>
                <input type="file" name="archivo_xml" class="form-control form-control-neon form-control-sm" accept=".xml" style="max-width: 220px;" required>
                <button type="submit" class="btn-neon btn-neon-blue btn-neon-sm">Subir</button>
            </form>

        </div>

        <?php if (isset($_GET['msg'])): ?>
            <?php if ($_GET['msg'] == 'success'): ?>
                <div class="alert alert-neon-success">✨ Producto guardado correctamente.</div>
            <?php elseif ($_GET['msg'] == 'success_edicion'): ?>
                <div class="alert alert-neon-success">✨ Producto actualizado correctamente.</div>
            <?php elseif ($_GET['msg'] == 'success_stock_sumado'): ?>
                <div class="alert alert-neon-info">📦 Stock actualizado: El producto ya existía y se sumó la cantidad al inventario.</div>
            <?php elseif ($_GET['msg'] == 'error_duplicado'): ?>
                <div class="alert alert-neon-danger">❌ Error: Ya existe un producto con ese nombre para esa plataforma.</div>
            <?php elseif ($_GET['msg'] == 'error'): ?>
                <div class="alert alert-neon-danger">❌ Error al realizar la operación.</div>
            <?php elseif ($_GET['msg'] == 'importacion_exitosa'): ?>
                <div class="alert alert-neon-success">🚀 ¡Catálogo XML importado y procesado con éxito!</div>
            <?php endif; ?>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-dark-custom table-hover mt-2">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Plataforma</th>
                        <th>Stock</th>
                        <th>Precio Venta</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if (isset($productos) && is_array($productos) && !empty($productos)):
                        foreach ($productos as $p): 
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($p['id_producto']); ?></td>
                        <td class="fw-bold" style="color: #ffffff;"><?php echo htmlspecialchars($p['nombre']); ?></td>
                        
                        <td><?php echo htmlspecialchars($p['plataforma_nombre'] ?? 'N/A'); ?></td>
                        
                        <td>
                            <span class="badge" style="background-color: <?php echo $p['stock'] < 5 ? 'rgba(255,0,60,0.1)' : 'rgba(0,229,255,0.05)'; ?>; border: 1px solid <?php echo $p['stock'] < 5 ? 'var(--accent-red)' : 'var(--accent-cyan)'; ?>; color: <?php echo $p['stock'] < 5 ? 'var(--accent-red)' : 'var(--accent-cyan)'; ?>; padding: 6px 12px; border-radius: 6px;">
                                <?php echo htmlspecialchars($p['stock']); ?>
                            </span>
                        </td>
                        
                        <td style="color: var(--accent-yellow); font-weight: 600;">$<?php echo number_format($p['precio_venta'], 2); ?></td>
                        <td><?php echo $p['es_usado'] ? 'Usado' : 'Nuevo'; ?></td>
                        
                        <td>
                            <div class="d-flex gap-2">
                                <a href="index.php?controller=Inventario&action=mostrarFormulario&id=<?php echo $p['id_producto']; ?>" class="btn-neon btn-neon-yellow btn-neon-sm text-decoration-none">
                                    Editar
                                </a>
                                <a href="index.php?controller=Inventario&action=eliminar&id=<?php echo $p['id_producto']; ?>" class="btn-neon btn-neon-red btn-neon-sm text-decoration-none" onclick="return confirm('¿Está seguro de eliminar este producto?');">
                                    Eliminar
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php 
                        endforeach;
                    else: 
                    ?>
                        <tr>
                            <td colspan="7" class="text-center py-4" style="color: #8A5BB2;">No hay productos en el inventario.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</body>
</html>