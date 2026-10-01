<?php
    require_once("bootstrap.php");
    if(!isUserLoggedIn()){
        header("location: homeAutenticazione.php");
    } else {
        $templateParams["notifiche"] = $dbh->getNotifiche($_SESSION["email"]);
        $templateParams["nome"] = "template/notifiche.php";
        $templateParams["icon"] = array("src='https://kit.fontawesome.com/f822048abe.js' crossorigin='anonymous'");
        $templateParams["js"] = array( "js/gestisci-notifiche.js");
        if (!is_null($dbh->getInfoUser($_SESSION["email"])[0]["pIva"])){
            $templateParams["venditore"] = "venditore";
        }
        require("template/base.php");
    }

    
?>