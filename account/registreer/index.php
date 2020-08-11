<?php
// Include config file
require_once '../../config/init.php';
$users = new Users();
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        // Prepare a select statement

        if ($users->GetUserLoggedInInfo($_POST["username"])) {
            $username_err = "This username is already taken.";
        } else {
            $username = trim($_POST["username"]);
        }
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 4) {
        $password_err = "Password must have atleast 4 characters.";
    }
    else {
        $password = trim($_POST["password"]);
    }

    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    if (empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)) {
        $param_username = $username;
        $param_nmr = $_POST['nmr'];
        $param_postcode = $_POST['postcode'];
        $param_huisnummer = $_POST['huisnummer'];
        $param_straatnaam = $_POST['straatnaam'];
        $param_plaatsnaam = $_POST['plaatsnaam'];
        $param_email = $_POST['email'];
        $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
        $users->CreateUser($param_username, $param_nmr, $param_postcode, $param_huisnummer, $param_straatnaam, $param_plaatsnaam, $param_email, $param_password);
        if ($users->GetUserLoggedInInfo($param_username)) {
            header("location: https://www.pedicurepraktijkpapendrecht.nl/webshop/account/login/");
        } else {
            echo "Something went wrong. Please try again later.";
        }
    }
}
include_once '../templates/registreer.php';
