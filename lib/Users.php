<?php

class Users
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }


    public function GetUserLoggedInInfo($username)
    {
        $this->db->query("SELECT username, email, nmr, postcode, huisnummer, straatnaam, plaatsnaam FROM users WHERE username = :username");
        $this->db->bind(':username', $username, PDO::PARAM_STR);
        $results = $this->db->single();
        return $results;
    }

    public function CreateUser($username, $nmr, $postcode, $huisnummer, $straatnaam, $plaatsnaam, $email, $hassedPassword)
    {
        $this->db->query("INSERT INTO users (username,nmr,postcode,huisnummer,straatnaam,plaatsnaam,email,password) VALUES (:username,:nmr,:postcode,:huisnummer,:straatnaam,:plaatsnaam,:email,:password)");
        $this->db->bind(":username", $username, PDO::PARAM_STR);
        $this->db->bind(":nmr", $nmr, PDO::PARAM_STR);
        $this->db->bind(":postcode", $postcode, PDO::PARAM_STR);
        $this->db->bind(":huisnummer", $huisnummer, PDO::PARAM_STR);
        $this->db->bind(":straatnaam", $straatnaam, PDO::PARAM_STR);
        $this->db->bind(":plaatsnaam", $plaatsnaam, PDO::PARAM_STR);
        $this->db->bind(":email", $email, PDO::PARAM_STR);
        $this->db->bind(':password', $hassedPassword, PDO::PARAM_STR);
        $this->db->execute();
    }

    public function UpdateInfo($nmr, $straatnaam, $huisnummer, $postcode, $plaatsnaam)
    {
        $this->db->query("UPDATE users SET nmr = :nmr, straatnaam = :straatnaam, huisnummer = :huisnummer, postcode = :postcode, plaatsnaam = :plaatsnaam WHERE id = :id");
        $this->db->bind(':nmr', $nmr, PDO::PARAM_INT);
        $this->db->bind(':straatnaam', $straatnaam, PDO::PARAM_STR);
        $this->db->bind(':huisnummer', $huisnummer, PDO::PARAM_INT);
        $this->db->bind(':postcode', $postcode, PDO::PARAM_STR);
        $this->db->bind(':plaatsnaam', $plaatsnaam, PDO::PARAM_STR);
        $this->db->bind(':id', $_SESSION['id'], PDO::PARAM_INT);
        $this->db->execute();
    }

    public function UpdateEmail($email)
    {
        $this->db->query("UPDATE users SET email = :email WHERE id = :id");
        $this->db->bind(':email', $email, PDO::PARAM_STR);
        $this->db->bind(':id', $_SESSION['id'], PDO::PARAM_INT);
        $this->db->execute();
    }

    public function UpdatePassword($newpassword, $repeatnewpassword)
    {
        $hassedPassword = password_hash($newpassword, PASSWORD_DEFAULT);
        $this->db->query("UPDATE users SET password = :password WHERE id = :id");
        $this->db->bind(':password', $hassedPassword, PDO::PARAM_STR);
        $this->db->bind(':id', $_SESSION['id'], PDO::PARAM_INT);
        $this->db->execute();
    }
}
