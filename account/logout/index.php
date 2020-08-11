<?php
session_start();
$_SESSION = array();
session_destroy();
header("location: https://www.pedicurepraktijkpapendrecht.nl/webshop/account/login/");
exit;
