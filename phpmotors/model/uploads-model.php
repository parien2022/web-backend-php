<?php

//This model is for vehicle inventory image uploads

//Add image information to the database table

function storeImages($imgPath, $invId, $imgName){

    $db = phpmotorsConnect();

    $sql = 'INSERT INTO images (invId, imgPath, imgName) VALUES (:invId, :imgPath, :imgName);';

    $stmt = $db->prepare($sql);

    // Store the full size image information
    $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
    $stmt->bindValue(':imgPath', $imgPath, PDO::PARAM_STR);
    $stmt->bindValue(':imgName', $imgName, PDO::PARAM_STR);

    $stmt->execute();

    // Make and store the thumbnail image information
    // Change name in path
    $imgPath = makeThumbnailName($imgPath);

    // Change name in file name
    $imgName = makeThumbnailName($imgName);

    $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
    $stmt->bindValue(':imgPath', $imgPath, PDO::PARAM_STR);
    $stmt->bindValue(':imgName', $imgName, PDO::PARAM_STR);

    $stmt->execute();

    $rowsChanged = $stmt->rowCount();

    $stmt->closeCursor();

    return $rowsChanged;


}

function getImages(){
    $db = phpmotorsConnect();

    $sql = 'SELECT imgId, imgPath, imgName, imgDate, inventory.invId, invMake, invModel FROM images JOIN inventory ON images.invId = inventory.invId;';

    $stmt = $db->prepare($sql);

    $stmt->execute();

    $imageArray = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt->closeCursor();

    return $imageArray;

}

function deleteImage($imgId){

    $db = phpmotorsConnect();

    $sql = 'DELETE FROM images WHERE imgId = :imgId;';

    $stmt = $db->prepare($sql);

    $stmt->bindValue(':imgId', $imgId, PDO::PARAM_INT);

    $stmt->execute();

    $rowsDeleted = $stmt->rowCount();

    $stmt->closeCursor();

    return $rowsDeleted;

}

//Check for an existing image
function checkExistingImage($imgName){

    $db = phpmotorsConnect();

    $sql = 'SELECT imgName FROM images WHERE imgName = :name;';

    $stmt = $db->prepare($sql);

    $stmt->bindValue(':name', $imgName, PDO::PARAM_STR);

    $stmt->execute();

    $imgMatch = $stmt->fetch();

    $stmt->closeCursor();

    return $imgMatch;
}

function getTnImagesDetail($invId){

    $db = phpmotorsConnect();

    $sql = "SELECT imgPath FROM images WHERE invId = :invId AND imgPath LIKE '%-tn%';";

    $stmt = $db->prepare($sql);

    $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);

    $stmt->execute();

    $imgTn = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt->closeCursor();

    return $imgTn;

}


?>