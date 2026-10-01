<?php
    require_once("bootstrap.php");
    $templateParams["nome"] = "template/carrello.php";
    $carrello = !isUserLoggedIn() ? (empty($_SESSION["shopping_cart"]) ? array() :  $_SESSION["shopping_cart"]) : $dbh->getAllProductsInCart3($_SESSION["email"]);
    $templateParams["carrello"] = $carrello;
    $artTot=0;
    foreach($carrello as $p){
        $artTot+=$p["item_quantita"];
    }
    $templateParams["numArticoli"] = $artTot;
    $templateParams["icon"] = array("src='https://kit.fontawesome.com/f822048abe.js' crossorigin='anonymous'");
    $templateParams["js"] = array("js/gestisci-quantita.js"); 
    if(isset($_GET["msg"])){
        $templateParams["msg"] = $_GET["msg"];
    }
    require("template/base.php");
?>