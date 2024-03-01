<?php


defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

defined('SITE_ROOT') ? null : define ('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'].DS.'Onlinejob');

defined('LIB_PATH') ? null : define ('LIB_PATH',SITE_ROOT.DS.'include');


require_once("config.php");
require_once("function.php");
require_once("session.php");
require_once("accounts.php");
require_once("autonumbers.php");  
require_once("companies.php");  
require_once("job.php");  
require_once("employees.php");  
require_once("categories.php");  
require_once("applicant.php");  
require_once("jobregistration.php");  
  

require_once("database.php");
?>