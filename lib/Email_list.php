<?php

class Email_list{
    
    private $db;
    
    public function __construct(){
        $this->db = new Database();    
    }


    public function GetEmailList(){
        $this->db->query("SELECT email FROM email_list");
        $results = $this->db->zoeken();
        return $results;
    }
    public function CheckExistEmail($email){
            $this->db->query("SELECT * FROM email_list WHERE email = :email");
            $this->db->bind(':email', $email,PDO::PARAM_STR);
            $results = $this->db->zoeken();
            return $results;
    }
    public function AddEmailToList($email){
            $this->db->query("INSERT INTO email_list (email) VALUES (:email)");
            $this->db->bind(":email", $email,PDO::PARAM_STR);
            $this->db->execute();
    }
}


?>
