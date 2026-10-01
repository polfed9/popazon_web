<?php
    require_once("bootstrap.php");

    $templateParams["nome"] = "template/informazioni.php";
    $venditore = $dbh->getVenditore();
    $templateParams["info"] = $dbh->getInfoUser($venditore)[0];
    $templateParams["js"] = array("js/scrollToTop.js"); 
    $templateParams["icon"] = array("src='https://kit.fontawesome.com/f822048abe.js' crossorigin='anonymous'");
	require("template/base.php");

?>