<?php
// /app/models/conexion.php

// 1. Cargamos el autoloader de Composer. 
// Subimos dos niveles (../..) para llegar a la raíz desde app/models/
require_once dirname(__DIR__, 2) . '/vendor/autoload.php';

use Dotenv\Dotenv;

/**
 * CLASE DE CONEXIÓN A LA BASE DE DATOS (Adaptada con Dotenv)
 */
class ConexionBD { 
    
    private static $conn = null;

    /**
     * Establece y devuelve la conexión PDO.
     */
    public static function conectar() {
        if (self::$conn === null) {
            try {
                // 2. Inicializamos Dotenv para cargar las variables del archivo .env
                // Buscamos el archivo .env en la raíz del proyecto
                $dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
                $dotenv->load();

                // 3. Extraemos las variables de entorno de $_ENV
                $host = $_ENV['DB_HOST'];
                $db_name = $_ENV['DB_NAME'];
                $username = $_ENV['DB_USER'];
                $password = $_ENV['DB_PASS'];

                // Cadena de conexión DSN usando las variables cargadas
                $dsn = "mysql:host=$host;dbname=$db_name";
                
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8" 
                ];

                // Intenta establecer la conexión
                self::$conn = new PDO($dsn, $username, $password, $options);
                
            } catch(PDOException $exception) {
                // Error de conexión
                error_log("Error de conexión PDO: " . $exception->getMessage());
                die("Error al intentar conectar con la base de datos. Por favor, revisa la configuración del sistema."); 
            }
        }
        return self::$conn;
    }
}