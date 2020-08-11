<?php

class Login{
    private $db;
    
    public function __construct(){
        $this->db = new Database();    
    }


    public function CheckExistUser($username){
        $this->db->query("SELECT username FROM users WHERE username = :username");
        $this->db->bind(':username', $username,PDO::PARAM_STR);
        $results = $this->db->resultSet();
        return $results;
    }
    public function GetUserData($username){
        $this->db->query("SELECT * FROM users WHERE username = :username");
        $this->db->bind(':username', $username, PDO::PARAM_STR);
        $results = $this->db->single();
        return $results;
    }
}


?>
