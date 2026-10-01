<?php

    require_once("bootstrap.php");

    if(isUserLoggedIn($_SESSION["email"])){
        $templateParams["nome"] = "template/pagamento.php";
        $templateParams["user"] = $dbh->getInfoUser($_SESSION['email'])[0];
        $templateParams["totale"] = $_POST["totale"];
        $templateParams["numArticoli"] = $_POST["nArt"];
        $templateParams["icon"] = array("src='https://kit.fontawesome.com/f822048abe.js' crossorigin='anonymous'");
    } else {
        header("location: homeAutenticazione.php");
    }
    require("template/base.php");
?>