<?php

// Define directory separator if not defined
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

// Define SITE_ROOT if not defined
defined('SITE_ROOT') ? null : define ('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'].DS.'Onlinejob');

// Define LIB_PATH if not defined
defined('LIB_PATH') ? null : define ('LIB_PATH',SITE_ROOT.DS.'include');

// Include necessary files
$required_files = [
    "config.php",
    "function.php",
    "session.php",
    "accounts.php",
    "autonumbers.php",
    "companies.php",
    "job.php",
    "employees.php",
    "categories.php",
    "applicant.php",
    "jobregistration.php",
    "database.php"
];

foreach ($required_files as $file) {
    $file_path = LIB_PATH . DS . $file;
    if (file_exists($file_path) && is_readable($file_path)) {
        require_once($file_path);
    } else {
        // Handle error if file doesn't exist or not readable
        die("Error: Required file $file not found or not readable.");
    }
}
?>
