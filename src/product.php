<?php
    require_once("bootstrap.php");
    
    $templateParams["nome"] = "template/product-page.php";
    $templateParams["product"] = $dbh-> getProductById($_GET["numero"], $_GET["catP"]);
    $templateParams["js"] = array("js/aggiungi-prodotto-carrello.js"); 

    require("template/base.php");
?>