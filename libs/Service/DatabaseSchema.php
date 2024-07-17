<?php
namespace Budgetcontrol\Registry\Service;

use PDO;

class DatabaseSchema {
    private $pdo;

    public function __construct($host, $db, $user, $pass) {
        $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $this->pdo = new PDO($dsn, $user, $pass, $options);
    }

    public function getSchema($tableName) {
        $stmt = $this->pdo->prepare(
            "SELECT COLUMN_NAME, DATA_TYPE, IS_NULLABLE, COLUMN_KEY, COLUMN_DEFAULT, EXTRA
            FROM INFORMATION_SCHEMA.COLUMNS
            WHERE TABLE_SCHEMA = :dbName AND TABLE_NAME = :tableName"
        );
        $stmt->execute([
            'dbName' => $this->pdo->query('select database()')->fetchColumn(),
            'tableName' => $tableName,
        ]);
        return $stmt->fetchAll();
    }
}