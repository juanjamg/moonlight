<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Moonlight Geek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Rajdhani:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/css/estilos.css">
</head>
<body class="login-body">

    <div class="container">
        <div class="row justify-content-center w-100 m-0">
            <div class="login-container">
                <h2 class="text-center mb-4 login-title">🎮 ACCESO AL SISTEMA</h2>
                
                <?php if (isset($error_message) && $error_message): ?>
                    <div class="alert alert-neon-danger text-center" role="alert">
                        <?php echo htmlspecialchars($error_message); ?>
                    </div>
                <?php endif; ?>
                
                <form action="index.php?controller=Usuario&action=login" method="POST">
                    
                    <div class="mb-3">
                        <label for="nombre_usuario" class="form-label">Usuario</label>
                        <input type="text" class="form-control form-control-neon" id="nombre_usuario" name="nombre_usuario" required>
                    </div>
                    
                    <div class="mb-4">
                        <label for="password_plana" class="form-label">Contraseña</label>
                        <input type="password" class="form-control form-control-neon" id="password_plana" name="password_plana" required>
                    </div>
                    
                    <button type="submit" class="btn btn-neon-purple w-100 mt-2">Ingresar</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>