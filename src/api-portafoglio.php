<?php
    require_once("bootstrap.php");
    if(!isUserLoggedIn()){
        $response = json_encode( array( 'err' => "2", 'location' => "homeAutenticazione.php"));
        header('Content-Type: application/json');
        echo $response;
    } else {
        header('Content-Type: application/json');
        echo json_encode(array("err"=> $dbh->incrementaPortafoglio($_POST["importo"], $_SESSION["email"])));
    }
    
?>