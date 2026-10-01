<?php
    require_once("bootstrap.php");
    if(!isUserLoggedIn()){
        //aggiorno la session
        $elementi_in_carrello = $_SESSION["shopping_cart"];
        foreach($elementi_in_carrello as $elemento => $value){
            if($value["item_id"] == $_POST["id"]){
                if($_POST["qt"] == 0){
                    //lo rimuovo dalla session
                    unset($_SESSION["shopping_cart"][$elemento]);
                } else {
                    $_SESSION["shopping_cart"][$elemento]["item_quantita"] = $_POST["qt"];
                }
            }
        }

    } else {
        var_dump($_POST["id"]);
        //aggiorno il db
        $id = explode("_", $_POST["id"]);
        $dbh->updateCarrello($_SESSION["email"], $id[0], $id[1], $_POST['qt']);
        
    }

?>