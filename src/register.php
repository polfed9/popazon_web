<?php
    require_once("bootstrap.php");
    $templateParams["nome"] = "template/register.php";
    $templateParams["azione"] = $_GET["action"];
    if(isset($_SESSION['email']) && $_SESSION['email'] === $dbh->getVenditore()){
        $templateParams["venditore"] = "venditore";
    }
    if($_GET["action"]==1){
        //process the form 
        $templateParams["user"] = getEmptyUser();

        if(isset($_POST['registerBtn'])){
            $form_errors = array();
            $fields_to_check_min_length = array('password' => 8);
            $form_errors = array_merge($form_errors, check_min_length($fields_to_check_min_length));

            $fields_to_check_length = array('cel' => 10, 'cap'=>5);
            $form_errors = array_merge($form_errors, check_length_number($fields_to_check_length));

            $fields_to_check_length = array('prov' => 2);
            $form_errors = array_merge($form_errors, check_length($fields_to_check_length));
            $form_errors = array_merge($form_errors, check_phoneNumbers($_POST['cel']));

            if($dbh->checkDuplicateEntries($_POST['email'])){
                $result = flashMessage("È già registrato con questo indirizzo email!");

            } else if($_POST["password"] != $_POST["confirmPassword"]){
                $result = flashMessage("Registrazione - Le password non corrispondono!");

            }else if(empty($form_errors)){

                $email = $_POST['email'];
                $password = $_POST['password'];
                $phone = $_POST['cel'];
                $prov = $_POST['prov'];
                $cap = $_POST['cap'];
                $news = isset($_POST['newsletter']) ? true : false;

                $signup_result = $dbh->insertClient($_POST["email"], $_POST["password"],$_POST["nome"],$_POST["cognome"],$_POST["cel"],$_POST["prov"],$_POST["cap"],$_POST["nCivic"],$_POST["via"],$_POST["citta"],$news);
                if($signup_result==false){
                    $result = flashMessage("C'è stato un errore nell'inserimento dell'utente nel database ");
                }
                
                // gestione notifiche 
                $user = $dbh->getInfoUser($email)[0];
                $oggetto ="Nuovo cliente";
                $testo = $dbh->getNotificaBase($oggetto)["testo"];
                $original = ["infoCliente"];

                $infoCliente = $user["nome"]." ".$user["cognome"]." </br>";
            
                $replace = [$infoCliente];
                $testo = str_replace($original,$replace,$testo);
                $preview = substr($testo, 0, 15);
                $venditore = $dbh->getVenditore();
                $dbh->insertNotifica($preview, $testo, $oggetto, $venditore, $email);

                $result = flashMessage("Registrazione avvenuta correttamente!");
                $templateParams["nome"] = "template/homeAutenticazione.php";

            }else {
                if(count($form_errors) == 1){
                    $result = flashMessage("Riscontrato un 1 errore nel form<br>");
                }
                else {
                    $result = flashMessage("Riscontrati " .count($form_errors). " errori nel form<br>");
                }
            }
        }
    }else { // action=2
        $templateParams["user"] = $dbh->getInfoUser($_SESSION['email'])[0];

        if(isset($_POST['registerBtn'])){
            
            $form_errors = array();
            $fields_to_check_length = array('cel' => 10, 'cap'=>5);
            $form_errors = array_merge($form_errors, check_length_number($fields_to_check_length));

            $fields_to_check_length = array('prov' => 2);
            $form_errors = array_merge($form_errors, check_length($fields_to_check_length));
            $form_errors = array_merge($form_errors, check_phoneNumbers($_POST['cel']));
            
            if(empty($form_errors)){
                $nome = $_POST['nome'];
                $cognome = $_POST['cognome'];
                $phone = $_POST['cel'];
                $prov = $_POST['prov'];
                $cap = $_POST['cap'];
                $via = $_POST['via'];
                $citta = $_POST['citta'];
                $num = $_POST['nCivic'];
                $newsletter = isset($_POST['newsletter']) ? true : false;

                $edit_result = $dbh->updateInfoUser($_SESSION['email'], $phone, $prov, $cap, $num, $via, $citta, $newsletter, $cognome, $nome);
                if($edit_result){
                    $result = flashMessage("Utente modificato correttamente!");
                    $templateParams["nome"] = "template/homeAutenticazione.php";
                }else{
                    $result = flashMessage("Errore durante la modifica!");
                }
                
            }else {
                if(count($form_errors) == 1){
                    $result = flashMessage("Riscontrato un 1 errore nel form<br>");
                }
                else {
                    $result = flashMessage("Riscontrati " .count($form_errors). " errori nel form<br>");
                }
            }
        }
    }
    require("template/base.php");
?>