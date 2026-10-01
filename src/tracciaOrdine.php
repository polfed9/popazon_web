<?php
require_once 'bootstrap.php';
if(!isUserLoggedIn()){
    header("location: homeAutenticazione.php");
} else {
    $templateParams["titolo"] = "PoPazon- gestisci prodotti";
    $templateParams["nome"] = "template/tracciaOrdine.php";    
    if(isset($_GET["ordine"])){
        $templateParams["nOrdine"] = $_GET["ordine"];
        $templateParams["track"]= $dbh->getTrackSpecificOrder($_GET["ordine"]);
        $templateParams["stato"]= $dbh->getStatoSpecificOrder($_GET["ordine"])["stato"];
        $templateParams["statiRimanenti"]= $dbh->getStatiMancantiOrdine($_GET["ordine"]);
        $templateParams["prodotti"]= $dbh->getProductSpecificOrder($_GET["ordine"]);
        $templateParams["icon"] = array("src='https://kit.fontawesome.com/f822048abe.js' crossorigin='anonymous'");
    }
}
require 'template/base.php';
?>