<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    require_once("bootstrap.php");
    if(!isUserLoggedIn() || is_null($dbh->getInfoUser($_SESSION["email"])[0]["pIva"])){
        header("location: homeAutenticazione.php");
    } else {
        $templateParams["nome"] = "template/gestisciCategorieVenditore.php";
        $templateParams["catP"] = $dbh->getCatP();
        $templateParams["js"] = array("js/gestisci-categorie.js"); 
        $templateParams["venditore"] = "venditore";
        require("template/base.php");
    }
?>