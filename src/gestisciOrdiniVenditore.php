<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    require_once("bootstrap.php");
    if(!isUserLoggedIn() || is_null($dbh->getInfoUser($_SESSION["email"])[0]["pIva"])){
        header("location: homeAutenticazione.php");
    } else {
        $templateParams["nome"] = "template/gestisciOrdiniVenditore.php";
        $templateParams["stati"]= $dbh->getStatoOrdini();
        $templateParams["ordini"] = $dbh->getOrdini();
        $templateParams["consegnato"]= $dbh->getLastIdStato();
        $templateParams["js"] = array("js/gestisci-stato.js", "js/scrollToTop.js"); 
        $templateParams["venditore"] = "venditore";
        $templateParams["icon"] = array("src='https://kit.fontawesome.com/f822048abe.js' crossorigin='anonymous'");
        require("template/base.php");
    }
?>