<?php
    require_once("bootstrap.php");

    $templateParams["nome"] = "template/portafoglio.php";
    $templateParams["user"] = $dbh->getInfoUser($_SESSION['email'])[0];
    $templateParams["saldo"] = $dbh->getSaldoTot($_SESSION['email']); 
    $templateParams["movimenti"] = $dbh->getPortafoglioMovement($_SESSION["email"]);
    $templateParams["js"] = array("js/scrollToTop.js", "js/gestisci-portafoglio.js"); 
    $templateParams["icon"] = array("src='https://kit.fontawesome.com/f822048abe.js' crossorigin='anonymous'");
	require("template/base.php");

?>