<?php
    require_once("bootstrap.php");
    $templateParams["nome"] = "template/login.php";
    $templateParams["azione"] = $_GET["action"];
    if(isset($_SESSION['email']) && $_SESSION['email'] === $dbh->getVenditore()){
        $templateParams["venditore"] = "venditore";
    }
    if($_GET["action"]==1){
        $templateParams["user"] = getEmptyUser();

        if (isset($_POST['loginBtn'])) {
            $form_errors = array();
            $required_fields = array('email', 'password');
            $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

            if (empty($form_errors)) {
                $usermail = $_POST['email'];
                $password = $_POST['password'];
                $login_result = $dbh->checkLogin($_POST["email"], $_POST["password"]);

                if(count($login_result)==1){
                    $_SESSION['email'] = $usermail;
                    $result = flashMessage("Accesso Corretto!");
                    //passaggio prodotti sessione carrello nel carrello del database
                    if(!empty($_SESSION["shopping_cart"])){
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
                    if(isUserLoggedIn() && !is_null($dbh->getInfoUser($_SESSION["email"])[0]["pIva"])){
                        $templateParams["venditore"] = "venditore";
                    }
                    $templateParams["nome"] = "template/homeAutenticazione.php";
                } else {
                    $result = flashMessage("Email o password errate!");
                }

            } else {
                if (count($form_errors) == 1) {
                    $result = flashMessage("È stato rilevato 1 errore nel form<br/>");
                } else {
                    $result = flashMessage('Sono stati rilevati ' . count($form_errors) . ' errori nel form<br/>');
                }
            }
        }
        require("template/base.php");
    



    }else { // $_POST["action"]==2) modifica anagrafica
        $templateParams["user"] = $dbh->getInfoUser($_SESSION['email'])[0];
        
        if (isset($_POST['loginBtn'])) {
            $form_errors = array();
            $required_fields = array('password');
            $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

            if (empty($form_errors)) {

                $usermail = $_SESSION['email'];
                $password = $_POST['password'];

                $login_result = $dbh->checkLogin($usermail, $password);

                if(count($login_result)==1){
                    header("location: register.php?action=2");
                } else {
                    $result = flashMessage("Email o password errate!");
                }

            } else {
                if (count($form_errors) == 1) {
                    $result = flashMessage("È stato rilevato 1 errore nel form<br/>");
                } else {
                    $result = flashMessage('Sono stati rilevati ' . count($form_errors) . ' errori nel form<br/>');
                }
            }
        }
        require("template/base.php");
    }

?>