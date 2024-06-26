<?php
require_once __DIR__ . '/../helpers/BaseModel.php';

class Rent extends BaseModel
{
    private int $id_rents;
    private ?DateTime $startdate;
    private ?DateTime $enddate;
    private DateTime $created_at;
    private DateTime $confirmed_at;
    private ?int $id_vehicle;
    private ?int $id_client;

    public function __construct(?DateTime $startdate = null, ?DateTime $enddate = null, ?int $id_vehicle = null, ?int $id_client = null)
    {
        $this->startdate = $startdate;
        $this->enddate = $enddate;
        $this->id_vehicle = $id_vehicle;
        $this->id_client = $id_client;
        parent::__construct();
    }

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

    public function setId_vehicle(?int $id_vehicle)
    {
        $this->id_vehicle = $id_vehicle;
    }

    public function setId_client(?int $id_client)
    {
        $this->id_client = $id_client;
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

    public function getId_vehicle(): ?int
    {
        return $this->id_vehicle;
    }

    public function getId_client(): ?int
    {
        return $this->id_client;
    }

    public function insert(): bool
    {
        $sql = 'INSERT INTO `rents` 
                    (`startdate`, `enddate`, `id_vehicle`, `id_client`) 
                VALUES
                    (:startdate, :enddate, :id_vehicle, :id_client);';

        $sth = $this->db->prepare($sql);

        $sth->bindValue(':startdate', $this->getStartdate()->format('Y-m-d H:i:s'));
        $sth->bindValue(':enddate', $this->getEnddate()->format('Y-m-d H:i:s'));
        $sth->bindValue(':id_vehicle', $this->getId_vehicle());
        $sth->bindValue(':id_client', $this->getId_client());

        $sth->execute();

        if ($sth->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
