<?php
    require_once("bootstrap.php");
    $templateParams["nome"] = "template/inStock-page.php";
    $templateParams["categoria_principale"] = $dbh->getCatP();
    $templateParams["quantita"] = $dbh-> getCategoryProdQt();
    $templateParams["quantita&catSpecifica"] = $dbh-> getCatSquantity();
    $templateParams["in_stock"] = $dbh->getAvailableProducts();
    $templateParams["js"] = array( "js/filter-script-instock.js", "js/scrollToTop.js");

    $templateParams["icon"] = array("src='https://kit.fontawesome.com/f822048abe.js' crossorigin='anonymous'");

    require("template/base.php");

     //header('Content-Type: application/json');
     echo "<span hidden class='in_stock'>".json_encode($templateParams["in_stock"])."</span>";
?>