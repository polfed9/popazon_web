<?php
    require_once("bootstrap.php");
    $templateParams["nome"] = "home.php";
    $templateParams["categoria_principale"] = $dbh->getCatP();
    $templateParams["categoria_specifica"] = $dbh->getAllCatS();
    $templateParams["js"] = array( "js/slideshow-script.js", "js/scrollToTop.js");

    require("template/base.php");
?>