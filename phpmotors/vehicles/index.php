<?php

//This is the Vehicles controller

//Create or access a Session
session_start();

//Get the database connection file
require_once '../library/connections.php';
//Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
//Get Vehicles model
require_once '../model/vehicles-model.php';
//Get common functions
require_once '../library/functions.php';


//Get the array of classifications
$classifications = getClassifications();

// var_dump($classifications);
//    exit;

//Get a dynamic navigation list
$navList = buildNavigation($classifications);


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
}

switch($action){
    case 'addVehicle':
        $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT));
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));


        if (empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)){
            $message = '<p class="errMessage">Please provide information for all empty form fields.</p>';
            include '../view/add-vehicle.php';
            exit; 
        }

        $rowsChanged = regInventory($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);

        if ($rowsChanged === 1){
            $message = "<p>Congratulations, thanks for adding $invMake $invModel vehicle.</p>";
            include '../view/add-vehicle.php';
            exit;
        }else{
            $message = "<p class='errMessage'>Sorry, there was a problem when adding the vehicle, please try again</p>";
            include '../view/add-vehicle.php';
            exit;
        }

        exit;

        break;
    case 'addClassification':

        $classificationName = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        $checkedClassificationName = checkFieldLong ($classificationName);

        if (empty($checkedClassificationName)){
            $message = "<p class='errMessage'>Please provide information for all empty form fields.</p>";
            include '../view/add-classification.php';
            exit; 
        }

        $regOutCome = regVehicle($classificationName);

        if ($regOutCome === 1){
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }else{
            $message = "<p class='errMessage'>Sorry, there was a problem when adding the car classification, please try again</p>";
            include '../view/add-classification.php';
            exit;
        }
        break;

    case 'classification':
        include '../view/add-classification.php';
        break;

    case 'vehicle':
        include '../view/add-vehicle.php';
        break;

    case 'getInventoryItems':
        /*Get vehciles by classificationId */

        $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT);

        $inventoryArray = getInventoryByClassification($classificationId);

        echo json_encode($inventoryArray);

        break;

    case 'mod':

        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);

        $invInfo = getInvItemInfo($invId);

        if(count($invInfo) < 1){
            $message = "Sorry, no vehicle information could be found.";
        }

        include '../view/vehicle-update.php';
        exit;
        
        break;

    case 'updateVehicle':

        $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
        $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

        if(empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)){
            $message = "<p>Please complete all information for the updated vehicle! Double check the classification of the item.</p>";
            include '../view/vehicle-update.php';
            exit;
        }

        $updateResult = updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $invId, $classificationId);

        if($updateResult){
            $message = "<p>Congratulations, the $invMake $invModel was successfully updated.</p>";
            $_SESSION['message'] = $message;
            header('Location: /phpmotors/vehicles/');
            exit;
        }else{
            $message = "<p>Error. The new vehicle was not updated.</p>";
            include '../view/vehicle-update.php';
            exit;
        }

        break;

    case 'del':
        
        $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT);

        $invInfo = getInvItemInfo($invId);

        if(count($invInfo) < 1){
            $message = "Sorry, no vehicle information could be found.";
        }

        include '../view/vehicle-delete.php';
        exit;

        break;

    case 'deleteVehicle':
        
        $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        
        $deleteResult = deleteVehicle($invId);

        if($deleteResult){
            $message = "<p>Congratulations, the $invMake $invModel was successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('Location: /phpmotors/vehicles/');
            exit;
        }else{
            $message = "<p>Error. The new vehicle was not deleted.</p>";
            $_SESSION['message'] = $message;
            header('Location: /phpmotors/vehicles/');
            exit;
        }

        break;

    case 'displayVehicles':
        
        $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $vehicles = getVehiclesByClassification($classificationName);

        if(!count($vehicles)){
            $message = "<p class='errMessage'>Sorry, no $classificationName vehicles could be found</p>";
        }else{
            $vehiclesDisplay = buildVehiclesDisplay($vehicles);
        }

        include '../view/classification.php';

        break;
    
    case 'vehicleDetails':

        $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT);

        $vehicleDetails = getInvItemInfo($invId);

        if(!count($vehicleDetails)){
            $message = "<p class='errMessage'>Sorry, the vehicle could not be found</p>";
            include '../view/classification.php';
            exit;
        }else{
            $displayVehiclesDetails = buildVehiclesDetails($vehicleDetails);
        }

        include '../view/vehicle-detail.php';
        break;

    default:

        $classificationList = buildClassificationList($classifications);

        include '../view/vehicle-man.php';
        break;
}
?>