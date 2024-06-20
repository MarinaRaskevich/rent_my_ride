<?php
require_once __DIR__ . '/../config/config.php';

class Database
{
    public static function dbConnect()
    {
        try {
            $options = [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ
            ];
            $pdo = new PDO(DSN, USERNAME, PASSWORD, $options);
            return $pdo;
        } catch (\PDOException $e) {
            echo sprintf('La connexion a échoué avec le message %s', $e->getMessage());
            die();
        }
    }
}
