<?php

//This is the Accounts controller

//Create or access a Session
session_start();

//Get the database connection file
require_once '../library/connections.php';
//Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
//Get the accounts model
require_once '../model/accounts-model.php';
//Get common functions
require_once '../library/functions.php';


//Get the array of classifications
$classifications = getClassifications();

//var_dump($classifications);
   // exit;

//Get a dynamic navigation list
$navList = buildNavigation($classifications);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
}

switch($action){
    case 'login':
        include '../view/login.php';
        break;
    case 'registration':
        include '../view/registration.php';
        break;
    case 'register':
        //echo 'You are on the register case statement';

        // Filter and store the data
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        $checkedClientEmail = checkEmail($clientEmail);
        $checkPassword =  checkPassword($clientPassword);

        $checkEmailExistence = checkForExistingEmail($clientEmail);
        
        //Check for an exising email address in the table
        if($checkEmailExistence){
            $message = '<p>This email address already exists. you may want to log in instead</p>';
            include '../view/login.php';
            exit;
        }

        if(empty($clientFirstname) || empty($clientLastname) || empty($checkedClientEmail) || empty($checkPassword)){
            $message = "<p class='errMessage'>Please provide information for all empty form fields.</p>";
            include '../view/registration.php';
            exit;
        }

        //Password hashing
        $hashedPassowrd = password_hash($clientPassword, PASSWORD_DEFAULT);

        // Check and report the result
        $regOutCome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassowrd);

        if ($regOutCome === 1){

            //setcookie('firstname', $clientFirstname, strtotime('+1 year'), ('/'));

            $_SESSION['message'] = "<p class='sucMessage'>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
            header('Location: /phpmotors/accounts/?action=login');
            exit;
        }else{
            $_SESSION['message'] = "<p class='errMessage'>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include '../view/registration.php';
            exit;
        }
        break;
    case 'Login':
        
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        
        $checkedClientEmail = checkEmail($clientEmail);
        $checkPassword =  checkPassword($clientPassword);

        if(empty($checkedClientEmail) || empty($checkPassword)){
            $_SESSION['message'] = "<p class='errMessage'>Please provide information for all empty form fields.</p>";
            include '../view/login.php';
            exit;
        }

        //A valid password exists, proceed with the login process
        //Query the client data on the email address
        $clientData = getClient($clientEmail);

        //compare the password just submitted against the hashed password fot the matching client
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);

        //If the hashes don't match create an error and return to the login view
        if(!$hashCheck){
            $_SESSION['message'] = "<p class='errMessage'>Please check your password and try again.</p>";
            include '../view/login.php';
            exit;
        }

        //A valid user exists, log them in
        $_SESSION['loggedin'] = TRUE;

        //Remove password from the array
        array_pop($clientData);

        //Store array into the session
        $_SESSION['clientData'] = $clientData;

        //Send them to the admin view
        include '../view/admin.php';
        exit;
        
        break;
    case 'Logout':

        unset($_SESSION['message']);
        unset($_SESSION['loggedin']);
        unset($_SESSION['clientData']);

        $_SESSION = array();
        session_destroy();

        header('Location: /phpmotors/');
        exit;

        break;

    case 'updateClient':

        include '../view/client-update.php';
        exit;

        break;

    case 'updateAccount':

        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));

        $checkedClientEmail = checkEmail($clientEmail);

        if(empty($clientFirstname) || empty($clientLastname) || empty($checkedClientEmail)){
            $accountMessage = "<p class='errMessage'>Please provide information for all empty form fields in order to update account information</p>";
            include '../view/client-update.php';
            exit;
        }
        
        if($clientEmail != $_SESSION['clientData']['clientEmail']){

            $checkEmailExistence = checkForExistingEmail($clientEmail);

            //Check for an exising email address in the table
            if($checkEmailExistence){
                $accountMessage = "<p class='errMessage'>This email address already exists.</p>";
                include '../view/client-update.php';
                exit;
            }
        }
        

        $updatedClientOutCome = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);

        if ($updatedClientOutCome === 1){

            $clientData = getClientById($clientId);
            $_SESSION['clientData'] = $clientData;

            $_SESSION['message'] = "<p class='sucMessage'>Thanks " . $_SESSION['clientData']['clientFirstname'] . ", account was successfully updated</p>";

            header('Location: /phpmotors/accounts/');
            exit;

        }else{
            $accountMessage = "<p class='errMessage'>Sorry " . $_SESSION['clientData']['clientFirstname'] . ", but the Account update failed. Please try again.</p>";
            include '../view/client-update.php';
            exit;
        }

        break;

    case 'updatePassword':

        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        $checkPassword =  checkPassword($clientPassword);

        if(empty($checkPassword)){
            $passMessage = "<p class='errMessage'>Please provide information for all empty form fields.</p>";
            include '../view/client-update.php';
            exit;
        }

        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        $passUpdateOutCome = updatePassword($hashedPassword, $clientId);

        if($passUpdateOutCome === 1){

            $_SESSION['message'] = "<p class='sucMessage'>Thanks " . $_SESSION['clientData']['clientFirstname'] . ", Password was successfully updated</p>";

            header('Location: /phpmotors/accounts/');
            exit;

        }else{
            $passMessage = "<p class='errMessage'>Sorry " . $_SESSION['clientData']['clientFirstname'] . ", but the Password update failed. Please try again.</p>";
            include '../view/client-update.php';
            exit;
        }

        break;
    default:

        include '../view/admin.php';
        break;
}
?>