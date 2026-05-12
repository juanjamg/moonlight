<?php
// /app/controllers/ClienteController.php

// RUTA CORREGIDA al Modelo:
require_once __DIR__ . '/../models/ClienteModel.php'; 

class ClienteController {
    
    // Función que muestra la tabla con todos los clientes
    public function listar() {
        if (session_status() == PHP_SESSION_NONE) {
        session_start();
        }

        if ($_SESSION['rol'] !== 'Admin' & $_SESSION['rol'] !== 'Vendedor') {
            header('Location: index.php?controller=Dashboard&action=index');
            exit();
        }
        
        $model = new ClienteModel();
        $clientes = $model->obtenerTodos(); 

        // RUTA CORREGIDA para la Vista de Listado:
        require_once $_SERVER['DOCUMENT_ROOT'] . '/MOONLIGHT/public/views/clientes_listado.php';
    }

    // Función para mostrar el formulario de creación o edición
    public function mostrarFormulario() {
        if ($_SESSION['rol'] !== 'Admin' & $_SESSION['rol'] !== 'Vendedor') {
            header('Location: index.php?controller=Dashboard&action=index');
            exit();
        }

        $model = new ClienteModel();
        $cliente = null; 
        
        // Si hay un ID en la URL, se carga el cliente para edición
        if (isset($_GET['id'])) {
            $cliente = $model->obtenerPorId($_GET['id']);
        }
        
        // RUTA CORREGIDA para la Vista de Formulario:
        require_once $_SERVER['DOCUMENT_ROOT'] . '/MOONLIGHT/public/views/clientes_formulario.php';
    }
    
    // Función que procesa el formulario (Guarda y Actualiza)
    public function guardar() {
    // ... (Control de Acceso) ...
    if ($_SESSION['rol'] !== 'Admin' & $_SESSION['rol'] !== 'Vendedor') {
        header('Location: index.php?controller=Dashboard&action=index');
        exit();
        }
    // 1. Sanear y obtener los datos
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    // En tu ClienteController.php al recibir el formulario:
    // Filtramos para conservar únicamente los caracteres numéricos
    $telefono = filter_var($_POST['telefono'] ?? '', FILTER_SANITIZE_NUMBER_INT);
    if (strlen($telefono) !== 10) {
        header("Location: index.php?controller=Cliente&action=mostrarFormulario&error=telefono_invalido");
        exit();
        }
    
    $email = $_POST['email'] ?? '';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // El correo no es válido, detenemos el proceso y enviamos error
        header("Location: index.php?controller=Cliente&action=mostrarFormulario&error=email_invalido");
        exit();
        }
    
    // ¡NUEVO CAMPO! Obtener y sanear el RFC
    $rfc = filter_input(INPUT_POST, 'rfc', FILTER_SANITIZE_STRING); 
    
    $model = new ClienteModel();
    
    if ($id) {
        // Es edición (AÑADIR $rfc al final)
        $resultado = $model->actualizar($id, $nombre, $telefono, $email, $rfc);
    } else {
        // Es creación (AÑADIR $rfc al final)
        $resultado = $model->crear($nombre, $telefono, $email, $rfc);
    }
    
    $msg = $resultado ? 'success' : 'error';
    header("Location: index.php?controller=Cliente&action=listar&msg=$msg");
    exit();
}
    
    // Función para eliminar un cliente
    public function eliminar() {
        if ($_SESSION['rol'] !== 'Admin') {
            header('Location: index.php?controller=Dashboard&action=index');
            exit();
        }

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        
        if ($id) {
            $model = new ClienteModel();
            $model->eliminar($id);
        }
        
        header('Location: index.php?controller=Cliente&action=listar');
        exit();
    }
}