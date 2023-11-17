<?php
//This is the Main controller

//Create or access a Session
session_start();

//Get the database connection file
require_once 'library/connections.php';
//Get the PHP Motors model for use as needed
require_once 'model/main-model.php';
//Get common functions
require_once 'library/functions.php';


//Get the array of classifications
$classifications = getClassifications();

//var_dump($classifications);
   //exit;

//Get a dynamic navigation list
$navList = buildNavigation($classifications);

//if(isset($_COOKIE['firstname'])){
//    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//}

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
}

switch($action){
    case 'tamplate':
        include 'view/template.php';
        break;

    default:
        include 'view/home.php';
        break;
}
?>