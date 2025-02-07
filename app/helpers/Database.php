<?php
// app/helpers/Database.php

class Database {
    // Instancia única (Singleton) para reutilizar la misma conexión en toda la aplicación
    private static $instance = null;
    private $pdo;

    // Constructor privado para evitar instanciación directa
    private function __construct() {
        // Cargar la configuración desde el archivo config.php
        // Usamos __DIR__ para construir la ruta correcta
        $config = require __DIR__ . '/../../config/config.php';
        $dbConfig = $config['db'];

        // Construir el DSN para MySQL (agregamos charset para evitar problemas con acentos)
        $dsn = "mysql:host={$dbConfig['host']};dbname={$dbConfig['dbname']};charset=utf8mb4";

        try {
            // Crear la conexión usando PDO
            $this->pdo = new PDO($dsn, $dbConfig['user'], $dbConfig['password']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            // En caso de error, detenemos la ejecución mostrando el error
            die("Error en la conexión: " . $e->getMessage());
        }
    }

    // Método para obtener la instancia única de Database
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    // Método para obtener el objeto PDO
    public function getConnection() {
        return $this->pdo;
    }
}
