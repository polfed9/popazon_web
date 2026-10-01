<?php
    require_once("bootstrap.php");
    if(!isUserLoggedIn() || is_null($dbh->getInfoUser($_SESSION["email"])[0]["pIva"])){
        header("location: homeAutenticazione.php");
    }
    else {
        if($_POST["action"]==1){
            //inserisco il nuovo articolo
            $nome=$_POST["nome"];
            $numero = $_POST["numero"];
            $descrizione = $_POST["descrizione"];
            $prezzo = $_POST["prezzo"];
            $qt = $_POST["quantita"];
            $exclusive = isset($_POST["exclusive"]);
    
            if (!empty($_POST['catP'])) {
                $catP = $_POST['catP'];
                if (!empty($_POST['catS'])) {
                    $catS = $_POST['catS'];
                    if(count($dbh->getASpecificProduct($numero,$catP))==0){
                        $nomeImg = str_replace(' ', '_', $nome.$numero);
                        $nomeImg = str_replace("'", '_', $nomeImg);
                        list($result, $msg) = uploadImage(UPLOAD_DIR."Prodotti/", $_FILES["img"], $nomeImg);
                        if($result != 0){
                            $imgName = $msg;
                            $insert = $dbh->insertNewProduct($catP, $prezzo, $qt, $numero, $nome, $descrizione, $imgName, $catS, $exclusive);
                            if($insert){
                                $msg = "Prodotto inserito correttamente";
                                header("location: visualizzaProdottiVenditore.php?formsg=".$msg);
                            } 
                            else{
                                $msg = "Errore in inserimento!";
                            }
                        }
                        if($exclusive){
                            //invio la mail di un nuovo prodotto exclusive aggiunto al catalogo
                            $mittente = $_SESSION["email"];
                            $oggetto ="Nuovo prodotto";
                            $testo = $dbh->getNotificaBase($oggetto)["testo"];
                            $original = ["catP", "num", "nome"];
                            $replace = [$catP, $numero, $nome];
                            $testo = str_replace($original,$replace,$testo);
                            $preview = substr($testo, 0, 15);
                            $destinatari = $dbh->getAllClient();
                            foreach($destinatari as $destinatario){
                                if($destinatario["newsletter"]){
                                    $dbh->insertNotifica($preview, $testo, $oggetto, $destinatario["email"], $mittente);
                                }
                            }
                        }
                    } else {
                        $msg = "Errore! Prodotto già inserito";
                    header("location: gestisciProdotti.php?action=1&erroreProdotto=".$msg);
                    }
    
                } else {
                    $msg = "Errore! Selezionare una categoria";
                    header("location: gestisciProdotti.php?action=1&errCatS=".$msg);
                }
    
            } else {
                $msg = "Errore! Selezionare una categoria";
                
                header("location: gestisciProdotti.php?action=1&errCatP=".$msg);
    
            }
            
            
        }
        if ($_POST["action"] == 2) {
            //modifica di nome, prezzo, descrizione, qt e exclusive di un prodotto
            $nome=$_POST["nome"];
            $numero = $_POST["numero"];
            $descr = $_POST["descrizione"];
            $prezzo = $_POST["prezzo"];
            $qt = $_POST["quantita"];
            $oldQt = $_POST["oldQt"];
            $exclusive = isset($_POST["exclusive"]);
            $catP = $_POST['catP'];
    
            //se la quantità nuova è pari a 0  --> invia notifica di prodotto esaurito a quelli che lo avevano aggiunto al carrello.
            if($qt == 0 && $oldQt > 0){
                $mittente = $_SESSION["email"];
                $oggetto ="Terminato prodotto";
                $testo = $dbh->getNotificaBase($oggetto)["testo"];
                $original = ["catP", "num", "nome"];
                $replace = [$catP, $numero, $nome];
                $testo = str_replace($original,$replace,$testo);
                $preview = substr($testo, 0, 15);
                $destinatari = $dbh->deleteProductFromCart($numero, $catP);
                foreach($destinatari as $destinatario){
                    $dbh->insertNotifica($preview, $testo, $oggetto, $destinatario, $mittente);
                }
            }
    
            //se la quantità vecchia era pari a 0 e quella attuale è > 0 allora invia la notifica di prodotto di nuovo disponibile solo a quelli la cui newsletter è pari a true
            if($oldQt == 0 && $qt > 0 ){
                $mittente = $_SESSION["email"];
                $oggetto ="Prodotto disponibile";
                $testo = $dbh->getNotificaBase($oggetto)["testo"];
                $original = ["catP", "num", "nome"];
                $replace = [$catP, $numero, $nome];
                $testo = str_replace($original,$replace,$testo);
                $preview = substr($testo, 0, 15);
                $destinatari = $dbh->getAllClient();
                foreach($destinatari as $destinatario){
                    if($destinatario["newsletter"]){
                        $dbh->insertNotifica($preview, $testo, $oggetto, $destinatario["email"], $mittente);
                    }
                    
                }
            }
    
            if($dbh->updateProduct($nome, $prezzo, $qt, $descr, $exclusive, $numero,$catP)){
                $msg = "Prodotto modificato correttamente";
            } else{
                $msg = "Errore durante la modifica";
            }
            header("location: visualizzaProdottiVenditore.php?formsg=".$msg);
        }
    
        if ($_POST["action"] == 3) {
            //cancello l'articolo e mando la notifica ai clienti
            //rimuovo l'immagine dall'archivio delle immagini
            $catP = $_POST["catP"];
            $numero = $_POST["numero"];
            $nome = $_POST["nome"];
            unlink(UPLOAD_DIR."Prodotti/".$_POST["img"]);
            $destinatari = $dbh->deleteProductFromCart($numero, $catP);
            if(count($destinatari)>0) {
                $mittente = $_SESSION["email"];
                $oggetto ="Prodotto eliminato";
                $testo = $dbh->getNotificaBase($oggetto)["testo"];
                
                $testo = str_replace($original,$replace,$testo);
                $preview = substr($testo, 0, 15);
                foreach($destinatari as $destinatario){
                    $dbh->insertNotifica($preview, $testo, $oggetto, $destinatario, $mittente);
                }
                $msg = "Prodotto eliminato correttamente";
            } else {
                if($dbh->deleteProduct($numero, $catP)){
                    $msg = "Prodotto eliminato correttamente";
                } else{
                    $msg = "Errore durante la cancellazione";
                }
            }
            header("location: visualizzaProdottiVenditore.php?formsg=".$msg);
        }
    }
    
   
    
?>