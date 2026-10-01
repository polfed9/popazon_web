<?php
    require_once('bootstrap.php');

    if(isset($_POST["add_to_cart"])) {

        if(!isUserLoggedIn()) {
            if(isset($_SESSION["shopping_cart"])) {
                $item_array_id =  array_column($_SESSION["shopping_cart"], "item_id");
                if(!in_array($_POST["catP"]."_".$_POST["numero"], $item_array_id)){
                    $count = count($_SESSION["shopping_cart"]);
                    $item_array = array(
                        'item_id'			=>	$_POST["catP"]."_".$_POST["numero"],
                        'item_nome'			=>	$_POST["nome"],
                        'item_prezzo'		=>	$_POST["prezzo"],
                        'item_img'		    =>	$_POST["img"],
                        'item_quantita'		=>	1
                    );
                    $_SESSION["shopping_cart"][$count] = $item_array;
                }
                else {
                    $elementi_in_carrello = $_SESSION["shopping_cart"];
                    foreach($elementi_in_carrello as $elemento => $value){
                        if($value["item_id"] == $_POST["catP"]."_".$_POST["numero"]){
                            $qt =  $value["item_quantita"]+1;
                            $_SESSION["shopping_cart"][$elemento]["item_quantita"] = $qt;
                        }
                    }
                }
            }
            else {
                $item_array = array(
                    'item_id'			=>	$_POST["catP"]."_".$_POST["numero"],
                    'item_nome'			=>	$_POST["nome"],
                    'item_prezzo'		=>	$_POST["prezzo"],
                    'item_img'		    =>	$_POST["img"],
                    'item_quantita'		=>	1
                );
                $_SESSION["shopping_cart"][0] = $item_array;
            }
        }
    else {
        $qt = $dbh->getProductQuantity($_SESSION["email"], $_POST["catP"], $_POST["numero"]);
        if(count($qt)==0){
            $dbh->insertIntoOrdine($_SESSION["email"], $_POST["catP"], $_POST["numero"] ,1);
        } else { 
            $quantita = $qt[0]["qt"]+ 1;
            $dbh->updateCarrello($_SESSION["email"], $_POST["catP"], $_POST["numero"] ,$quantita);
        }
    }
}
?>