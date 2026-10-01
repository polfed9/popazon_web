<?php
    require_once("bootstrap.php");

    $templateParams["nome"] = "template/exclusive-page.php";
    $templateParams["categoria_principale"] = $dbh->getCatP();
    $templateParams["quantita"] = $dbh-> getCategoryProdQt();
    $templateParams["quantita&catSpecifica"] = $dbh-> getExcCatSquantity(1);
    $templateParams["exclusive"] = $dbh->getExclusiveProducts();
    $templateParams["js"] = array("js/scrollToTop.js", "js/filter-script-exclusive.js"); 
    $templateParams["icon"] = array("src='https://kit.fontawesome.com/f822048abe.js' crossorigin='anonymous'");
    require_once("template/base.php");

    //header('Content-Type: application/json');
    echo "<span hidden class='exclusive'>".json_encode($templateParams["exclusive"])."</span>";
?>
