<?php

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
}
