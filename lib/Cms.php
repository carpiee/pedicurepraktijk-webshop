<?php

class Cms
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function GetUserData($username)
    {
        $this->db->query("SELECT id, username, email, nmr, postcode, huisnummer, straatnaam, plaatsnaam FROM users WHERE username = :username");
        $this->db->bind(":username", $username);
        return $this->db->single();
    }

    public function GetProductInfoByName($name)
    {
        $this->db->query("SELECT * FROM producten WHERE product_naam = :name");
        $this->db->bind(":name", $name);
        return $this->db->single();
    }
    public function GetAllUsers()
    {
        $this->db->query("SELECT id, username, email, nmr, postcode, huisnummer, straatnaam, plaatsnaam FROM users");
        return $this->db->resultSet();
    }

    public function GetProductenByCustomer($username)
    {
        $this->db->query("SELECT * FROM cadeau WHERE klant_name = :username");
        $this->db->bind(":username", $username);
        return $this->db->resultSet();
    }

    public function EditDate($id, $datum)
    {
        $this->db->query("UPDATE cadeau SET updated_at = :datum WHERE id = :id");
        $this->db->bind(":datum", $datum, PDO::PARAM_STR);
        $this->db->bind(":id", $id, PDO::PARAM_INT);
        $this->db->execute();
    }
    public function EditBestelling($id, $gebruikt)
    {
        $this->db->query("UPDATE cadeau SET gebruikt = :gebruikt WHERE id = :id");
        $this->db->bind(":gebruikt", $gebruikt, PDO::PARAM_STR);
        $this->db->bind(":id", $id, PDO::PARAM_INT);
        $this->db->execute();
    }

    public function GetPerProductInfoById($id)
    {
        $this->db->query("SELECT * FROM producten WHERE id = :id");
        $this->db->bind(':id', $id, PDO::PARAM_INT);
        $results = $this->db->jsonOutput();
        return $results;
    }

    public function BewerkProduct($product_id, $prodnaam, $disc, $oude_prijs, $nieuwe_prijs, $min_voorraad, $voorraad)
    {
        $this->db->query("UPDATE producten SET product_naamdis = :naamdis, product_disc = :disc, product_oudeprijs = :oudeprijs, product_nieuwprijs = :nieuwprijs, min_voorraad = :minvoorraad, voorraad = :voorraad WHERE id = :prodid");
        $this->db->bind(":naamdis", $prodnaam, PDO::PARAM_STR);
        $this->db->bind(":disc", $disc, PDO::PARAM_STR);
        $this->db->bind(":oudeprijs", $oude_prijs, PDO::PARAM_STR);
        $this->db->bind(":nieuwprijs", $nieuwe_prijs, PDO::PARAM_STR);
        $this->db->bind(":minvoorraad", $min_voorraad, PDO::PARAM_STR);
        $this->db->bind(":voorraad", $voorraad, PDO::PARAM_STR);
        $this->db->bind(":prodid", $product_id, PDO::PARAM_INT);
        $this->db->execute();
    }

    public function DeleteProduct($id)
    {
        $this->db->query("DELETE FROM producten WHERE id = :id");
        $this->db->bind(":id", $id, PDO::PARAM_INT);
        $this->db->execute();
    }

    public function RenderBestellingen()
    {
        $this->db->query("SELECT * FROM cadeau ORDER BY id DESC");
        $results = $this->db->resultSet();
        return $results;
    }

    public function GetUserDataForCorrectFactuur($username)
    {
        $this->db->query("SELECT username, email, nmr, postcode, huisnummer, straatnaam, plaatsnaam FROM users WHERE username = :username");
        $this->db->bind(':username', $username, PDO::PARAM_STR);
        $results = $this->db->single();
        return $results;
    }

    public function GekochtVandaag()
    {
        $this->db->query("SELECT * FROM cadeau WHERE datum = :vandaag");
        $this->db->bind(":vandaag", date("Y-m-d"));
        $result = $this->db->resultSet();
        return $result;
    }

    public function NogWegBrengen()
    {
        $this->db->query("SELECT * FROM cadeau WHERE aankoop_id = '' and gebruikt = 'nee'");
        $result = $this->db->resultSet();
        return $result;
    }

    public function GetAantalUsers()
    {
        $this->db->query("SELECT * FROM users");
        $result = $this->db->rowCount();
        return $result;
    }

    public function GetnewUsersToday()
    {
        $this->db->query("SELECT * FROM users WHERE created_at = :datum");
        $this->db->bind(":datum", date("Y-m-d"));
        $result = $this->db->rowCount();
        return $result;
    }

    public function GetAantalGekochtProducten()
    {
        $this->db->query("SELECT * FROM cadeau");
        $result = $this->db->rowCount();
        return $result;
    }

    public function GetVandaagAantalGekochtProducten()
    {
        $this->db->query("SELECT * FROM cadeau WHERE datum = :datum");
        $this->db->bind(":datum", date("Y-m-d"));
        $result = $this->db->rowCount();
        return $result;
    }

    public function GetContent()
    {
        $this->db->query("SELECT * FROM header");
        $result = $this->db->single();
        return $result;
    }
    public function HandleReplaceContent($context)
    {
        $this->db->query("UPDATE header SET context = :context WHERE id = '1'");
        $this->db->bind(":context", $context, PDO::PARAM_STR);
        $this->db->execute();
    }
}
