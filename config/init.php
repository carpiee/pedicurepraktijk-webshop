<?php
require_once 'config.php';

function __autoload($class_name){
    require_once dirname(__DIR__).'/lib/'.$class_name.'.php';
}
?>
