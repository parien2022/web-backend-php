<?php

/*This is the controller for the final search project*/


//Create or access a Session
session_start();

//Get the database connection file
require_once '../library/connections.php';
//Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
//Get Vehicles model
require_once '../model/search-model.php';
//Get common functions
require_once '../library/functions.php';


//Get the array of classifications
$classifications = getClassifications();

//Get a dynamic navigation list
$navList = buildNavigation($classifications);


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
}


switch($action){

    case 'search':

        $searchString = trim(filter_input(INPUT_POST, 'searchString', FILTER_SANITIZE_FULL_SPECIAL_CHARS)) ?: trim(filter_input(INPUT_GET, 'searchString', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        if(empty($searchString)){
            $message = "<p class='errMessage'>You must enter a valid String</p>";
        }

        $results = getSearchResults($searchString);

        $resultsCount = count($results);

        $pageNum = trim(filter_input(INPUT_GET, 'pageNum', FILTER_SANITIZE_NUMBER_INT));
        if(empty($pageNum)){
            $pageNum = 1;
        }

        $resultsNumber = "";

        if($resultsCount < 1){
            $displayResults = "<h3 class='errMessage'>Sorry, no results were fonud to match $searchString</h3>";
            include '../view/search.php';
            exit;

        }
        elseif($resultsCount > 10){

            $limit = 10;
            $totalPages = ceil($resultsCount / $limit);

            $paginationResults = pagination($searchString, $pageNum, $limit);

            $displayResults = buildVehicleSearch($paginationResults);

            $paginationBar = buildPaginationBar($totalPages, $pageNum, $searchString);

        } else{

            $displayResults = buildVehicleSearch($results);
            
        }

        include '../view/search.php';
        break;

    default:

    include '../view/search.php';

}





?>