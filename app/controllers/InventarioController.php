<?php
// /app/controllers/InventarioController.php
// Este controlador gestiona las operaciones CRUD para los productos (Inventario)
// e implementa la regla de negocio de SUMAR STOCK en lugar de crear duplicados.

// RUTA AL MODELO:
require_once __DIR__ . '/../models/ProductoModel.php'; 

class InventarioController {
    
    // Muestra el listado de productos
    public function listar() {
        // [Lógica de Control de Acceso y Carga de Datos]
        if ($_SESSION['rol'] !== 'Admin' & $_SESSION['rol'] !== 'Vendedor') {
            header('Location: index.php?controller=Dashboard&action=index');
            exit();
        }
        
        $model = new ProductoModel();
        $productos = $model->obtenerTodos(); 
        $plataformas = $model->obtenerPlataformas(); 

        // RUTA PORTABLE A LA VISTA:
        require_once __DIR__ . '/../../public/views/inventario_listado.php';
    }

    // Muestra el formulario de creación o edición
    public function mostrarFormulario() {
        // [Lógica de Control de Acceso y Carga de Datos]
        if ($_SESSION['rol'] !== 'Admin' & $_SESSION['rol'] !== 'Vendedor') {
            header('Location: index.php?controller=Dashboard&action=index');
            exit();
        }

        $model = new ProductoModel();
        $plataformas = $model->obtenerPlataformas();
        $producto = null; 
        
        // Si la URL contiene un ID, se está editando el producto
        if (isset($_GET['id'])) {
            $producto = $model->obtenerPorId($_GET['id']);
        }
        
        // RUTA PORTABLE A LA VISTA:
        require_once __DIR__ . '/../../public/views/inventario_formulario.php';
    }
    
    /**
     * Procesa los datos del formulario de inventario.
     * Esta función maneja tres posibles acciones:
     * 1. ACTUALIZAR (Si $id está presente).
     * 2. SUMAR STOCK (Si el producto ya existe por nombre/plataforma).
     * 3. CREAR NUEVO (Si no existe ningún duplicado).
     */
    public function guardar() {
        if ($_SESSION['rol'] !== 'Admin' & $_SESSION['rol'] !== 'Vendedor') {
            header('Location: index.php?controller=Dashboard&action=index');
            exit();
        }
        
        // 1. OBTENCIÓN Y SANEAMIENTO DE DATOS
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
        $codigo = filter_input(INPUT_POST, 'codigo_barras', FILTER_SANITIZE_STRING);
        $plataforma_id = filter_input(INPUT_POST, 'id_plataforma', FILTER_VALIDATE_INT);
        
        // Manejo de valores numéricos nulos o vacíos para campos NOT NULL en la DB
        $stock = filter_input(INPUT_POST, 'stock', FILTER_VALIDATE_INT);
        if ($stock === false || $stock === null) { $stock = 0; }
        $costo = filter_input(INPUT_POST, 'precio_costo', FILTER_VALIDATE_FLOAT);
        if ($costo === false || $costo === null) { $costo = 0.00; }
        $venta = filter_input(INPUT_POST, 'precio_venta', FILTER_VALIDATE_FLOAT);
        if ($venta === false || $venta === null) { $venta = 0.00; }
        
        $es_usado = isset($_POST['es_usado']) ? 1 : 0;
        
        $model = new ProductoModel();
        $msg = 'error'; // Mensaje por defecto

        // 2. Lógica para ACTUALIZAR (Edición)
        if ($id) {
            // Si el ID existe, SIEMPRE se actualizan los datos del producto existente.
            $resultado = $model->actualizar($id, $nombre, $codigo, $plataforma_id, $stock, $costo, $venta, $es_usado);
            $msg = $resultado ? 'success_edicion' : 'error';
            
        } else {
            // 3. Lógica para CREACIÓN / SUMA DE STOCK
            
            // A. Verificar si existe un producto idéntico (Nombre/Plataforma, case-insensitive)
            $producto_existente = $model->obtenerDuplicado($nombre, $plataforma_id);

            if ($producto_existente) {
                // B. SI EXISTE: Sumar el stock a la cantidad existente.
                $id_existente = $producto_existente['id_producto'];
                
                $resultado = $model->sumarStock($id_existente, $stock);
                
                $msg = $resultado ? 'success_stock_sumado' : 'error';
                
            } else {
                // C. NO EXISTE: Crear el nuevo producto en la base de datos.
                $resultado = $model->crear($nombre, $codigo, $plataforma_id, $stock, $costo, $venta, $es_usado);
                $msg = $resultado ? 'success' : 'error';
            }
        }
        
        // 4. Redirigir al listado con el mensaje de estado
        header("Location: index.php?controller=Inventario&action=listar&msg=$msg");
        exit();
    }
    
    // Función para eliminar un producto
    public function eliminar() {
        // [Lógica de Control de Acceso y Eliminación]
        if ($_SESSION['rol'] !== 'Admin') {
            header('Location: index.php?controller=Dashboard&action=index');
            exit();
        }

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        
        if ($id) {
            $model = new ProductoModel();
            // La base de datos maneja la eliminación en cascada de los detalles de venta
            $model->eliminar($id); 
        }
        
        header('Location: index.php?controller=Inventario&action=listar');
        exit();
    }
}