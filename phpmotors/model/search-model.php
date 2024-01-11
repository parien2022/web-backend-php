<?php

function getSearchResults($searchString){

    $db = phpmotorsConnect();

    $sql = "SELECT * FROM inventory WHERE invColor LIKE :searchStringLike OR invDescription LIKE :searchStringLike OR invYear LIKE :searchStringLike OR invMake LIKE :searchStringLike";

    $stmt = $db->prepare($sql);


    $searchStringLike = '%' . $searchString . '%';

    /*$stmt->bindValue(':searchString', $searchString, PDO::PARAM_STR);*/
    $stmt->bindValue(':searchStringLike', $searchStringLike, PDO::PARAM_STR);

    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt->closeCursor();

    return $results;

}


function pagination($searchString, $pageNum, $limitNum){

    

    $db = phpmotorsConnect();

    $sql = "SELECT * FROM inventory WHERE invColor LIKE :searchStringLike OR invDescription LIKE :searchStringLike OR invYear LIKE :searchStringLike OR invMake LIKE :searchStringLike LIMIT :pageNum, :limitNum";

    $stmt = $db->prepare($sql);


    $searchStringLike = '%' . $searchString . '%';

    /*$stmt->bindValue(':searchString', $searchString, PDO::PARAM_STR);*/
    $stmt->bindValue(':searchStringLike', $searchStringLike, PDO::PARAM_STR);
    $stmt->bindValue(':pageNum', ($pageNum - 1) * 10, PDO::PARAM_INT);
    $stmt->bindValue(':limitNum', $limitNum, PDO::PARAM_INT);


    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt->closeCursor();

    return $results;

}







?>