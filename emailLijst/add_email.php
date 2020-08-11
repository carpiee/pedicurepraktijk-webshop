<?php

require_once '../config/init.php';

    $email_list = new Email_list();
    $emailcheck = $email_list->CheckExistEmail($_GET['email']);

    if(!($emailcheck)){
        $add_email = $email_list->AddEmailToList($_GET['email']);
        echo json_encode('U email adress is toegevoegd!');
    }else{
        echo json_encode('Uw email adress bestond al in ons klantenbestand!');
    }

?>
