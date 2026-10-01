<?php
    class DatabaseHelper{
        private $db;
        private $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';

        public function __construct($servername, $username, $password, $dbname, $port){
            $this->db = new mysqli($servername, $username, $password, $dbname, $port);
            if($this->db->connect_error){
                die("Connesione fallita al db");
            }
        }

        private function getLastIdOrder($email){
            $query = "SELECT MAX(num)
                        FROM ordine
                        WHERE compratore = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            return $stmt->get_result()->fetch_all()[0][0];
        }

        public function getOrdiniBozzaFromUser($email) {
            $query = "SELECT ordine 
                    FROM avanzamento 
                    JOIN ordine ON ordine = num
                    JOIN persona ON compratore = email
                    JOIN stato ON avanzamento.stato = stato.id
                    WHERE email = ?
                    AND stato.nome = 'BOZZA' 
                    HAVING (SELECT count(*) FROM avanzamento WHERE ordine = num) <=1
                    ORDER BY ordine DESC 
                    LIMIT 1";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            return $stmt->get_result()->fetch_all();
        }

//--------------------------------------------------prodotti-----------------------------------------------------------

        public function getExclusiveProducts(){
            $query = "SELECT * 
                        FROM `prodotto` 
                        WHERE exclusive = true";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public function getAvailableProducts(){
            $query = "SELECT * 
                        FROM `prodotto` 
                        WHERE qt > 0";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }


        public function getProductByName($nome){
            $likeString = '%' . $nome . '%';
            $query = "SELECT * 
                        FROM `prodotto` 
                        WHERE nome LIKE ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s", $likeString);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public function getProductById($numero, $catP){
            $query = "SELECT * 
                        FROM `prodotto` 
                        WHERE numero = ?
                        AND catP = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("is", $numero, $catP);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public function getRandomProduct($catP, $count){
            $query = "SELECT *
                        FROM `prodotto` 
                        WHERE catP = ?
                        ORDER BY RAND() LIMIT ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('si',$catP, $count);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        /**get all products of a category P */
        public function getProductsByCatP($catP){
            $query = "SELECT * 
                        FROM `prodotto` 
                        WHERE catP = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s", $catP);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        /**get all products of a category P & category S */
        public function getProductsByCatPS($catP, $catS){
            $query = "SELECT * 
                        FROM `prodotto` 
                        WHERE catP = ?
                        AND catS = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ss", $catP, $catS);
            $stmt->execute();
            return $stmt->get_result()->fetch_all();
        }

        /**get all products of a category P & price*/
        public function getProductsByCatPandPrice($catP, $price){
            $query = "SELECT * 
                        FROM `prodotto` 
                        WHERE catP = ? 
                        AND prezzo <= ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("sd", $catP, $price);
            $stmt->execute();
            return $stmt->get_result()->fetch_all();
        }

        /**get all products with all filter*/
        public function getProductsWithAllFilter($catP, $catS, $price){
            $query = "SELECT * 
                        FROM `prodotto` 
                        WHERE catP = ?
                        AND catS = ? 
                        AND prezzo <= ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ssd", $catP, $catS, $price);
            $stmt->execute();
            return $stmt->get_result()->fetch_all();
        }

//--------------------------------------------------categorie-----------------------------------------------------------

        public function getCategoryProdQt(){
            $query = "SELECT catP, SUM(qt) as qt
                        FROM prodotto 
                        GROUP BY catP";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public function getExcCatSquantity($exc){
            $query = "SELECT catS, SUM(qt) as qt
                        FROM prodotto 
                        WHERE exclusive = ?
                        GROUP BY catS";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("i", $exc);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public function getCatSquantity(){
            $query = "SELECT catS, SUM(qt) as qt
                        FROM prodotto 
                        GROUP BY catS";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }


        public function getCatP(){
            $query = "SELECT *
                    FROM categoria_principale
                    ORDER BY titolo";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public function getCatS($catP){
            $query = "SELECT *
                    FROM prodotto
                    WHERE catP = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s", $catP);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public function getAllCatSofCatP($catP){
            $query = "SELECT *
                    FROM categoria_specifica
                    WHERE titoloP = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s", $catP);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public function getCatSFromSelectedCatP($catP){
            $query = "SELECT catS, SUM(qt) as qt
                      FROM prodotto 
                      WHERE catP = ?
                      GROUP BY catS";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s", $catP);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public function getAllCatS(){
            $query = "SELECT *
                    FROM categoria_specifica
                    ORDER BY titolo";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public function getASpecificProduct($num, $catP){
            $query = "SELECT catP, prezzo, qt, numero, nome, descr, img, catS, exclusive
                    FROM prodotto
                    WHERE numero = ? 
                    AND catP = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("is",$num, $catP);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        //--------------------------------------------------carrello-ordine-----------------------------------------------------------

        public function insertIntoOrdine($email, $catP, $numProdotto ,$qt){
            /* Se l'utente ha un ordine che è in stato = Bozza ovvero non è ancora stato pagato  
             * i prodotti che aggiunge al carrello avranno come numero ordine quello, 
             * se il cliente invece non ha nessun ordine in stato "bozza" allora crea un nuovo numero ordine, 
             * associalo all'utente e inserisci i prodotti nel carrello con quell'ordine
             * */

            //prima cosa verifica se l'utente ha un ordine in stato bozza
            $numOrdine = $this->getOrdiniBozzaFromUser($email);
            if (count($numOrdine) == 0){
                $totale = 0.0;
                //non è presente alcun odine in stato di bozza quindi  creo un nuovo ordine e lo aggiungo anche ad avanzamento
                $query = "INSERT INTO `ordine`(`totale`, `compratore`) VALUES (?,?)";
                $stmt = $this->db->prepare($query);
                $stmt->bind_param("ds",$totale, $email);
                if ($stmt->execute()){
                    //inserisco in avanzamento
                    $newIdO = $this->getLastIdOrder($email);
                    if (!$this->updateAvanzamento($newIdO, 'BOZZA')){
                        return false;
                    }
                    $numOrdine = $newIdO;
                }                
            } else {
                $numOrdine = $numOrdine[0][0];
            }
            //inserisco il prodotto nel carrello
            $query = "INSERT INTO `carrello`(`numOrdine`, `catP`, `numero`, `qt`) VALUES (?,?,?,?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("isii",$numOrdine, $catP, $numProdotto, $qt);
            return $stmt->execute();
        }


        public function getProductQuantity($email, $catP, $numProdotto){
            if(empty($this->getOrdiniBozzaFromUser($email))){
                return array();
            }
            $numOrdine = $this->getOrdiniBozzaFromUser($email)[0][0];
            $query = "SELECT qt 
                    FROM `carrello` 
                    WHERE numOrdine = ? 
                    AND numero = ? 
                    AND catP = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("iis", $numOrdine, $numProdotto, $catP);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public function updateCarrello($email, $catP, $numProdotto ,$qt){
            $numOrdine = $this->getOrdiniBozzaFromUser($email)[0][0];//
            //se la quantità del prodotto è pari a zero allora rimuovo il prodotto dal carrello
            if ($qt == 0){
                $query = "DELETE FROM `carrello` 
                    WHERE numOrdine = ? 
                    AND numero = ? 
                    AND catP = ?";
                $stmt = $this->db->prepare($query);
                $stmt->bind_param("iis", $numOrdine, $numProdotto, $catP);
                return $stmt->execute();

            } else {
                //altrimenti modifico solo la quantità
                $query = "UPDATE `carrello` 
                            SET `qt`= ? 
                            WHERE numOrdine = ? 
                            AND numero = ? 
                            AND catP = ?";
                $stmt = $this->db->prepare($query);
                $stmt->bind_param("iiis",$qt, $numOrdine, $numProdotto, $catP);
                return $stmt->execute();
            }
        }

        public function getAllProductsInCart($email){
            if(empty($this->getOrdiniBozzaFromUser($email))){
                return array();
            }
            $numOrdine = $this->getOrdiniBozzaFromUser($email)[0][0];
            $query = "SELECT * 
                        FROM carrello
                        WHERE numOrdine = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("i",$numOrdine);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }
        
        public function getTotalofAOrder($email){
            $total = 0;
            $productsInCart = $this->getAllProductsInCart($email);
            foreach($productsInCart as $prod){
                $query = "SELECT prezzo 
                        FROM prodotto
                        WHERE numero = ?
                        AND catP = ?";
                $stmt = $this->db->prepare($query);
                $stmt->bind_param("is",$prod["numero"], $prod["catP"]);
                $stmt->execute();
                $total = $total + $prod["qt"] * mysqli_fetch_array($stmt->get_result(),MYSQLI_NUM)[0];
            }
            if ($total !== 0){
                //memorizzo il totale nel db
            $query = " UPDATE `ordine` SET `totale`= ? WHERE num = ? ";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("di",$total, $this->getAllProductsInCart($email)[0]["numOrdine"]);
            $stmt->execute();
            } 
            return $total;
        }

        //--------------------------------------------------portafoglio-----------------------------------------------------------

        public function getSaldoTot($email){
            $query = "SELECT saldo 
                    FROM portafoglio
                    WHERE proprietario = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            return mysqli_fetch_array($stmt->get_result(),MYSQLI_NUM)[0];
        }

        public function incrementaPortafoglio($importo, $email){
            $query = "SELECT id FROM portafoglio WHERE proprietario = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s",$email);
            if ($stmt->execute()){
                $portafoglio = $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]["id"];

                $data = date("Y-m-d");
                $query="INSERT INTO `ricarica`(`data`, `importo`, `portafoglio`) VALUES (?,?,?)";
                $stmt = $this->db->prepare($query);
                $stmt->bind_param("sii", $data,$importo, $portafoglio);
                if($stmt->execute()){
                    $query = "UPDATE `portafoglio` SET saldo=saldo+? WHERE proprietario = ?";
                    $stmt = $this->db->prepare($query);
                    $stmt->bind_param("is", $importo, $email);
                    return $stmt->execute();
                }
            }
            return false;
        }

        public function decrementaPortafoglio($importo, $email){
            $saldo = $this->getSaldoTot($email) - $importo;
            $query = "UPDATE portafoglio 
                    SET saldo=? 
                    WHERE proprietario = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ds", $saldo, $email);
            return $stmt->execute();
        }

        public function getPortafoglioMovement($email){
            //prendo prima tutti i pagamenti totale e data (=a quando viene eleaborato l'ordine)
            $query = "SELECT num as oggetto, totale as importo, DATE(data) as dataP
                        FROM ordine 
                        JOIN avanzamento 
                        ON num = ordine 
                        JOIN stato ON avanzamento.stato = stato.id 
                        WHERE stato.nome = 'IN ELABORAZIONE' 
                        AND compratore = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s",$email);
            $stmt->execute();
            $pagamenti = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            //aggiungo il - davanti agli importi dei pagamenti
            //& permette di modificare l'array
            foreach ($pagamenti as &$pagamento){
                $pagamento["oggetto"] = "pagamento ordine n." . $pagamento["oggetto"];
                $pagamento["importo"] = "-".$pagamento["importo"];
            }

            //prendo tutte le ricarice con le rispettive date
            $query = "SELECT importo, data as dataP 
                        FROM ricarica 
                        JOIN portafoglio ON ricarica.portafoglio = portafoglio.id
                        WHERE proprietario = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s",$email);
            $stmt->execute();
            $ricariche = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            foreach ($ricariche as &$ricarica){
                $ricarica += ["oggetto" => "ricarica"];
            }

            //unisco i due array e li ordino per data
            $riepilogo = array_merge($pagamenti, $ricariche);
            usort($riepilogo, function($a, $b) {
                return ($a['dataP'] < $b['dataP']) ? 1 : -1;
              });
            return $riepilogo;
        }

        //--------------------------------------------------notifiche-----------------------------------------------------------


        public function insertNotifica($preview, $testo, $oggetto, $destinatario, $mittente){
            $data = date("Y-m-d");
            //stato = 0 --> notifica non aperta
            $query = "INSERT INTO `notifica`(`data`, `stato`, `preview`, `testo`, `oggetto`, `destinatario`, `mittente`) 
                        VALUES (?,0,?,?,?,?,?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ssssss", $data, $preview, $testo, $oggetto, $destinatario, $mittente);
            return $stmt->execute();
        }

        public function getNotifiche($email){
            $query = "SELECT * FROM notifica WHERE destinatario = ? ORDER BY `data` DESC";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s",$email);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public function updateStatoNotifica($id){
            //stato = 1 --> notifica aperta;
            $query = "UPDATE `notifica` SET `stato`=1 WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("i",$id);
            return $stmt->execute();
        }

        public function getNewNotifiche($email){
            $query = "SELECT * FROM notifica WHERE destinatario = ? and stato = 0";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s",$email);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public function getNotifichaById($id){
            $query = "SELECT * FROM notifica WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("i",$id);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0];
        }

        //--------------------------------------------------venditore-Prodotti----------------------------------------------------------

        public function getAllProducts(){
            $query = "SELECT * FROM prodotto ORDER BY nome";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public function insertNewProduct($catP, $prezzo, $qt, $num, $nome, $descr, $imgName, $catS, $exclusive){
            //verifico che non sia già stato inserito un prodotto con quella categoria e numero
                if(count($this->getASpecificProduct($num,$catP))==0){
                    $exclusive = intval($exclusive);
                    //inserisco il nuovo prodotto
                    $query = "INSERT INTO `prodotto`(`catP`, `prezzo`, `qt`, `numero`, `nome`, `descr`, `img`, `catS`, `exclusive`) 
                    VALUES (?,?,?,?,?,?,?,?,?)";
                    $stmt = $this->db->prepare($query);
                    $stmt->bind_param("sdiissssi",$catP, $prezzo, $qt, $num, $nome, $descr, $imgName, $catS, $exclusive);
                    return $stmt->execute();
                }
            return false;
        }

        public function updateProduct($nome, $prezzo, $qt, $descr, $exclusive, $numero,$catP){
            $exclusive = intval($exclusive);
            $query = "UPDATE `prodotto` 
                        SET `nome`=?, `prezzo`=?,`qt`=?, `descr`=?, `exclusive`=?
                        WHERE numero = ? 
                        AND catP = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("sdisiis",$nome, $prezzo, $qt, $descr,$exclusive, $numero,$catP);
            return $stmt->execute();
        }

        public function updateProductQuantity($qt, $numero, $catP){
            $query = "UPDATE `prodotto` 
                        SET `qt`= `qt`-?
                        WHERE numero = ? 
                        AND catP = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("iis", $qt, $numero,$catP);
            return $stmt->execute();
        }

        public function deleteProductFromCart($numero, $catP){
            //restituisco tutti gli utenti a cui è stato eliminato il prodotto dal carrello
            //seleziono i compratori a cui dovrò mandare la notifica
            $result = array();
            foreach($this->getAllClient() as $compratore){
                $ordine = $this->getOrdiniBozzaFromUser($compratore["email"]);
                if(count($ordine) == 1){
                    $query = "SELECT * 
                        FROM carrello 
                        JOIN ordine ON numOrdine = num
                        WHERE numero = ?
                        AND catP = ?
                        AND numOrdine = ?";
                    $stmt = $this->db->prepare($query);
                    $stmt->bind_param("isi", $numero, $catP, $ordine[0][0]);
                    $stmt->execute();
                    $res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                    if (count($res)>=1){
                        $query = "DELETE FROM `carrello` 
                                    WHERE numero = ?
                                    AND catP = ?
                                    AND numOrdine=?";
                        $stmt = $this->db->prepare($query);
                        $stmt->bind_param("isi",$numero, $catP, $ordine[0][0]);
                        $stmt->execute();
                        
                        array_push($result, $compratore["email"]);
                    }
                }
            }
            return $result;
            
        }

        public function deleteProduct($numero, $catP){
            $query = "DELETE FROM `prodotto`
                        WHERE numero = ?
                        AND catP = ? ";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("is",$numero, $catP);
            return $stmt->execute();
        }
        
//--------------------------------------------------venditore-categorie----------------------------------------------------------

        //insert new catS and catP
        public function insertNewCatP($catP){
            $query = "INSERT INTO categoria_principale(titolo) VALUES (?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s", $catP);
            return $stmt->execute();
        }

        public function insertNewCatS($catP, $catS){
            $query = "INSERT INTO categoria_specifica(titolo, titoloP) VALUES (?,?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ss", $catS,$catP);
            return $stmt->execute();
        }

        public function updateCatP($old, $new){
            $query = "UPDATE categoria_principale
                        SET titolo = ?
                        WHERE titolo = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ss", $new, $old);
            return $stmt->execute();
        }

        public function updateCatS($old, $new){
            $query = "UPDATE categoria_specifica
                        SET titolo = ?
                        WHERE titolo = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ss", $new, $old);
            return $stmt->execute();
        }

        public function deleteCatP($cat){
            $query = "DELETE FROM categoria_principale
                        WHERE titolo = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s", $cat);
            return $stmt->execute();
        }

        public function deleteCatS($cat){
            $query = "DELETE FROM categoria_specifica
                        WHERE titolo = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s", $cat);
            return $stmt->execute();
        }

//--------------------------------------------------venditore-ordini----------------------------------------------------------

        public function getStatoOrdini() {
            $query = "SELECT * FROM stato WHERE nome != 'BOZZA'";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public function getOrdini() {
            //seleziono per ogni ordine lo stato attuale e la sua data dello stato ???
            $query = "SELECT ordine, `data`,  max(stato) as id
                        FROM avanzamento
                        JOIN stato ON avanzamento.stato = stato.id
                        WHERE nome != 'BOZZA'
                        GROUP BY ordine";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public function getLastIdStato(){
            //il massimo id corrisponde all'ultimo stato che un ordine può avere(in questo caso consegnato)
            $query = "SELECT max(id) as consegnato
                        FROM stato";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0];
        }

        public function deleteLastStato($ordine){
            $query = "SELECT max(stato) as statoToDelete
                    FROM avanzamento 
                    WHERE ordine = ? 
                    AND stato != (SELECT min(id)+1 FROM stato) 
                    AND stato != (SELECT min(id) FROM stato)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("i", $ordine);
            $stmt->execute();
            $id = $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0];
            if(!empty($id["statoToDelete"])){
                //ho trovato una riga da cancellare
                $query = "DELETE FROM `avanzamento` WHERE stato = ? and ordine = ?";
                $stmt = $this->db->prepare($query);
                $stmt->bind_param("ii", $id["statoToDelete"], $ordine);
                if($stmt->execute()){
                    return "Stato ordine aggiornato correttamente.";
                } 
                return "Errore nell'aggiornamento dello stato.";
            }
            return "Lo stato dell'ordine non può essere aggiornato ulteriormente, in quanto arrivato allo stato minimo.";
        }

        public function getLastStatoOrdine($ordine){
            $query = "SELECT nome
                        FROM stato
                        WHERE id = (SELECT MAX(stato) FROM avanzamento WHERE ordine = ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("i", $ordine);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0];
        }

        public function updateAvanzamento($ordine,$stato){
            $date = date("Y-m-d h:i:s");
            $stmt = $this->db->prepare("SELECT id FROM stato WHERE nome = ?");
            $stmt->bind_param("s", $stato);
            $stmt->execute();
            $stato = $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]["id"];
            $query = "INSERT INTO `avanzamento`(`stato`, `ordine`, `data`) VALUES (?,?,?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("iis",$stato,$ordine, $date);
            return $stmt->execute();
        }

        public function getAllClient(){
            $query = "SELECT email, newsletter 
                        FROM persona
                        WHERE pIva IS NULL";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }
        
        public function getVenditore(){
            $query = "SELECT email 
                        FROM persona
                        WHERE pIva IS NOT NULL";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]["email"];
        }

        public function getNotificaBase($oggetto){
            $query = "SELECT `testo` 
                    FROM `notifica_base` 
                    WHERE oggetto = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s",$oggetto);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0];        
        }

        //------------------!!!!!--------------------------AUTENTICAZIONE-------------------------!!!!!---------------

        //Check if cookie used is the same as the encrypted one
        public function isCookieValid(){
            $isValid = false;

            if(isset($_COOKIE['rememberUserCookie'])){
                //Decode cookies and extract user ID

                $decryptCookieData = base64_decode($_COOKIE['rememberUserCookie']);
                $user_id = explode('Qauteh9q5y4smqtstemLOQDT', $decryptCookieData);
                $userID = $user_id[1];

                //Check if ID retrieved from the cookie exists in the DB
                $query = "SELECT * FROM users WHERE id = :id";
                $stmt = $this->db->prepare($query);
                $stmt->execute(array(':id'=> $userID));

                if($row = $stmt->fetch()){
                    $id = $row['id'];
                    $username = $row['username'];

                    //Create user session
                    $_SESSION['id'] = $id;
                    $_SESSION['username'] = $username;
                    $isValid = true;
                }
                else {
                //Cookie ID is invalid destroy session and log out the user
                $isValid = false;
                signout();
                }
            }
            //return false;
            return $isValid;
        }

        public function checkLogin($email, $pw){

            $stmt = $this->db->prepare("SELECT salt FROM persona WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $salt = $stmt ->get_result()->fetch_all();
            if(count($salt)==1) {
                $salt = $salt[0][0];
                $pw =  hash('md2', $pw.$salt);
                $stmt = $this->db->prepare("SELECT * FROM persona WHERE email = ? AND pw = ?");
                $stmt->bind_param("ss", $email, $pw);
                $stmt->execute();
                $result = $stmt->get_result();
                return $result->fetch_all(MYSQLI_ASSOC);
            }
            return $salt; //lo sfrutto perchè ritorna un array associativo vuoto
        }

        public function insertClient($email, $pw, $nome, $cognome, $cel, $prov, $cap, $num, $via,  $citta, $newsletter){
            $salt = substr(str_shuffle($this->permitted_chars), 0, 4);
            $pw = hash('md2', $pw.$salt);
            //check se l'utente è già registrato
            $stmt = $this->db->prepare("SELECT * FROM persona WHERE email =?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            if (count($result)==0) {
                $newsletter = intval($newsletter);
                $query = "INSERT INTO `persona`(`email`, `pw`, `nome`, `cognome`, `cel`, `salt`, `provincia`, `cap`, `numero`, `via`, `citta`, `newsletter`, `pIva`) 
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,NULL)";
                $stmt = $this->db->prepare($query);
                $stmt->bind_param("ssssissiissi",$email, $pw, $nome, $cognome, $cel, $salt, $prov, $cap, $num, $via, $citta, $newsletter);
                if($stmt->execute()){
                    //aggiungo il saldo iniziale relativo all'utente
                $saldo = 0.0;
                $query = "INSERT INTO `portafoglio`(`proprietario`, `saldo`) VALUES (?,?)";
                $stmt = $this->db->prepare($query);
                $stmt->bind_param("sd",$email, $saldo);
                return $stmt->execute();
                }
            }
            return false;
        }
    //------------------!!!!!--------------------------PROFILO-------------------------!!!!!---------------
        
        public function getInfoUser($email){
            $stmt = $this->db->prepare("SELECT `email`, `nome`, `cognome`, `cel`, `provincia`, `cap`, `numero`, `via`, `citta`, `newsletter`, `pIva`
                                        FROM persona 
                                        WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function updateInfoUser($email, $cel, $prov, $cap, $num, $via, $citta, $newsletter, $nome, $cognome){
            $newsletter = intval($newsletter);
            $query = "UPDATE `persona` 
                    SET `cel`=?,`provincia`=?, `cap`= ?,`numero`=?,`via`=?,`citta`=?,`newsletter`=?, `nome`=?, `cognome`=?
                    WHERE email = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("isiississs", $cel, $prov, $cap, $num, $via, $citta, $newsletter, $nome, $cognome, $email);
            return $stmt->execute();
        }

    //------------------!!!!!--------------------------REGISTRAZIONE-------------------------!!!!!---------------
    // "users", "username", $username)){
        //Check for duplicate entries
        public function checkDuplicateEntries($value){
            try {
                $query = "SELECT * FROM persona WHERE email = ?";
                $stmt = $this->db->prepare($query);
                $stmt->bind_param("s", $value);
                $stmt->execute();

                //check for return row
                if($row = $stmt->fetch()){
                    return true;
                }
                return false;
            }
            catch(PDOException $ex){
                //Handle exception 
            }
        }
    //------------------!!!!!--------------------------ORDINI UTENTE-------------------------!!!!!---------------

        public function getInfoBaseOrdini($email) {
            //seleziono per ogni ordine la data in cui è stato effettuto l'ordine , il totale e il numero dell'ordine
            $query = "  SELECT num as ordine, totale, data 
                        FROM ordine 
                        JOIN avanzamento 
                        ON num = ordine 
                        JOIN stato ON avanzamento.stato = stato.id 
                        WHERE stato.nome = 'IN ELABORAZIONE' 
                        AND compratore = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public function getTrackSpecificOrder($ordine) {
            $query = "  SELECT `data`, nome
                        FROM avanzamento
                        JOIN stato ON avanzamento.stato = stato.id
                        WHERE nome != 'BOZZA'
                        AND ordine = ?;";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("i", $ordine);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public function getProductSpecificOrder($ordine) {
            $query = 'SELECT p.nome AS nome, p.prezzo as prezzo, c.qt as qt 
                FROM carrello AS c 
                JOIN prodotto AS p 
                ON p.numero = c.numero AND p.catP = c.catP 
                WHERE numOrdine = ?';
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("i",$ordine);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }
        

        public function getStatoSpecificOrder($ordine) {
            $query = "  SELECT max(nome) as stato
                        FROM avanzamento
                        JOIN stato ON avanzamento.stato = stato.id
                        WHERE nome != 'BOZZA'
                        AND ordine = ?;";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("i", $ordine);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0];
        }

        public function getStatiMancantiOrdine($ordine){
            $query = "SELECT GROUP_CONCAT(nome) as statiMancanti
                FROM stato
                WHERE id NOT IN( SELECT stato FROM avanzamento WHERE ordine = ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("i", $ordine);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0];
        }

        public function getNextStato($prevStato){
            $query = "SELECT nome as nuovoStato
                FROM stato
                WHERE id = ( SELECT id FROM stato WHERE nome = ?) + 1";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s", $prevStato);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0];
        }
    /* SI PUO CANCELLARE ??
        public function getAllProductsInCart2($email){
            if(empty($this->getOrdiniBozzaFromUser($email))){
                return array();
            }
            $numOrdine = $this->getOrdiniBozzaFromUser($email)[0][0];
            $query = "SELECT *
                        FROM carrello
                        JOIN prodotto ON carrello.catP = prodotto.catP AND carrello.numero = prodotto.numero
                        WHERE numOrdine = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("i",$numOrdine);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }*/

        public function getAllProductsInCart3($email){
            if(empty($this->getOrdiniBozzaFromUser($email))){
                return array();
            }
            $numOrdine = $this->getOrdiniBozzaFromUser($email)[0][0];
            $query = 'SELECT concat(p.catP,"_", p.numero) as item_id, p.nome AS item_nome, p.prezzo as item_prezzo, p.img AS item_img, c.qt as item_quantita 
                FROM carrello AS c JOIN prodotto AS p ON p.numero = c.numero AND p.catP = c.catP 
                WHERE numOrdine = ?';
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("i",$numOrdine);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }
        /*
    */
}

?>