<?php

function checkEmail($clientEmail){

    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);

    return $valEmail;

}

function checkPassword ($clientPassword){

    $pattern = "/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/";

    return preg_match($pattern, $clientPassword);
}

function checkFieldLong ($field){

    $pattern = "/^[a-zA-Z ]{1,30}$/";

    return preg_match($pattern, $field);
}

function buildNavigation ($classifications){
    $navList = '<div class="navMenu"><h4>Menu</h4>';
    $navList .= '<button class="navButton">&#9776;</button></div>';
    $navList .= '<ul class="nav-ul">';
    $navList .= "<a href='/phpmotors/' title='View the PHP Motors Home page'><li>Home</li></a>";
    foreach($classifications as $classification){
        $navList .= "<a href='/phpmotors/vehicles?action=displayVehicles&classificationName=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] lineup of vehicles'><li>$classification[classificationName]</li></a>";
    }
    $navList .= '</ul>';

    return $navList;
}

function buildClassificationList ($classifications){
    
    //Build the classification select list
    $classificationList = "<select name='classificationId' class='selectOptions' id='classificationList'>";
    $classificationList .= "<option value='' disabled selected>Choose car classification</option>";
    foreach ($classifications as $classification){
        $classificationList .= "<option value=".urlencode($classification['classificationId'])."";
        if (isset($classificationId) && $classification['classificationId'] == $classificationId){
            $classificationList .= " selected";
        }
        $classificationList .= ">".urlencode($classification['classificationName'])."";
        $classificationList .= "</option>";
    }
    $classificationList .= "</select>";

    return $classificationList;
}


function buildVehiclesDisplay($vehicles){

    $dv = "<ul class='invDisplay'>";
    foreach($vehicles as $vehicle){
        $dv .= "<li>";
        $dv .= "<a href='/phpmotors/vehicles/?action=vehicleDetails&invId=$vehicle[invId]'><img src='$vehicle[invThumbnail]' alt='image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'></a>";
        $dv .= "<hr>";
        $dv .= "<a href='/phpmotors/vehicles/?action=vehicleDetails&invId=$vehicle[invId]'><h2>$vehicle[invMake] $vehicle[invModel]</h2></a>";
        $dv .= "<span>$$vehicle[invPrice]</span>";
        $dv .= "</li>";
    }
    $dv .= "</ul>";
    
    return $dv;

}

function buildVehiclesDetails($vehicleDetails){

    $dv = "<div class='invDisplayDetails'>";
    $dv .= "<img src='$vehicleDetails[invImage]' alt='image of $vehicleDetails[invMake] $vehicleDetails[invModel] on phpmotors.com'>";
    $dv .= "<h3 class='detailsPrice'>Price: $$vehicleDetails[invPrice]</h3>";
    $dv .= "<div class='invDetails'>";
    $dv .= "<h3>$vehicleDetails[invMake] $vehicleDetails[invModel] Details</h3>";
    $dv .= "<p>$vehicleDetails[invDescription]</p>";
    $dv .= "<p>Color: $vehicleDetails[invColor]</p>";
    $dv .= "<p># in Stock: $vehicleDetails[invStock]</p>";
    $dv .= "</div>";
    $dv .= "</div>";
    
    return $dv;

}

?>