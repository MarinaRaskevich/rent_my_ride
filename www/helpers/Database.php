<?php

class Database
{
    private static ?PDO $db = null;

    public static function dbConnect()
    {
        try {
            $options = [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ
            ];
            if (is_null(self::$db)) {
                self::$db = new PDO(DSN, USERNAME, PASSWORD, $options);
            }
            return self::$db;
        } catch (\PDOException $e) {
            echo sprintf('La connexion a échoué avec le message %s', $e->getMessage());
            die();
        }
    }
}
