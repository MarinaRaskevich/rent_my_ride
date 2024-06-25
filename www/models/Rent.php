<?php
require_once __DIR__ . '/../helpers/BaseModel.php';

class Rent extends BaseModel
{
    private int $id_rents;
    private DateTime $startdate;
    private DateTime $enddate;
    private DateTime $created_at;
    private DateTime $confirmed_at;
    private int $id_vehicles;
    private int $id_clients;

    //Setters
    public function setId_rents(int $id_rents)
    {
        $this->id_rents = $id_rents;
    }

    public function setStartdate(string $startdate)
    {
        $this->startdate = new DateTime($startdate);
    }

    public function setEnddate(string $enddate)
    {
        $this->enddate = new DateTime($enddate);
    }

    public function setCreated_at(string $created_at)
    {
        $this->created_at = new DateTime($created_at);
    }

    public function setConfirmed_at(?string $confirmed_at)
    {
        $this->startdate = new DateTime($confirmed_at);
    }

    public function setId_vehicles(?int $id_vehicles)
    {
        $this->id_vehicles = $id_vehicles;
    }

    public function setId_clients(?int $id_clients)
    {
        $this->id_clients = $id_clients;
    }

    // Getters
    public function getId_rents(): int
    {
        return $this->id_rents;
    }

    public function getStartdate(): DateTime
    {
        return $this->startdate;
    }

    public function getEnddate(): DateTime
    {
        return $this->enddate;
    }

    public function getCreated_at(): DateTime
    {
        return $this->created_at;
    }

    public function getConfirmed_at(): ?DateTime
    {
        return $this->confirmed_at;
    }

    public function getId_vehicles(): ?int
    {
        return $this->id_vehicles;
    }

    public function getId_clients(): ?int
    {
        return $this->id_clients;
    }
}
