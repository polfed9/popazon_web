<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    require_once("bootstrap.php");
    $email = $_SESSION["email"];

    if(isUserLoggedIn($email)) {
        $totale = $_POST["totale"];
         //vai a riepilogo ordine
        // c'è abbstaza saldo - ci sono tutti i prodotti in magazzino
        if($dbh-> getSaldoTot($email) >= $totale){
            $carrello = $dbh->getAllProductsInCart($email);
            $ordine =  $carrello[0]["numOrdine"];
            $prodottiNonDisponibili=false;
            foreach($carrello as $prodotto){
                if($dbh->getASpecificProduct($prodotto["numero"], $prodotto["catP"])[0]["qt"] < $prodotto["qt"]){
                    $prodottiNonDisponibili=true;
                } 
            }

            if($prodottiNonDisponibili){
                header("location: carrello.php?msg=prodotto-non-disponibile-in-magazzino");
            } else {

                $venditore = $dbh-> getVenditore();
                
                // ci sono tutti i prodotti --> procedo al pagamento
                $dbh-> getTotalofAOrder($email);
                $dbh-> updateAvanzamento($carrello[0]["numOrdine"] , "IN ELABORAZIONE");
                $dbh-> decrementaPortafoglio($totale, $email);
                foreach($carrello as $prodotto){
                    $dbh->updateProductQuantity($prodotto['qt'], $prodotto["numero"], $prodotto["catP"]);
                    $p = $dbh->getASpecificProduct($prodotto["numero"], $prodotto["catP"]);
                    if($p[0]["qt"]==0){
                        //informo il venditore che il prodotto è terminato
                        $oggetto = "Prodotto esaurito";
                        $testo = $dbh->getNotificaBase($oggetto)["testo"];
                        $testo = str_replace($original,$replace,$testo);
                        $preview = substr($testo, 0, 15);
                        $dbh->insertNotifica($preview, $testo, $oggetto, $venditore, $venditore);
                    }
                }

                // gestione notifiche 
                $user = $dbh->getInfoUser($email)[0];
                $oggetto ="Nuovo ordine";
                $testo = $dbh->getNotificaBase($oggetto)["testo"];
                $original = ["numOrdine", "infoCliente", "listaProdotti", "tot"];

                $infoCliente = "
                    nome: ".$user["nome"]." <br/>
                    cognome: ".$user["cognome"]." <br/>
                    cellulare: ".$user["cel"]." <br/>
                    citta: ".$user["citta"]." <br/>
                    via: ".$user["via"]." numero:".$user["numero"]." <br/>
                    cap: ".$user["cap"]." <br/>
                    provincia: ".$user["provincia"]." <br/>
                ";
            
                $carrello = $dbh->getProductSpecificOrder($ordine);
                $listaProdotti = "<br/>"; 
                foreach($carrello as $key=>$prodotto){
                    $prod = "nome: ".$prodotto["nome"]." quantità: ".$prodotto["qt"]." <br/>";
                    $listaProdotti = $listaProdotti.$prod;
                }

                $replace = [$ordine, $infoCliente, $listaProdotti, $totale];
                $testo = str_replace($original,$replace,$testo);
                $preview = substr($testo, 0, 15);
                
                $dbh->insertNotifica($preview, $testo, $oggetto, $venditore, $email);
                $dbh->insertNotifica($preview, $testo, $oggetto, $email, $venditore);

                header("location: profile.php");
            }
            
        } else {
            header("location: carrello.php?msg=credito-non-disponibile");
        }
            
    } else {
        header("location: homeAutenticazione.php");
    }
