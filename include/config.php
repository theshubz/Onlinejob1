<?php
defined('SERVER') ? null : define("SERVER", "opportunityjunction.azurewebsites.net");
defined('USER') ? null : define("USER", "shubhamj");
defined('PASS') ? null : define("PASS", "omkar@29");
defined('DATABASE_NAME') ? null : define("DATABASE_NAME", "erisdb");

$this_file = str_replace('\\', '/', __FILE__);
$doc_root = $_SERVER['DOCUMENT_ROOT'];

$web_root = str_replace(array($doc_root, "include/config.php"), '', $this_file);
$server_root = str_replace('config/config.php', '', $this_file);

define('WEB_ROOT', $web_root);
define('SERVER_ROOT', $server_root);
require_once('include/config.php');

// Example usage of constants
echo "Server: " . SERVER . "<br>";
echo "User: " . USER . "<br>";
echo "Database Name: " . DATABASE_NAME . "<br>";
echo "Web Root: " . WEB_ROOT . "<br>";
echo "Server Root: " . SERVER_ROOT . "<br>";
?>
