<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $cliente ? 'Editar' : 'Agregar'; ?> Cliente | Moonlight Geek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/estilos.css">
</head>
<body>

    <div class="container form-wrapper">
        <div class="form-card">
            
            <h1 class="mb-4 text-center neon-title" style="font-size: 1.8rem;">
                <?php echo $cliente ? '✏️ EDITAR CLIENTE' : '➕ AGREGAR CLIENTE'; ?>
            </h1>
            
            <form action="index.php?controller=Cliente&action=guardar" method="POST">
                
                <input type="hidden" name="id" value="<?php echo $cliente ? htmlspecialchars($cliente['id_cliente']) : ''; ?>">

                <div class="mb-4">
                    <label for="nombre" class="form-label">NOMBRE COMPLETO</label>
                    <input type="text" class="form-control form-control-neon" 
                    id="nombre" 
                    name="nombre" 
                    value="<?php echo $cliente ? htmlspecialchars($cliente['nombre']) : ''; ?>" 
                    placeholder="Ej. Juan Pérez"
                    pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+"
                    title="El nombre solo debe contener letras y espacios"
                    oninput="this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '')"
                    required>
                </div>
                
                <div class="row">
                    
                    <div class="col-md-6 mb-4">
                        <label for="telefono" class="form-label">TELÉFONO</label>
                        <input type="tel" 
                               class="form-control form-control-neon" 
                               id="telefono" 
                               name="telefono" 
                               value="<?php echo $cliente ? htmlspecialchars($cliente['telefono']) : ''; ?>" 
                               maxlength="10"
                               pattern="[0-9]{10}"
                               title="Ingresa un número de teléfono válido de 10 dígitos"
                               placeholder="10 dígitos"
                               oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                               required>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="email" class="form-label">EMAIL</label>
                        <input type="email" 
                               class="form-control form-control-neon" 
                               id="email" 
                               name="email" 
                               value="<?php echo $cliente ? htmlspecialchars($cliente['email']) : ''; ?>" 
                               pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}"
                               placeholder="usuario@dominio.com"
                               required>
                        <div id="email-error" class="text-danger mt-1" style="display: none; font-size: 0.8rem; text-shadow: 0 0 5px rgba(255,0,60,0.5);">
                            ❌ Formato incorrecto.
                        </div>
                    </div>

                </div>

                <div class="mb-5">
                    <label for="rfc" class="form-label">RFC <span style="font-size: 0.8rem; color: #8A5BB2;">(Registro Federal de Contribuyentes)</span></label>
                    <input type="text" 
                           class="form-control form-control-neon" 
                           id="rfc" 
                           name="rfc" 
                           value="<?php echo $cliente ? htmlspecialchars($cliente['rfc']) : ''; ?>" 
                           maxlength="13" 
                           placeholder="Ej: ABCD123456XYZ"
                           style="text-transform: uppercase;" required>
                </div>

                <div class="d-flex justify-content-end gap-3">
                    <a href="index.php?controller=Cliente&action=listar" class="btn-neon btn-neon-cancel px-4 py-2">
                        Cancelar
                    </a>
                    <button type="submit" class="btn-neon btn-neon-blue px-4 py-2">
                        💾 Guardar Cliente
                    </button>
                </div>

            </form>
        </div>
    </div>

    <script src="public/js/validar_email.js"></script>
</body>
</html>