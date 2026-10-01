<?php
require_once ('bootstrap.php');
//check della sessione 
if(!isUserLoggedIn() || is_null($dbh->getInfoUser($_SESSION["email"])[0]["pIva"])){
    $response = json_encode( array( 'err' => "0", 'location' => "homeAutenticazione.php"));
    header('Content-Type: application/json');
    echo $response;
} else {

    $action =$_POST["action"];
    $msg="";
    //se non c'è la categoria specifica allora sto lavorando sul solo panel della categoria principlale
    if(!isset($_POST["catS"])){
        $catP =$_POST["catP"];
        if($action=="modifica"){
            $cod = $dbh->updateCatP($_POST["catPold"], $catP);
            $msg = $cod ? "Modifica avvenuta con successo" : "Errore nella modifica";
        } elseif ($action =="elimina") {
            $cod = $dbh->deleteCatP($catP);
            $msg = $cod ? "Cancellazione avvenuta con successo" : "Errore nella cancellazione";
        } elseif($action =="aggiungi"){
            $categoryPresent = false;
            foreach($dbh->getCatP() as $category){
                if($category["titolo"] == $catP){
                    $categoryPresent = true;
                }
            }
            if ($categoryPresent) {
                $cod = 0;
                $msg = "Errore categoria principale già inserita";
            } else {
                $cod = $dbh->insertNewCatP($catP);
                $msg = $cod ? "Inserimento avvenuto con successo" : "Errore nell'inserimento";
            }
            
        } else {
            $cod = 0;
            $msg ="ERRORE";
        }

    } else {
        $catS = $_POST["catS"];
        if($action=="modifica"){
            $cod = $dbh->updateCatS($_POST["catSold"], $catS);
            $msg = $cod ? "Modifica avvenuta con successo" : "Errore nella modifica";
        } elseif ($action =="elimina") {
            $cod = $dbh->deleteCatS($catS);
            $msg = $cod ? "Cancellazione avvenuta con successo" : "Errore nella cancellazione";
        } elseif($action =="aggiungi"){
            $categoryPresent = false;
            foreach($dbh->getAllCatS() as $category){
                if($category["titolo"] == $catS){
                    $categoryPresent = true;
                }
            }
            if ($categoryPresent) {
                $cod = 0;
                $msg = "Errore categoria specifica già inserita";
            } else {
                $cod = $dbh->insertNewCatS($_POST["catP"],$catS);
                $msg = $cod ? "Inserimento avvenuto con successo" : "Errore nell'inserimento";
            }
        } else {
            $cod = 0;
            $msg ="ERRORE";
        }
    }

    header('Content-Type: application/json');
    echo json_encode(array("err"=> "1", "cod"=> $cod, "msg" =>$msg));
}
?>