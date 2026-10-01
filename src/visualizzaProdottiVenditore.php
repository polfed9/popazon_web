<?php
    require_once("bootstrap.php");
    if(!isUserLoggedIn() || is_null($dbh->getInfoUser($_SESSION["email"])[0]["pIva"])){
        header("location: homeAutenticazione.php");
    } else {
        $templateParams["nome"] = "template/visualizzaProdottiVenditore.php";
        $templateParams["prodotti"] = $dbh->getAllProducts();
        $templateParams["js"] = array("js/scrollToTop.js", "js/searchProdottiVenditore.js"); 
        $templateParams["icon"] = array("src='https://kit.fontawesome.com/f822048abe.js' crossorigin='anonymous'");
        $templateParams["venditore"] = "venditore";
        if(isset($_GET["formsg"])){
            $templateParams["msg"] = $_GET["formsg"];
        }
        require("template/base.php");

    }

    
?>