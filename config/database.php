<?php
// config/database.php

class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        // Importa as definições de constantes do arquivo original para manter compatibilidade
        // Ou define aqui mesmo para centralizar.
        $host = 'localhost';
        $db   = 'agenda';
        $user = 'root';
        $pass = '';

        try {
            $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
            $this->pdo = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erro ao conectar ao banco de dados: " . $e->getMessage());
        }
    }

    // Padrão Singleton: impede a criação de múltiplas instâncias
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->pdo;
    }

    // Impede clonagem e desserialização
    private function __clone() {}
    public function __wakeup() {
        throw new Exception("Não é permitido desserializar a classe Database.");
    }
}
