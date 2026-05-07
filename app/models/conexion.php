<?php
// /app/models/conexion.php

/**
 * CLASE DE CONEXIÓN A LA BASE DE DATOS
 * Implementa el patrón Singleton (conexión única) y utiliza PDO 
 * para asegurar consultas preparadas, previniendo inyección SQL.
 */
class ConexionBD { 
    // Parámetros de conexión a MySQL
    private static $host = 'localhost';
    private static $db_name = 'tienda_videojuegos_db'; 
    private static $username = 'root'; 
    private static $password = ''; // Contraseña de XAMPP/MySQL
    
    private static $conn = null;

    /**
     * Establece y devuelve la conexión PDO.
     * Si la conexión ya existe, devuelve la instancia existente (Singleton).
     * @return PDO|null Retorna el objeto de conexión PDO.
     */
    public static function conectar() {
        if (self::$conn === null) {
            try {
                // Cadena de conexión DSN
                $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$db_name;
                
                // Opciones de PDO: Manejo de errores y codificación UTF-8
                $options = [
                    // Muestra errores como excepciones (más fácil de manejar)
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
                    // Establece el fetch mode por defecto a array asociativo
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    // Establece el juego de caracteres a UTF-8
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8" 
                ];

                // Intenta establecer la conexión
                self::$conn = new PDO($dsn, self::$username, self::$password, $options);
                
            } catch(PDOException $exception) {
                // Captura el error de conexión (ej. credenciales incorrectas o servidor caído)
                error_log("Error de conexión PDO: " . $exception->getMessage());
                die("Error al intentar conectar con la base de datos. Por favor, revisa XAMPP."); 
            }
        }
        return self::$conn;
    }
}