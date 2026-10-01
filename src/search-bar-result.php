<?php
    require_once("bootstrap.php");

    $templateParams["nome"] = "template/search-bar-result.php";
    $templateParams["result"] = $dbh -> getProductByName($_GET["search-text"]);
    $templateParams["js"] = array("js/scrollToTop.js"); 
    $templateParams["icon"] = array("src='https://kit.fontawesome.com/f822048abe.js' crossorigin='anonymous'");
    require("template/base.php");
?>