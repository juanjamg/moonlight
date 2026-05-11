<?php
// /app/models/ProductoModel.php

require_once 'conexion.php'; 

class ProductoModel {
    private $db;

    public function __construct() {
        $this->db = ConexionBD::conectar(); 
    }
    // /app/models/ProductoModel.php

// AÑADIR ESTA FUNCIÓN DENTRO DE LA CLASE:

// /app/models/ProductoModel.php

// AÑADIR ESTA FUNCIÓN DENTRO DE LA CLASE:
public function obtenerDuplicado($nombre, $plataforma_id) {
    // 1. Convertir el nombre de entrada a minúsculas
    $nombre_lower = strtolower($nombre);

    // 2. Usar LOWER() en la consulta SQL para comparar ambos en minúsculas
    // Esto asegura que 'Audífonos' y 'audífonos' coincidan.
    $sql = "SELECT id_producto, stock FROM productos 
            WHERE LOWER(nombre) = :nombre_lower AND id_plataforma = :plataforma_id";
    
    $stmt = $this->db->prepare($sql);
    // Bindeamos la versión en minúsculas del nombre
    $stmt->bindParam(':nombre_lower', $nombre_lower); 
    $stmt->bindParam(':plataforma_id', $plataforma_id);
    $stmt->execute();
    
    // Retorna el producto si lo encuentra (o false si no existe)
    return $stmt->fetch(PDO::FETCH_ASSOC); 
}

// La función sumarStock debe seguir igual:
public function sumarStock($id_producto, $cantidad_a_sumar) {
    $sql = "UPDATE productos SET stock = stock + :cantidad_a_sumar WHERE id_producto = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':cantidad_a_sumar', $cantidad_a_sumar, PDO::PARAM_INT);
    $stmt->bindParam(':id', $id_producto, PDO::PARAM_INT);
    return $stmt->execute();
}
    // /app/models/ProductoModel.php

// AÑADIR ESTA FUNCIÓN DENTRO DE LA CLASE:

public function verificarDuplicado($nombre, $plataforma_id, $id_producto = null) {
    $sql = "SELECT id_producto FROM productos 
            WHERE nombre = :nombre AND id_plataforma = :plataforma_id";
    
    // Si estamos editando, ignoramos el producto actual
    if ($id_producto) {
        $sql .= " AND id_producto != :id_producto";
    }
    
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':plataforma_id', $plataforma_id);
    
    if ($id_producto) {
        $stmt->bindParam(':id_producto', $id_producto);
    }
    
    $stmt->execute();
    return $stmt->rowCount() > 0; // Devuelve true si encuentra un duplicado
}

    // --- C (Create): Insertar un nuevo producto ---
    public function crear($nombre, $codigo, $plataforma_id, $stock, $costo, $venta, $es_usado) {
        $sql = "INSERT INTO productos (nombre, codigo_barras, id_plataforma, stock, precio_costo, precio_venta, es_usado) 
                VALUES (:nombre, :codigo, :plataforma_id, :stock, :costo, :venta, :es_usado)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':codigo', $codigo);
        $stmt->bindParam(':plataforma_id', $plataforma_id);
        $stmt->bindParam(':stock', $stock);
        $stmt->bindParam(':costo', $costo);
        $stmt->bindParam(':venta', $venta);
        $stmt->bindParam(':es_usado', $es_usado);
        return $stmt->execute();
    }

    // --- R (Read): Obtener todos los productos ---
    public function obtenerTodos() {
        // CORRECCIÓN CLAVE: LEFT JOIN para asegurar que todos los productos se muestren.
        $sql = "SELECT p.*, plat.nombre AS plataforma_nombre 
                FROM productos p 
                LEFT JOIN plataformas plat ON p.id_plataforma = plat.id_plataforma 
                ORDER BY p.nombre ASC";
        
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    // --- R (Read): Obtener solo las plataformas para el selector ---
    public function obtenerPlataformas() {
        $sql = "SELECT id_plataforma, nombre FROM plataformas ORDER BY nombre ASC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // --- R (Read): Obtener un solo producto por ID (para edición) ---
    public function obtenerPorId($id) {
        $sql = "SELECT * FROM productos WHERE id_producto = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // --- U (Update): Actualizar un producto existente ---
    public function actualizar($id, $nombre, $codigo, $plataforma_id, $stock, $costo, $venta, $es_usado) {
        $sql = "UPDATE productos SET nombre = :nombre, codigo_barras = :codigo, id_plataforma = :plataforma_id, 
                stock = :stock, precio_costo = :costo, precio_venta = :venta, es_usado = :es_usado 
                WHERE id_producto = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':codigo', $codigo);
        $stmt->bindParam(':plataforma_id', $plataforma_id);
        $stmt->bindParam(':stock', $stock);
        $stmt->bindParam(':costo', $costo);
        $stmt->bindParam(':venta', $venta);
        $stmt->bindParam(':es_usado', $es_usado);
        return $stmt->execute();
    }

    // --- D (Delete): Eliminar un producto ---
    public function eliminar($id) {
        $sql = "DELETE FROM productos WHERE id_producto = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // --- Función para la búsqueda AJAX del POS ---
    public function buscarProductos($query) {
        $sql = "SELECT id_producto, nombre, precio_venta, stock, es_usado, codigo_barras 
                FROM productos 
                WHERE nombre LIKE :query OR codigo_barras LIKE :query LIMIT 10";
            
        $stmt = $this->db->prepare($sql);
        
        $search_query = '%' . $query . '%';
        $stmt->bindParam(':query', $search_query);
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}