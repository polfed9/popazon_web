<?php
require_once("../bootstrap.php");
    if(isUserLoggedIn()){
        echo count($dbh->getNewNotifiche($_SESSION["email"]));
    }
?>