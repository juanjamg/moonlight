<?php
// /app/models/ClienteModel.php

require_once 'conexion.php'; 

class ClienteModel {
    private $db;

    public function __construct() {
        // Establece la conexión a la base de datos al instanciar el modelo
        $this->db = ConexionBD::conectar(); 
    }

    // --- C (Create): Insertar un nuevo cliente ---
    public function crear($nombre, $telefono, $email, $rfc) {
    // ACTUALIZAR SQL: Añadir rfc
    $sql = "INSERT INTO clientes (nombre, telefono, email, rfc) VALUES (:nombre, :telefono, :email, :rfc)";
    
    $stmt = $this->db->prepare($sql);
    
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':telefono', $telefono);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':rfc', $rfc); // AÑADIR BIND
    
    return $stmt->execute();
}

    // --- R (Read): Obtener todos los clientes ---
    public function obtenerTodos() {
        $sql = "SELECT * FROM clientes ORDER BY nombre ASC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    // --- R (Read): Obtener un solo cliente por ID (para edición) ---
    public function obtenerPorId($id) {
    // Asegúrate de que el SELECT * trae el campo RFC
    $sql = "SELECT * FROM clientes WHERE id_cliente = :id"; 
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

    // --- U (Update): Actualizar un cliente existente ---
    public function actualizar($id, $nombre, $telefono, $email, $rfc) {
    // ACTUALIZAR SQL: Añadir rfc
    $sql = "UPDATE clientes SET nombre = :nombre, telefono = :telefono, email = :email, rfc = :rfc WHERE id_cliente = :id";

    $stmt = $this->db->prepare($sql);
    
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':telefono', $telefono);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':rfc', $rfc); // AÑADIR BIND
    
    return $stmt->execute();
}
    // --- D (Delete): Eliminar un cliente ---
    public function eliminar($id) {
        $sql = "DELETE FROM clientes WHERE id_cliente = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    // /app/models/ClienteModel.php

// AÑADIR ESTA FUNCIÓN AL FINAL DE LA CLASE:

public function buscarClientes($query) {
    // Busca por nombre o email
    $sql = "SELECT id_cliente, nombre, email, telefono 
            FROM clientes 
            WHERE nombre LIKE :query OR telefono LIKE :query OR email LIKE :query LIMIT 10";
            
    $stmt = $this->db->prepare($sql);
    
    // Agregamos comodines para la búsqueda parcial
    $search_query = '%' . $query . '%';
    $stmt->bindParam(':query', $search_query);
    
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}
