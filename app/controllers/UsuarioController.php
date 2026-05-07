<?php
// /app/controllers/UsuarioController.php

// RUTA CORREGIDA al Modelo: Usa __DIR__ para ser robusto. Sube a /app/ y luego entra a models/
require_once __DIR__ . '/../models/UsuarioModel.php'; 

class UsuarioController {
    
    // /app/controllers/UsuarioController.php

public function mostrarLogin($error_message = null) {
    // RUTA FINAL CORREGIDA: Usa DOCUMENT_ROOT para asegurar que la ruta comienza desde htdocs/
    require_once $_SERVER['DOCUMENT_ROOT'] . '/MOONLIGHT/public/views/login.php'; 
}

    // Procesa la solicitud del formulario (cuando el usuario presiona "Ingresar").
    public function login() {
        $nombre_usuario = filter_input(INPUT_POST, 'nombre_usuario');
        $password_plana = filter_input(INPUT_POST, 'password_plana'); 

        $model = new UsuarioModel();
        $usuario = $model->obtenerPorNombreUsuario($nombre_usuario);

        // 1. Verificar si el usuario existe Y si la contraseña coincide (usando el hash)
        if ($usuario && password_verify($password_plana, $usuario['password_hash'])) {
            
            // 2. Credenciales VÁLIDAS: Asignar variables de sesión
            // La función session_start() ya está en index.php
            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            $_SESSION['nombre_usuario'] = $usuario['nombre_usuario'];
            $_SESSION['rol'] = $usuario['rol'];
            
            // Redirigir al panel de control (Dashboard)
            header('Location: index.php?controller=Dashboard&action=index');
            exit();
            
        } else {
            // 3. Credenciales INVÁLIDAS: Mostrar error
            $error_message = "Usuario o contraseña incorrectos.";
            $this->mostrarLogin($error_message);
        }
    }
    
    // Función para cerrar sesión
    public function logout() {
        session_destroy();
        // Redirigir al login
        header('Location: index.php?controller=Usuario&action=mostrarLogin');
        exit();
    }
}