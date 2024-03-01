<?php 
// Define directory separator if not defined
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

// Define SITE_ROOT if not defined
defined('SITE_ROOT') ? null : define ('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'].DS.'Onlinejob');

// Define LIB_PATH if not defined
defined('LIB_PATH') ? null : define ('LIB_PATH', SITE_ROOT.DS.'include');

// Initialize content as 'home.php' by default
$content = 'home.php';

// Determine the view based on the 'q' parameter in the URL
$view = isset($_GET['q']) ? $_GET['q'] : '';

// Define title and content based on the view
switch ($view) { 
    case 'apply':
        $title = "Submit Application";
        $content = 'applicationform.php';        
        break;
    case 'login':
        $title = "Login";
        $content = 'login.php';        
        break;
    case 'company':
        $title = "Company";
        $content = 'company.php';        
        break;
    case 'hiring':
        $title = isset($_GET['search']) ? 'Hiring in '.$_GET['search'] : "Hiring";
        $content = 'hirring.php';        
        break;        
    case 'category':
        $title = 'Search for '. $_GET['search'];
        $content = 'category.php';        
        break;
    case 'viewjob':
        $title = "Job Details";
        $content = 'viewjob.php';        
        break;
    case 'success':
        $title = "Success";
        $content = 'success.php';        
        break;
    case 'register':
        $title = "Register New Member";
        $content = 'register.php';        
        break;
    case 'Contact':
        $title = 'Contact Us';
        $content = 'Contact.php';        
        break;    
    case 'About':
        $title = 'About Us';
        $content = 'About.php';        
        break;    
    case 'advancesearch':
        $title = 'Advance Search';
        $content = 'advancesearch.php';        
        break;    
    case 'result':
        $title = 'Advance Search';
        $content = 'advancesearchresult.php';        
        break;
    case 'search-company':
        $title = 'Search by Company';
        $content = 'searchbycompany.php';        
        break;    
    case 'search-function':
        $title = 'Search by Function';
        $content = 'searchbyfunction.php';        
        break;    
    case 'search-jobtitle':
        $title = 'Search by Job Title';
        $content = 'searchbytitle.php';        
        break;                        
    default:
        $active_home = 'active';
        $title = "Home";
        $content = 'home.php';        
} 

// Include the templates file to display the content
require_once(__DIR__ . "/theme/templates.php");

?>
