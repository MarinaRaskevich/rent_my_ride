<?php
require_once __DIR__ . '/../helpers/BaseModel.php';

class Client extends BaseModel
{
    private int $id_client;
    private string $lastname;
    private string $firstname;
    private string $email;
    private DateTime $birthday;
    private string $phone;
    private string $city;
    private string $zipcode;
    private DateTime $created_at;
    private DateTime $updated_at;

    public function __construct(string $lastname = '', string $firstname = '', string $email = '', string $phone = '', string $city = '', string $zipcode = '')
    {
        $this->lastname = $lastname;
        $this->firstname = $firstname;
        $this->email = $email;
        $this->phone = $phone;
        $this->city = $city;
        $this->zipcode = $zipcode;
        parent::__construct();
    }

    //Setters
    public function setId_client(int $id_client): void
    {
        $this->id_client = $id_client;
    }

    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setBirthday(string $birthday): void
    {
        $this->birthday = new DateTime($birthday);
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function setZipcode(string $zipcode): void
    {
        $this->zipcode = $zipcode;
    }


    public function setCreated_at(string $created_at)
    {
        $this->created_at = new DateTime($created_at);
    }

    public function setUpdated_at(string $updated_at)
    {
        $this->updated_at = new DateTime($updated_at);
    }

    //Getters
    public function getId_client(): int
    {
        return $this->id_client;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getBirthday(): Datetime
    {
        return $this->birthday;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getZipcode(): string
    {
        return $this->zipcode;
    }

    public function getCreated_at(): DateTime
    {
        return $this->created_at;
    }

    public function getUpdated_at(): DateTime
    {
        return $this->updated_at;
    }

    public function insert(): bool
    {
        $sql = 'INSERT INTO `clients` 
                    (`lastname`, `firstname`, `email`, `birthday`, `phone`, `city`, `zipcode`) 
                VALUES
                    (:lastname, :firstname, :email, :birthday, :phone, :city, :zipcode);';
        $sth = $this->db->prepare($sql);

        $sth->bindValue(':lastname', $this->getLastname());
        $sth->bindValue(':firstname', $this->getFirstname());
        $sth->bindValue(':email', $this->getEmail());
        $sth->bindValue(':birthday', $this->getBirthday()->format('Y-m-d H:i:s'));
        $sth->bindValue(':phone', $this->getPhone());
        $sth->bindValue(':city', $this->getCity());
        $sth->bindValue(':zipcode', $this->getZipcode());
        return $sth->execute();
        // return $this->db->lastInsertId();
    }

    public function getLastInsertId(): int
    {
        return $this->db->lastInsertId();
    }

    // Statictics home page dashboard
    public function getTotal(): int
    {
        $sql = "SELECT count(`id_client`) AS 'nbClients' FROM `clients`;";
        $sth = $this->db->query($sql);
        $totalNumber = $sth->fetch();
        return $totalNumber->nbClients;
    }
}
