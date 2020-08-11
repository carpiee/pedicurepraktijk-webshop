<?php
require_once '../config/init.php';
$cms = new Cms();

if(isset($_POST['bewerk_product_id'])){
    $cms->BewerkProduct($_POST['bewerk_product_id'],$_POST['prodname'], $_POST['disc'], $_POST['oudeprijs'], $_POST['nieuwprijs'], $_POST['min_voorraad'], $_POST['voorraad']);  
}
