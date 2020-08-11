<?php

require_once '../config/init.php';

$email_list = new Email_list();
$emails = $email_list->GetEmailList();

if(isset($_POST["Export"])){
         
    header('Content-Type: text/csv; charset=utf-8');  
    header('Content-Disposition: attachment; filename=Email_Lijst_pedicurepraktijkpapendrecht.csv');  
    $output = fopen("php://output", "w");  
    fputcsv($output, array('email'));
    foreach($emails as $email) {
        fputcsv($output, $email); 
    }
             
      
    fclose($output);  
} 

?>
