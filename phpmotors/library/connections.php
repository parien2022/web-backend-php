<?php

/*
*Proxy connection to the phpmotors databse
*/

function phpmotorsConnect(){
    $server = 'localhost';
    $dbname= 'phpmotors';
    $username = 'iClient';
    $password = 'A(g8w8ffqalbg)1@'; 
    $dsn = "mysql:host=$server;dbname=$dbname";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
   
    // Create the actual connection object and assign it to a variable
    try {
     $link = new PDO($dsn, $username, $password, $options);
     /*if(is_object($link)){
        echo 'It worked';
     }*/
     return $link;
    } catch(PDOException $e) {
        //echo 'Sorry, the connection failed with error: ' . $e->getMessage();
        header('Location: /phpmotors/view/500.php');
        //exit;
    }
   }

    phpmotorsConnect();


?>