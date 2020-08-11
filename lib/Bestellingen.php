<?php

class Bestellingen
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }


    public function CheckIfBestellingenExist()
    {
        $this->db->query("SELECT * FROM cadeau WHERE klant_name = :username ");
        $this->db->bind(":username", $_SESSION['username'], PDO::PARAM_STR);
        $results = $this->db->zoeken();
        return $results;
    }

    public function RenderBestellingen()
    {
        $this->db->query("SELECT * FROM cadeau WHERE klant_name = :username ORDER BY id DESC");
        $this->db->bind(":username", $_SESSION['username'], PDO::PARAM_STR);
        $results = $this->db->resultSet();
        return $results;
    }

    public function CheckIfBestellingenExistById($sessionId)
    {
        $this->db->query('SELECT * FROM cadeau WHERE `session_id` = :sessionid');
        $this->db->bind(":sessionId", $sessionId);
        return $this->db->single();
    }

    public function GetBestellingenByIdAndName($sessionId, $bon)
    {
        $this->db->query('SELECT aankoop_id FROM cadeau WHERE `session_id` = :sessionId and bon = :bon ');
        $this->db->bind(":sessionId", $sessionId);
        $this->db->bind(":bon", $bon);
        return $this->db->single();
    }

    public function GetBestellingenForDownloadByIdAndName($sessionId, $bon)
    {
        $this->db->query('SELECT * FROM cadeau WHERE `aankoop_id` = :sessionId and bon = :bon');
        $this->db->bind(":sessionId", $sessionId);
        $this->db->bind(":bon", $bon);
        return $this->db->single();
    }


    public function GetBestellingenById($id)
    {
        $this->db->query('SELECT * FROM cadeau WHERE `id` = :id');
        $this->db->bind(":id", $id);
        return $this->db->single();
    }



    public function MakeBestelling($aankoopId, $customer, $gebruikt, $bon, $sessionId, $factuurId)
    {
        $this->db->query('INSERT INTO `cadeau` (`aankoop_id`, `klant_name`, `gebruikt`, `bon`, `session_id`,`factuur_id`) VALUES (`:aankoopId`,`:klant_name`,`:gebruikt`,`bon`,`:session_id`,`:factuur_id`)');
        $this->db->bind(":aankoopId", $aankoopId);
        $this->db->bind(":klant_name", $customer);
        $this->db->bind(":gebruikt", $gebruikt);
        $this->db->bind(":sessionId", $sessionId);
        $this->db->bind(":factuurId", $factuurId);
        $this->db->execute();
    }
}
