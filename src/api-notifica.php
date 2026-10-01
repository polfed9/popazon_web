<?php
    require_once("bootstrap.php");
    //decommenta dopo aver fatto il login per il venditore
    //|| is_null($dbh->getInfoUser($_SESSION["email"])[0]["pIva"])
    if(!isUserLoggedIn()){
        $response = json_encode( array( 'err' => "1", 'location' => "homeAutenticazione.php"));
        header('Content-Type: application/json');
        echo $response;
    } else {
        if ($_POST["action"] == "open") {
            $dbh->updateStatoNotifica($_POST["id"]);
            $response = json_encode( array( 'err' => "0", 'notifica' => $dbh->getNotifichaById($_POST["id"])));
            header('Content-Type: application/json');
            echo $response;
        } elseif ($_POST["action"] == "aggiorna") {
            $response = json_encode( array( 'err' => "0", 'notifiche' => $dbh->getNotifiche($_SESSION["email"])));
            header('Content-Type: application/json');
            echo $response;
        }
        
    }

?>