<?php
require_once("bootstrap.php");
//decommenta dopo aver fatto il login per il venditore
if (!isUserLoggedIn() || is_null($dbh->getInfoUser($_SESSION["email"])[0]["pIva"])) {
    $response = json_encode(array('msg' => "0", 'location' => "homeAutenticazione.php"));
    header('Content-Type: application/json');
} else {
    $msg = "";
    if ($_POST["bt"] == "avanza") {
        $nuovoStato = $dbh->getNextStato($_POST["oldStato"]);
        if ($dbh->updateAvanzamento($_POST["ordine"], $nuovoStato["nuovoStato"])) {
            $msg = "Stato aggiornato correttamente";
        } else {
            $msg = "Errore nell'aggiornamento dello stato.";
        }
    }
    if ($_POST["bt"] == "annulla") {
        //in questo caso permette di tornare indietro di uno stato eccetto che per "in elaborazione"
        //quindi elimina dalla tab avanzamento l'ordine con id = oldStato
        $msg = $dbh->deleteLastStato($_POST["ordine"]);
    }

    $response = json_encode(array('msg' => $msg, 'stato' => $dbh->getLastStatoOrdine($_POST["ordine"])["nome"]));
    header('Content-Type: application/json');
    echo $response;
}
