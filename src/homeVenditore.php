<?php
    require_once("bootstrap.php");
    if(!isUserLoggedIn() || is_null($dbh->getInfoUser($_SESSION["email"])[0]["pIva"])){
        header("location: homeAutenticazione.php");
    } else {
        $templateParams["venditore"] = "venditore";
        $templateParams["nome"] = "template/homeVenditore.php";
        require("template/base.php");
    }
    
?>