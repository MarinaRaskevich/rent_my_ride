<?php
// require_once __DIR__ . '/Database.php';

class BaseModel
{
    protected PDO $db;

    public function __construct()
    {
        $this->db = Database::dbConnect();
    }

    public function getPDO()
    {
        return $this->db;
    }


    public function getLastInsertId(): int
    {
        return $this->db->lastInsertId();
    }

    /**
     * Get the value of db
     */
    public function getDb(): PDO
    {
        return $this->db;
    }
}
