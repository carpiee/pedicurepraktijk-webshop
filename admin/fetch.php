<?php
require_once '../config/init.php';
$cms = new Cms();
$user = new Users();
$producten = new Producten();
$bestellingen = new Bestellingen();
if (isset($_POST['employee_id'])) {
    echo json_encode($cms->GetPerProductInfoById($_POST['employee_id']));
}


if (isset($_POST['id']) && ($_POST['datum'])) {
    $cms->EditDate($_POST['id'], $_POST['datum']);
}

if (isset($_POST['info_id']) && ($_POST['name'])) {
    $data = array();
    $data['bestel'] = $bestellingen->GetBestellingenById($_POST['info_id']);
    $data['user'] = $user->GetUserLoggedInInfo($_POST['name']);
    $data['product'] = $producten->GetPerProductInfoByName(explode('-', $_POST['info_id'])[1]);
    echo json_encode($data);
}

if (isset($_POST['id']) && ($_POST['verander'])) {
    $cms->EditBestelling($_POST['id'], $_POST['verander'], $_POST['datum']);
}
if (isset($_POST['delete_id'])) {
    $cms->DeleteProduct($_POST['delete_id']);
}

if (isset($_POST['header'])) {
    $cms->HandleReplaceContent($_POST['header']);
}
