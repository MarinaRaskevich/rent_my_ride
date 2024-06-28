<?php
require_once __DIR__ . '/../helpers/BaseModel.php';

class Rent extends BaseModel
{
    private int $id_rents;
    private ?DateTime $startdate;
    private ?DateTime $enddate;
    private DateTime $created_at;
    private DateTime $confirmed_at;
    private ?string $status;
    private ?int $id_vehicle;
    private ?int $id_client;

    public function __construct(?DateTime $startdate = null, ?DateTime $enddate = null, ?int $id_vehicle = null, ?int $id_client = null, ?int $status = null,)
    {
        $this->startdate = $startdate;
        $this->enddate = $enddate;
        $this->id_vehicle = $id_vehicle;
        $this->id_client = $id_client;
        $this->status = $status;
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
        $this->confirmed_at = new DateTime($confirmed_at);
    }

    public function setStatus(?string $status)
    {
        $this->status = $status;
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

    public function getStatus(): ?string
    {
        return $this->status;
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
                    (`startdate`, `enddate`, `id_vehicle`, `id_client`, `status`) 
                VALUES
                    (:startdate, :enddate, :id_vehicle, :id_client, :status);';

        $sth = $this->db->prepare($sql);

        $sth->bindValue(':startdate', $this->getStartdate()->format('Y-m-d H:i:s'));
        $sth->bindValue(':enddate', $this->getEnddate()->format('Y-m-d H:i:s'));
        $sth->bindValue(':id_vehicle', $this->getId_vehicle());
        $sth->bindValue(':id_client', $this->getId_client());
        $sth->bindValue(':id_vehicle', $this->getId_vehicle());
        $sth->bindValue(':status', $this->getStatus());

        $sth->execute();

        if ($sth->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `rents`.*, `vehicles`.`registration`, CONCAT(`vehicles`.`brand`,' ', `vehicles`.`model`) AS 'vehicleName', CONCAT(`clients`.`lastname`,' ',`clients`.`firstname`) AS 'clientName'
            FROM `rents` 
            INNER JOIN `vehicles` 
            ON `rents`.`id_vehicle` = `vehicles`.`id_vehicle`
            INNER JOIN `clients` 
            ON `rents`.`id_client` = `clients`.`id_client` ";
        $sth = $this->db->query($sql);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOne($id): array
    {
        $sql = "SELECT `rents`.*, `clients`.`email`, CONCAT(`vehicles`.`brand`,' ', `vehicles`.`model`) AS 'vehicleName', CONCAT(`clients`.`lastname`,' ',`clients`.`firstname`) AS 'clientName'
            FROM `rents` 
            INNER JOIN `vehicles` 
            ON `rents`.`id_vehicle` = `vehicles`.`id_vehicle`
            INNER JOIN `clients` 
            ON `rents`.`id_client` = `clients`.`id_client`
            WHERE `rents`.`id_rent` = :id_rent";
        $sth = $this->db->prepare($sql);
        $sth->bindValue(':id_rent', $id, PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    public function getRentsWithPreciseStatus(string $status)
    {
        $sql = "SELECT `rents`.*, `vehicles`.`registration`, CONCAT(`vehicles`.`brand`,' ', `vehicles`.`model`) AS 'vehicleName', CONCAT(`clients`.`lastname`,' ',`clients`.`firstname`) AS 'clientName'
        FROM `rents` 
        INNER JOIN `vehicles` 
        ON `rents`.`id_vehicle` = `vehicles`.`id_vehicle`
        INNER JOIN `clients` 
        ON `rents`.`id_client` = `clients`.`id_client` 
        WHERE `status` = :status;";
        $sth = $this->db->prepare($sql);
        $sth->bindValue(':status', $status);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    // Statictics home page dashboard // SI IL N'Y A PAS LA COLONNE 'STATUS'
    // public function getUpcomingRents(): int
    // {
    //     $sql = "SELECT count(`id_rent`) AS 'nbRents' FROM `rents` WHERE (`startdate` > CURRENT_TIMESTAMP) AND (`enddate` > CURRENT_TIMESTAMP);";
    //     $sth = $this->db->query($sql);
    //     $totalNumber = $sth->fetch();
    //     return $totalNumber->nbRents;
    // }

    // public function getCurrentRents(): int
    // {
    //     $sql = "SELECT count(`id_rent`) AS 'nbRents' FROM `rents` WHERE (`startdate` < CURRENT_TIMESTAMP) AND (`enddate` > CURRENT_TIMESTAMP);";
    //     $sth = $this->db->query($sql);
    //     $totalNumber = $sth->fetch();
    //     return $totalNumber->nbRents;
    // }

    public function getNonConfirmedRents(): int
    {
        $sql = "SELECT count(`id_rent`) AS 'nbRents' FROM `rents` WHERE `confirmed_at` IS NULL;";
        $sth = $this->db->query($sql);
        $totalNumber = $sth->fetch();
        return $totalNumber->nbRents;
    }

    public function setConfirmDate($id): bool
    {
        $sql = "UPDATE `rents` SET `confirmed_at` = :confirmed_at WHERE `id_rent` = :id_rent;";
        $sth = $this->db->prepare($sql);
        $sth->bindValue(':confirmed_at', $this->getConfirmed_at()->format('Y-m-d H:i:s'));
        $sth->bindValue(':id_rent', $id, PDO::PARAM_INT);
        return $sth->execute();
    }
}
