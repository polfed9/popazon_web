<?php
require_once 'bootstrap.php';
if(!isUserLoggedIn() || is_null($dbh->getInfoUser($_SESSION["email"])[0]["pIva"])){
    header("location: homeAutenticazione.php");
} else {
    $templateParams["titolo"] = "PoPazon- gestisci prodotti";
    $templateParams["nome"] = "template/aggiungiProdottoVenditore.php";
    $templateParams["venditore"] = "venditore";
    if($_GET["action"]==1){
        $templateParams["js"] = array("js/newProduct.js");
        $templateParams["catP"] = $dbh->getCatP();
        $templateParams["prodotto"] = getEmptyProduct();
        if(isset($_GET["errCatP"])){
            $templateParams["erroreCatP"] = $_GET["errCatP"];
        }
        if(isset($_GET["errCatS"])){
            $templateParams["erroreCatS"] = $_GET["errCatS"];
        }
        if(isset($_GET["erroreProdotto"])){
            $templateParams["erroreProdotto"] = $_GET["erroreProdotto"];
        }
    } else {
        $templateParams["prodotto"]= $dbh->getASpecificProduct($_GET["numero"], $_GET["catP"])[0];
    } 

    $templateParams["azione"] = $_GET["action"];
}



require 'template/base.php';
?>