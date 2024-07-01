<?php
require_once __DIR__ . '/../helpers/BaseModel.php';

class Category extends BaseModel
{
    private int $id_category;
    private ?string $name;

    //Construct/ Setter/ Getter
    public function __construct(?string $name = null)
    {
        parent::__construct();
        $this->name = $name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setId_category(int $id_category): void
    {
        $this->id_category = $id_category;
    }

    public function getId_category(): int
    {
        return $this->id_category;
    }


    // Ajouter une catégorie en base de données 
    public function insert(): bool
    {
        $sql = 'INSERT INTO `categories`(`name`) VALUES (:name);';
        $sth = $this->db->prepare($sql);
        $sth->bindValue(':name', $this->getName(), PDO::PARAM_STR);
        return $sth->execute();
    }

    //Retourner toutes les données de la base
    public function getAll(): array
    {
        $sql = 'SELECT * FROM `categories`';
        $sth = $this->db->query($sql);
        $categoriesList = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $categoriesList;
    }

    //Retourner une catégorie
    public function getOne($id): mixed
    {
        $sql = 'SELECT * FROM `categories` WHERE `id_category` = :id_category;';
        $sth = $this->db->prepare($sql);
        $sth->bindValue(':id_category', $id, PDO::PARAM_INT);
        $sth->execute();
        $oneCategory = $sth->fetch();
        return $oneCategory;
    }

    //Modifier la catégorie
    public function update(): bool
    {
        $sql = 'UPDATE `categories` SET `name` = :name WHERE `id_category` = :id_category;';
        $sth = $this->db->prepare($sql);
        $sth->bindValue(':name', $this->getName(), PDO::PARAM_STR);
        $sth->bindValue(':id_category', $this->getId_category(), PDO::PARAM_INT);
        $sthExecute = $sth->execute();
        return $sthExecute;
    }

    // Vérifiсation si le nom de catégorie saisi existe déjà dans la base de données
    public function isExist($column, $property): bool
    {
        if ($column === 'name') {
            $sql = 'SELECT count(*) FROM `categories` WHERE `name` = :property;';
        }

        if ($column === 'id') {
            $sql = 'SELECT count(*) FROM `categories` WHERE `id_category` = :property;';
        }

        $sth = $this->db->prepare($sql);
        $sth->bindValue(':property', $property, PDO::PARAM_STR);
        $sth->execute();
        if ($sth->fetchColumn() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Supprimer une catégorie
    public function delete($id): bool
    {
        $sql = 'DELETE FROM `categories` WHERE `id_category` = :id_category;';
        $sth = $this->db->prepare($sql);
        $sth->bindValue(':id_category', $id, PDO::PARAM_INT);
        $sthExecute = $sth->execute();
        if ($sth->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
        return $sthExecute;
    }

    // Statictics home page dashboard
    public function getTotal(): int
    {
        $sql = "SELECT count(`id_category`) AS 'nbCategories' FROM `categories`;";
        $sth = $this->db->query($sql);
        $totalNumber = $sth->fetch();
        return $totalNumber->nbCategories;
    }
}
