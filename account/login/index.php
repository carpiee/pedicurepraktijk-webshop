<?php
session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: https://www.pedicurepraktijkpapendrecht.nl/webshop");
    exit;
}
require_once '../../config/init.php';

$username = $password = "";
$username_err = $password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["username"]))) {
        $username_err = "Vul uw naam in.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Vul uw wachtwoord in.";
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty($username_err) && empty($password_err)) {
        $users = new Login();
        $CheckUsername = $users->GetUserData($username);
        if ($CheckUsername) {
            $id = $CheckUsername->id;
            $email = $CheckUsername->email;
            $username = $CheckUsername->username;
            $hashed_password = $CheckUsername->password;
            if (password_verify($password, $hashed_password)) {
                $admins = array('admin', 'Marian Gonlag');
                session_start();
                $_SESSION["loggedin"] = true;
                $_SESSION["email"] = $email;
                $_SESSION["id"] = $id;
                $_SESSION["username"] = $username;

                if (in_array($_SESSION["username"], $admins)) {
                    header("location: https://www.pedicurepraktijkpapendrecht.nl/webshop/admin/");
                } else {
                    header("location: https://www.pedicurepraktijkpapendrecht.nl/webshop/account/login");
                }
            } else {
                $password_err = "Het wachtwoord dat u heeft ingevuld hoort niet bij u account.";
            }
        } else {
            // Display an error message if username doesn't exist
            $username_err = "Geen account gevonden met u naam.";
        }
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }
}
include_once '../templates/login.php';
