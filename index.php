<?php
// index.php (El punto de entrada principal de la aplicación)

// Iniciar sesión globalmente
session_start();

// ----------------------------------------------------
// 1. CARGAR ARCHIVOS NECESARIOS DE FORMA ESTATICA 
//    (Asegura que todos los Modelos y Controladores estén disponibles)
// ----------------------------------------------------

// Modelos Base
require_once 'app/models/conexion.php'; 
require_once 'app/models/ClienteModel.php';
require_once 'app/models/ProductoModel.php';

// Controladores
require_once 'app/controllers/UsuarioController.php';
require_once 'app/controllers/DashboardController.php'; 
require_once 'app/controllers/ClienteController.php';
require_once 'app/controllers/InventarioController.php';

// ----------------------------------------------------
// 2. OBTENER EL CONTROLADOR Y LA ACCIÓN SOLICITADA
// ----------------------------------------------------

$controllerName = isset($_GET['controller']) ? $_GET['controller'] : 'Usuario';
$actionName = isset($_GET['action']) ? $_GET['action'] : 'mostrarLogin';

// Construir el nombre de la clase a ejecutar
$controllerClass = $controllerName . 'Controller';

// ----------------------------------------------------
// 3. CONTROL DE ACCESO (Guardia de Seguridad)
// ----------------------------------------------------

$loginActions = ['login', 'mostrarLogin', 'logout'];

// Si NO hay sesión iniciada y la acción NO es una de las de login/logout
if (!isset($_SESSION['id_usuario']) && !in_array($actionName, $loginActions)) {
    // Redirigir siempre al login
    $controller = new UsuarioController();
    $controller->mostrarLogin();
    exit();
}

// ----------------------------------------------------
// 4. EJECUTAR EL CONTROLADOR Y LA ACCIÓN
// ----------------------------------------------------

if (class_exists($controllerClass)) {
    
    $controller = new $controllerClass();

    if (method_exists($controller, $actionName)) {
        
        // Ejecutar la acción correspondiente (Ej: ReporteController->index())
        $controller->$actionName();
        
    } else {
        // Error 404: Acción no encontrada
        echo "Error 404: Acción '{$actionName}' no fue encontrada.";
    }
    
} else {
    // Error 404: Controlador no encontrado
    echo "Error 404: Controlador '{$controllerClass}' no encontrado.";
}