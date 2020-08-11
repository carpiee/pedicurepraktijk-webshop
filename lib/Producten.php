<?php

class Producten
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
    public function GetPerProductInfoByName($name)
    {
        $this->db->query("SELECT * FROM producten WHERE product_naam = :product_naam");
        $this->db->bind(':product_naam', $name, PDO::PARAM_STR);
        $results = $this->db->single();
        return $results;
    }
    public function GetPerProductInfo($name)
    {
        $this->db->query("SELECT * FROM producten WHERE product_naamdis = :product_naamdis");
        $this->db->bind(':product_naamdis', $name, PDO::PARAM_STR);
        $results = $this->db->single();
        return $results;
    }

    public function GetPerProductInfoById($id)
    {
        $this->db->query("SELECT * FROM producten WHERE id = :id");
        $this->db->bind(':id', $id, PDO::PARAM_INT);
        $results = $this->db->single();
        return $results;
    }

    public function GetAllProducten()
    {
        $this->db->query("SELECT * FROM producten ORDER BY cat DESC");
        $results = $this->db->resultSet();
        return $results;
    }

    public function GetRandomProducten()
    {
        $this->db->query("SELECT * FROM producten WHERE voorraad > 1 ORDER BY RAND() LIMIT 4");
        $results = $this->db->resultSet();
        return $results;
    }

    public function zoekProducten($zoeknaam)
    {
        $this->db->query("SELECT * FROM producten WHERE product_naamdis LIKE :zoeknaam OR cat LIKE :zoeknaam ORDER BY product_naamdis");
        $this->db->bind(":zoeknaam", "%" . $zoeknaam . "%", PDO::PARAM_STR);
        $results = $this->db->resultSet();
        return $results;
    }

    public function GetVoorraaad($name)
    {
        $this->db->query("SELECT voorraad FROM producten WHERE product_naam = :product_name");
        $this->db->bind(":product_name", $name);
        return $this->db->single();
    }

    public function UpdateVoorraaad($name, $voorraad)
    {
        $this->db->query("UPDATE cadeau SET voorraad = :voorraad WHERE product_name = :product_name");
        $this->db->bind(":product_name", $name);
        $this->db->bind(":voorraad", $voorraad);
        return $this->db->single();
    }
}
