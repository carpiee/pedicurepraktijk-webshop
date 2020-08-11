<?php
ob_start();
if (!isset($_SESSION)) {
    session_start();
}
define('DB_HOST', 'localhost');
define('DB_USER', 'remco');
define('DB_PASS', 'aDxZ1$9#');
define('DB_NAME', 'klantenbestand');
