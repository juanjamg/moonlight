<?php
// app/models/UsuarioModel.php

require_once 'conexion.php'; // Incluye tu archivo de conexión

class UsuarioModel {
    private $db;

    public function __construct() {
        // Obtenemos la conexión PDO usando tu clase ConexionBD
        $this->db = ConexionBD::conectar(); 
    }

    public function obtenerPorNombreUsuario($nombre_usuario) {
        $sql = "SELECT id_usuario, nombre_usuario, password_hash, rol 
                FROM usuarios 
                WHERE nombre_usuario = :nombre_usuario";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nombre_usuario', $nombre_usuario);
        $stmt->execute();
        
        // Retorna los datos del usuario o false
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}