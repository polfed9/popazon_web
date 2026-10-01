<?php
    require_once("bootstrap.php");
    $templateParams["nome"] = "template/category-page.php";
    $templateParams["categoria_principale"] = $dbh->getCatP();
    $templateParams["categoria_scelta"] = $dbh-> getProductsByCatP($_GET["catP"]);
    $templateParams["franchise"] = $dbh-> getCatSFromSelectedCatP($_GET["catP"]); 
    $templateParams["quantita"] = $dbh-> getCategoryProdQt();
    $templateParams["quantita&catSpecifica"] = $dbh-> getCatSquantity();
    $templateParams["js"] = array("js/scrollToTop.js", "js/filter-script.js"); 
    $templateParams["icon"] = array("src='https://kit.fontawesome.com/f822048abe.js' crossorigin='anonymous'");
    require("template/base.php");
?>
