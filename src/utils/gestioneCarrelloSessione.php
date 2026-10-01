<?php 
    //function sessionProductToCart(){
        if(!empty( $_SESSION["shopping_cart"])){
            foreach ( $_SESSION["shopping_cart"] as $keys => $values) {
                $arrId = explode("_", $values["item_id"]);

                $qt = $dbh->getProductQuantity($_SESSION["email"], $arrId[0], $arrId[1]);
                if(count($qt)==0 ){
                    $dbh->insertIntoOrdine($_SESSION["email"], $arrId[0], $arrId[1] ,$values["item_quantita"]);
                } else { 
                    $dbh->updateCarrello($_SESSION["email"], $arrId[0], $arrId[1] ,$qt[0]["qt"]+ $values["item_quantita"]);
                }
            }
        }
    //}
?>