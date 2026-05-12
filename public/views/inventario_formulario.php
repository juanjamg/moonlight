<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $producto ? 'Editar' : 'Agregar'; ?> Producto | Moonlight Geek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/css/estilos.css" rel="stylesheet"> 
    
</head>
<body>
    <?php require_once 'sidebar.php'; ?>

    <div class="main-content" style="margin-left: 260px; padding: 20px;"> 
        
        <div class="container form-wrapper">
            <div class="form-card">
                
                <h1 class="mb-5 text-center neon-title" style="font-size: 1.8rem;">
                    <?php echo $producto ? '✏️ EDITAR PRODUCTO' : '➕ AGREGAR PRODUCTO'; ?>
                </h1>
                
                <form action="index.php?controller=Inventario&action=guardar" method="POST">
                    
                    <input type="hidden" name="id" value="<?php echo $producto ? htmlspecialchars($producto['id_producto']) : ''; ?>">

                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="nombre" class="form-label">NOMBRE DEL PRODUCTO</label>
                            <input type="text" class="form-control form-control-neon" id="nombre" name="nombre" value="<?php echo $producto ? htmlspecialchars($producto['nombre']) : ''; ?>" placeholder="Ej. Zelda: Breath of the Wild" required>
                        </div>
                        <div class="col-md-6">
                            <label for="codigo_barras" class="form-label">CÓDIGO DE BARRAS</label>
                            <input type="text" class="form-control form-control-neon" id="codigo_barras" name="codigo_barras" value="<?php echo $producto ? htmlspecialchars($producto['codigo_barras']) : ''; ?>" placeholder="Opcional" required>
                        </div>
                    </div>

                    <div class="row mb-4 align-items-center">
                        
                        <div class="col-md-4 mb-3 mb-md-0">
                            <label for="id_plataforma" class="form-label">PLATAFORMA</label>
                            <select class="form-control form-control-neon" id="id_plataforma" name="id_plataforma" style="background-color: #0b0c10;" required>
                                <option value="">Seleccione...</option>
                                <?php 
                                if (isset($plataformas) && is_array($plataformas)):
                                    foreach ($plataformas as $plat): 
                                ?>
                                    <option value="<?php echo $plat['id_plataforma']; ?>"
                                        <?php echo $producto && $producto['id_plataforma'] == $plat['id_plataforma'] ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($plat['nombre']); ?>
                                    </option>
                                <?php 
                                    endforeach;
                                endif;
                                ?>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3 mb-md-0">
                            <label for="stock" class="form-label">STOCK / CANTIDAD</label>
                            <input type="number" class="form-control form-control-neon" id="stock" name="stock" value="<?php echo $producto ? htmlspecialchars($producto['stock']) : '0'; ?>" required min="0">
                        </div>

                        <div class="col-md-4 d-flex justify-content-md-start justify-content-center mt-2 mt-md-0">
                            <div class="form-check d-flex align-items-center">
                                <input class="form-check-input form-check-input-neon" type="checkbox" id="es_usado" name="es_usado" value="1"
                                    <?php echo $producto && $producto['es_usado'] ? 'checked' : ''; ?>>
                                <label class="form-check-label pt-1" for="es_usado" style="color: var(--text-light); font-weight: 600; cursor: pointer;">
                                    PRODUCTO USADO
                                </label>
                            </div>
                        </div>

                    </div>

                    <div class="row mb-5">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="precio_costo" class="form-label">PRECIO DE COSTO ($)</label>
                            <input type="number" step="0.01" class="form-control form-control-neon" id="precio_costo" name="precio_costo" value="<?php echo $producto ? htmlspecialchars($producto['precio_costo']) : '0.00'; ?>" required min="0" style="color: var(--accent-yellow); font-weight: bold;">
                        </div>
                        <div class="col-md-6">
                            <label for="precio_venta" class="form-label">PRECIO DE VENTA ($)</label>
                            <input type="number" step="0.01" class="form-control form-control-neon" id="precio_venta" name="precio_venta" value="<?php echo $producto ? htmlspecialchars($producto['precio_venta']) : '0.00'; ?>" required min="0" style="color: var(--accent-cyan); font-weight: bold;">
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-3">
                        <a href="index.php?controller=Inventario&action=listar" class="btn-neon btn-neon-cancel px-4 py-2 text-decoration-none">
                            Cancelar
                        </a>
                        <button type="submit" class="btn-neon btn-neon-blue px-4 py-2">
                            💾 Guardar Producto
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</body>
</html>