<?php
    require_once("bootstrap.php");

    $templateParams["nome"] = "template/profile.php";
    $templateParams["user"] = $dbh->getInfoUser($_SESSION['email'])[0];
    if (!is_null($dbh->getInfoUser($_SESSION["email"])[0]["pIva"])){
        $templateParams["venditore"] = "venditore";
    }
	require("template/base.php");

?>