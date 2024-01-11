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
        $dv .= "<a href='/phpmotors/vehicles/?action=vehicleDetails&invId=$vehicle[invId]'><img src='$vehicle[imgPath]' alt='image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'></a>";
        $dv .= "<hr>";
        $dv .= "<a href='/phpmotors/vehicles/?action=vehicleDetails&invId=$vehicle[invId]'><h2>$vehicle[invMake] $vehicle[invModel]</h2></a>";
        $dv .= "<span>$$vehicle[invPrice]</span>";
        $dv .= "</li>";
    }
    $dv .= "</ul>";
    
    return $dv;

}

function buildVehiclesDetails($vehicleDetails, $vehicelesTnImages){

    $dv = "<div class='invDisplayDetails'>";
    $dv .= "<h2 class='thHeading'>Thumbnail images</h2>";
    $dv .= "<div class='tnImagesContainer'>";
    foreach($vehicelesTnImages as $image){
        $dv .= "<img src='$image[imgPath]' alt='image of $vehicleDetails[invMake] $vehicleDetails[invModel] on phpmotors.com'>";
    }
    $dv .= "</div>"; 
    $dv .= "<div class='primaryVehicleImg'>";
    $dv .= "<img src='$vehicleDetails[imgPath]' alt='image of $vehicleDetails[invMake] $vehicleDetails[invModel] on phpmotors.com'>";
    $dv .= "<h3 class='detailsPrice'>Price: $$vehicleDetails[invPrice]</h3>";
    $dv .= "</div>";
    $dv .= "<div class='invDetails'>";
    $dv .= "<h3>$vehicleDetails[invMake] $vehicleDetails[invModel] Details</h3>";
    $dv .= "<p>$vehicleDetails[invDescription]</p>";
    $dv .= "<p>Color: $vehicleDetails[invColor]</p>";
    $dv .= "</div>";
    $dv .= "</div>";
    
    return $dv;

}

/* * ********************************
*  Functions for working with images
* ********************************* */

// Adds "-tn" designation to file name

function makeThumbnailName($image){
    $i = strrpos($image, '.');

    $image_name = substr($image, 0, $i);

    $ext = substr($image, $i);

    $image = $image_name . '-tn' . $ext;

    return $image;
}


// Build images display for image management view
function buildImageDisplay($imageArray){

    $id = "<ul class='invDisplay' id=image-display>";

    foreach ($imageArray as $image){
        $id .= "<li>";
        $id .= "<img src='$image[imgPath]' title='$image[invMake] $image[invModel] image on PHP Motors.com' alt='$image[invModel] image on PHP Motors.com'>";
        $id .= "<p><a href='/phpmotors/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
        $id .= "</li>";
    }

    $id .= "</ul>";

    return $id;
}


// Build the vehicles select list
function buildVehiclesSelect($vehicles){

    $prodList = "<select name='invId' class='selectOptions' id='invId'>";
    $prodList .= "<option selected disabled> Choose a Vehicle</option>";
    foreach($vehicles as $vehicle){
        $prodList .= "<option value='$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</option>";
    }
    $prodList .= "</select>";

    return $prodList;
}


function uploadfile($name){

    // Handles the file upload process and returns the path
    // The file path is stored into the database

    // Gets the paths, full and local directory

    global $image_dir, $image_dir_path;
    if(isset($_FILES[$name])){

        // Gets the actual file name
        $filename = $_FILES[$name]['name'];

        if(empty($filename)){
            return;
        }

        // Get the file from the temp folder on the server
        $source = $_FILES[$name]['tmp_name'];

        // Sets the new path - images folder in this directory
        $target = $image_dir_path . '/' . $filename;

        // Moves the file to the target folder
        move_uploaded_file($source, $target);

        // Send file for further processing
        processImage($image_dir_path, $filename);

        // Sets the path for the image for Database storage
        $filepath = $image_dir . '/' . $filename;

        // Returns the path where the file is stored
        return $filepath;

    }
    
}

// Processes images by getting paths and 
// creating smaller versions of the image
function processImage($dir, $filename){

    // Set up the variables
    $dir = $dir . '/';

    // Set up the image path
    $image_path = $dir . $filename;

    // Set up the thumbnail image path
    $image_path_tn = $dir.makeThumbnailName($filename);

    // Create a thumbnail image that's a maximum of 200 pixels square
    resizeImage($image_path, $image_path_tn, 200, 200);

    // Resize original to a maximum of 500 pixels square
    resizeImage($image_path, $image_path, 500, 500);
}

// Checks and Resizes image
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {
     
    // Get image type
    $image_info = getimagesize($old_image_path);
    $image_type = $image_info[2];
   
    // Set up the function names
    switch ($image_type) {
        case IMAGETYPE_JPEG:
            $image_from_file = 'imagecreatefromjpeg';
            $image_to_file = 'imagejpeg';
        break;
        case IMAGETYPE_GIF:
            $image_from_file = 'imagecreatefromgif';
            $image_to_file = 'imagegif';
        break;
        case IMAGETYPE_PNG:
            $image_from_file = 'imagecreatefrompng';
            $image_to_file = 'imagepng';
        break;
            
        default:
        return;
   } // ends the swith
   
    // Get the old image and its height and width
    $old_image = $image_from_file($old_image_path);
    $old_width = imagesx($old_image);
    $old_height = imagesy($old_image);
   
    // Calculate height and width ratios
    $width_ratio = $old_width / $max_width;
    $height_ratio = $old_height / $max_height;
   
    // If image is larger than specified ratio, create the new image
    if ($width_ratio > 1 || $height_ratio > 1) {
   
        // Calculate height and width for the new image
        $ratio = max($width_ratio, $height_ratio);
        $new_height = round($old_height / $ratio);
        $new_width = round($old_width / $ratio);
    
        // Create the new image
        $new_image = imagecreatetruecolor($new_width, $new_height);
    
        // Set transparency according to image type
        if ($image_type == IMAGETYPE_GIF) {
            $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
            imagecolortransparent($new_image, $alpha);
        }
    
        if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
            imagealphablending($new_image, false);
            imagesavealpha($new_image, true);
        }
    
        // Copy old image to new image - this resizes the image
        $new_x = 0;
        $new_y = 0;
        $old_x = 0;
        $old_y = 0;
        imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);
    
        // Write the new image to a new file
        $image_to_file($new_image, $new_image_path);
        // Free any memory associated with the new image
        imagedestroy($new_image);
     } else {
        // Write the old image to a new file
        $image_to_file($old_image, $new_image_path);
     }
     // Free any memory associated with the old image
     imagedestroy($old_image);

} // ends resizeImage function



function buildVehicleSearch($results){

    $searchList = "<div>";
    foreach ($results as $result){
        $searchList .= "<a href='/phpmotors/vehicles/?action=vehicleDetails&invId=$result[invId]'><h3>$result[invYear] $result[invMake] $result[invModel]</h3></a>";
        $searchList .= "<p>$result[invDescription]</p>";
    }
    $searchList .= "<div>";

    return $searchList;
}


function buildPaginationBar($totalPages, $pageNum, $searchString){
    
    $bar = "<div class='paginationNumContainer'>";

    if($pageNum > 1){
        $bar .= "<a href='/phpmotors/search/?action=search&pageNum=" . $pageNum - 1 . "&searchString=$searchString'><p>Previous</p></a>";
    }

    for ($i = 1; $i <= $totalPages; $i++){

        if($i == $pageNum){

            $bar .= "<p>$i</p>";

        }else{

        $bar .= "<a href='/phpmotors/search/?action=search&pageNum=$i&searchString=$searchString'><p>$i</p></a>";

        }
        
    }

    if($pageNum < $totalPages){
        $bar .= "<a href='/phpmotors/search/?action=search&pageNum=" . $pageNum + 1 . "&searchString=$searchString'><p>Next</p></a>";
    }
    
    $bar .= "</div>";



    return $bar;

}

?>
