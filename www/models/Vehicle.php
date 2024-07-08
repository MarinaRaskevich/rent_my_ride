<?php

class Vehicle extends BaseModel
{
    private int $id_vehicle;
    private string $brand;
    private string $model;
    private string $registration;
    private int $mileage;
    private string $picture;
    private int $price;
    private string $created_at;
    private string $updated_at;
    private string $deleted_at;
    private int $id_category;

    public function __construct(string $brand = '', string $model = '', string $registration = '', int $mileage = 0, string $picture = '', int $price = 0)
    {
        $this->brand = $brand;
        $this->model = $model;
        $this->registration = $registration;
        $this->mileage = $mileage;
        // $this->id_category = $id_category;
        $this->picture = $picture;
        $this->price = $price;
        parent::__construct();
    }

    //Setters
    public function setId_vehicle(int $id_vehicle): void
    {
        $this->id_vehicle = $id_vehicle;
    }

    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }

    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    public function setRegistration(string $registration): void
    {
        $this->registration = $registration;
    }

    public function setMileage(string $mileage): void
    {
        $this->mileage = $mileage;
    }

    public function setPicture(string $picture): void
    {
        $this->picture = $picture;
    }

    public function setPrice(string $price): void
    {
        $this->price = $price;
    }

    public function setCreated_at(string $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function setUpdated_at(string $updated_at): void
    {
        $this->updated_at = $updated_at;
    }

    public function setDeleted_at(string $deleted_at): void
    {
        $this->deleted_at = $deleted_at;
    }

    public function setId_category(int $id_category): void
    {
        $this->id_category = $id_category;
    }

    //Getters

    public function getId_vehicle(): int
    {
        return $this->id_vehicle;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function getRegistration(): string
    {
        return $this->registration;
    }

    public function getMileage(): int
    {
        return $this->mileage;
    }

    public function getPicture(): string
    {
        return $this->picture;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getCreated_at(): string
    {
        return $this->created_at;
    }

    public function getUpdated_at(): string
    {
        return $this->updated_at;
    }

    public function getDeleted_at(): string
    {
        return $this->deleted_at;
    }

    public function getId_category(): int
    {
        return $this->id_category;
    }

    // Ajouter une véhicule en base de données 
    public function insert()
    {
        $sql = 'INSERT INTO `vehicles`(`brand`, `model`, `registration`, `mileage`,  `picture`, `price`, `created_at`, `id_category`) VALUES (:brand, :model, :registration, :mileage, :picture, :price :created_at, :id_category);';
        $sth = $this->db->prepare($sql);
        $sth->bindValue(':brand', $this->getBrand(), PDO::PARAM_STR);
        $sth->bindValue(':model', $this->getModel(), PDO::PARAM_STR);
        $sth->bindValue(':registration', $this->getRegistration(), PDO::PARAM_STR);
        $sth->bindValue(':mileage', $this->getMileage(), PDO::PARAM_INT);
        $sth->bindValue(':picture', $this->getPicture(), PDO::PARAM_STR);
        $sth->bindValue(':price', $this->getPrice(), PDO::PARAM_STR);
        $sth->bindValue(':created_at', $this->getCreated_at(), PDO::PARAM_STR);
        $sth->bindValue(':id_category', $this->getId_category(), PDO::PARAM_INT);
        $sthExecute = $sth->execute();
        return $sthExecute;
    }

    //Modifier
    public function update(): bool
    {
        $sql = 'UPDATE `vehicles` 
            SET `brand` = :brand, `model` = :model, `registration` = :registration, `mileage` = :mileage, `picture` = :picture, `updated_at` = NOW()
            WHERE `id_vehicle` = :id_vehicle;';
        $sth = $this->db->prepare($sql);
        $sth->bindValue(':brand', $this->getBrand(), PDO::PARAM_STR);
        $sth->bindValue(':model', $this->getModel(), PDO::PARAM_STR);
        $sth->bindValue(':registration', $this->getRegistration(), PDO::PARAM_STR);
        $sth->bindValue(':mileage', $this->getMileage(), PDO::PARAM_INT);
        $sth->bindValue(':picture', $this->getPicture(), PDO::PARAM_STR);
        $sth->bindValue(':id_vehicle', $this->getId_vehicle(), PDO::PARAM_INT);
        $sth->execute();
        if ($sth->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Supprimer 
    public function delete($id): bool
    {
        $sql = 'UPDATE `vehicles` SET `deleted_at` = NOW() WHERE `id_vehicle` = :id_vehicle;';
        $sth = $this->db->prepare($sql);
        $sth->bindValue(':id_vehicle', $id);
        $sth->execute();
        if ($sth->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Récupère une liste de véhicules avec des options pour filtrer, trier et paginer.
     *
     * @param int|null $id L'ID de la catégorie. Si null ou '0', récupère toutes les catégories.
     * @param int|null $first L'index du premier élément pour la pagination. Si null, non utilisé.
     * @param int|null $last Le nombre d'éléments pour la pagination. Si null, non utilisé.
     * @param string|null $column Le nom de la colonne pour trier. Si null, non utilisé.
     * @param string|null $order L'ordre de tri ('ASC' ou 'DESC'). Si null, non utilisé.
     * @return array Un tableau associatif de véhicules avec leurs catégories.
     */

    public function getAll($id = null, $first = null, $last = null, $column = null, $orderParam = null)
    {
        if ($column == 'name') {
            $table = 'categories';
        } else {
            $table = 'vehicles';
        }

        $sql = "SELECT `vehicles`.*, `categories`.`name` AS `categoryName`
            FROM `vehicles`
            INNER JOIN `categories` ON `vehicles`.`id_category` = `categories`.`id_category`";
        $condition = ($id == 0 || $id == null) ? ' WHERE `vehicles`.`deleted_at` IS NULL' : ' WHERE `categories`.`id_category` = :id_category AND `vehicles`.`deleted_at` IS NULL';
        $limit =  ($first !== null && $last !== null) ? ' LIMIT :first, :last' : '';
        $order = ($column !== null && $orderParam !== null) ? " ORDER BY `$table`.`$column` $orderParam;" : '';

        $sth = $this->db->prepare($sql . $condition . $limit . $order);

        if ($id != 0 && $id != null) {
            $sth->bindValue(':id_category', $id, PDO::PARAM_INT);
        }

        if ($first !== null && $last !== null) {
            $sth->bindValue(':first', $first, PDO::PARAM_INT);
            $sth->bindValue(':last', $last, PDO::PARAM_INT);
        }

        $sth->execute();
        $vehiclesList = $sth->fetchAll();
        return $vehiclesList;
    }


    public function getOne($id)
    {
        $sql = 'SELECT * FROM `vehicles` INNER JOIN `categories` ON `vehicles`.`id_category` = `categories`.`id_category` WHERE `id_vehicle` = :id_vehicle;';
        $sth = $this->db->prepare($sql);
        $sth->bindValue(':id_vehicle', $id, PDO::PARAM_INT);
        $sth->execute();
        $oneVehicle = $sth->fetch();
        return $oneVehicle;
    }

    //Suppression totale
    public function totalDelete($id)
    {
        $sql = 'DELETE FROM `vehicles` WHERE `id_vehicle` = :id_vehicle;';
        $sth = $this->db->prepare($sql);
        $sth->bindValue(':id_vehicle', $id);
        $sth->execute();
        if ($sth->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    ///Pagination
    public function getTotalNumber()
    {
        $sql = 'SELECT count(`id_vehicle`) AS `totalNumber` FROM `vehicles`';
        $sth = $this->db->query($sql);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        return $result['totalNumber'];
    }

    public function getMatchForSearch($query): array
    {
        $sql = "SELECT `id_vehicle`, `brand`, `model`
            FROM `vehicles` 
            WHERE `brand` LIKE :query
            OR `model` LIKE :query;";
        $sth = $this->db->prepare($sql);
        $sth->bindValue(':query', '%' . $query . '%');
        $sth->execute();
        $vehiclesList = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $vehiclesList;
    }

    public function getBrandModel($id_category): array
    {
        $sql = "SELECT `brand`, `model` AS `vehicleName` FROM `vehicles` WHERE `id_category` = :id_category;";
        $sth = $this->db->prepare($sql);
        $sth->bindValue(':id_category', $id_category);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    // public static function getPictureName($id)
    // {
    //     $pdo = dbConnect();
    //     $sql = 'SELECT `picture` FROM `vehicles` WHERE `id_vehicle` = :id_vehicle;';
    //     $sth = $pdo->prepare($sql);
    //     $sth->bindValue(':id_vehicle', $id);
    //     $sth->execute();
    //     $pictureName = $sth->fetch(PDO::FETCH_ASSOC);
    //     return $pictureName;
    // }

    // Statictics home page dashboard
    public function getTotal(): int
    {
        $sql = "SELECT count(`id_vehicle`) AS 'nbVehicles' FROM `vehicles`;";
        $sth = $this->db->query($sql);
        $totalNumber = $sth->fetch();
        return $totalNumber->nbVehicles;
    }
}
