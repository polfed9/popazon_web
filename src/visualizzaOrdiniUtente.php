<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    require_once("bootstrap.php");
    if(!isUserLoggedIn()){
        header("location: homeAutenticazione.php");
    } else {
            $templateParams["nome"] = "template/visualizzaOrdiniUtente.php";
            $templateParams["ordini"] = $dbh->getInfoBaseOrdini($_SESSION["email"]);
            $templateParams["icon"] = array("src='https://kit.fontawesome.com/f822048abe.js' crossorigin='anonymous'");
            require("template/base.php");
    }
?>