<?php


class Factuur
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function GetFactuurInfo($factuur_id)
    {
        $this->db->query("SELECT * FROM cadeau WHERE factuur_id = :factuur_id");
        $this->db->bind(":factuur_id", $factuur_id, PDO::PARAM_INT);
        $result = $this->db->single();
        return $result;
    }

    public function CountPerProduct($product)
    {
        $this->db->query("SELECT aankoop_id FROM cadeau WHERE factuur_id = :factuur and bon = :product");
        $this->db->bind(":factuur", $_GET['factuur'], PDO::PARAM_INT);
        $this->db->bind(":product", $product, PDO::PARAM_STR);
        $result = $this->db->resultSet();
        return $result;
    }


    public function GetAllFactuurData($factuur_id)
    {
        $this->db->query("SELECT * FROM cadeau WHERE factuur_id = :factuur_id");
        $this->db->bind(":factuur_id", $factuur_id, PDO::PARAM_INT);
        $result = $this->db->resultSet();
        return $result;
    }

    public function SelectLastFactuurNummer()
    {
        $this->db->query('SELECT * FROM factuur');
        return $this->db->single();
    }
    public function UpdateNewFactuurNummer($new, $old)
    {
        $this->db->query('UPDATE factuur SET nr = :nr WHERE nr = :oldnr');
        $this->db->bind(":nr", $new);
        $this->db->bind(":oldnr", $old);
        $this->db->execute();
    }
}
