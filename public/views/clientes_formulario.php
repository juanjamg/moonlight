<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo $cliente ? 'Editar' : 'Agregar'; ?> Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4"><?php echo $cliente ? '✏️ Editar Cliente' : '➕ Agregar Nuevo Cliente'; ?></h1>
        
        <form action="index.php?controller=Cliente&action=guardar" method="POST">
            
            <input type="hidden" name="id" value="<?php echo $cliente ? htmlspecialchars($cliente['id_cliente']) : ''; ?>">

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre Completo</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $cliente ? htmlspecialchars($cliente['nombre']) : ''; ?>" required>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $cliente ? htmlspecialchars($cliente['telefono']) : ''; ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $cliente ? htmlspecialchars($cliente['email']) : ''; ?>">
                </div>
            </div>
            <div class="mb-3">
    <label for="rfc" class="form-label">RFC (Registro Federal de Contribuyentes)</label>
    <input type="text" class="form-control" id="rfc" name="rfc" 
           value="<?php echo $cliente ? htmlspecialchars($cliente['rfc']) : ''; ?>" 
           maxlength="13" placeholder="Ej: ABCD123456XYZ">
</div>

            <button type="submit" class="btn btn-success me-2">💾 Guardar Cliente</button>
            <a href="index.php?controller=Cliente&action=listar" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>