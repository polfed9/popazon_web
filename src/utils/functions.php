<?php
    function isActive($pagename){
        if(basename($_SERVER['PHP_SELF'])==$pagename){
            echo " class='active' ";
        }
    }

    function getIdFromName($name){
        return preg_replace("/[^a-z]/", '', strtolower($name));
    }

    function isUserLoggedIn(){
        return !empty($_SESSION['email']);
    }

    function getEmptyProduct(){
        return array("catP"=>"", "prezzo"=>"", "qt"=>"", "numero"=>"", "nome"=>"", "descr"=>"", "img"=>"", "catS"=>"", "exclusive"=>false);
    }

    function getAction($action){
        $result = "";
        switch($action){
            case 1:
                $result = "Inserisci";
                break;
            case 2:
                $result = "Modifica";
                break;
            case 3:
                $result = "Cancella";
                break;
        }
    
        return $result;
    }

    function uploadImage($path, $image,$newName){
        $imageFileType = strtolower(pathinfo(basename($image["name"]),PATHINFO_EXTENSION));
        //rinomino l'immagine
        $imageName = $newName.".".$imageFileType;
        $fullPath = $path.$imageName;
        
        $maxKB = 500;
        $acceptedExtensions = array("jpg", "jpeg", "png", "gif");
        $result = 0;
        $msg = "";
        //Controllo se immagine è veramente un'immagine
        $imageSize = getimagesize($image["tmp_name"]);
        if($imageSize === false) {
            $msg .= "File caricato non è un'immagine! ";
        }
        //Controllo dimensione dell'immagine < 500KB
        if ($image["size"] > $maxKB * 1024) {
            $msg .= "File caricato pesa troppo! Dimensione massima è $maxKB KB. ";
        }
    
        //Controllo estensione del file
        if(!in_array($imageFileType, $acceptedExtensions)){
            $msg .= "Accettate solo le seguenti estensioni: ".implode(",", $acceptedExtensions);
        }
    
        //Controllo se esiste file con stesso nome ed eventualmente lo rinomino
        if (file_exists($fullPath)) {
            $i = 1;
            do{
                $i++;
                $imageName = pathinfo(basename($image["name"]), PATHINFO_FILENAME)."_$i.".$imageFileType;
            }
            while(file_exists($path.$imageName));
            $fullPath = $path.$imageName;
        }
    
        //Se non ci sono errori, sposto il file dalla posizione temporanea alla cartella di destinazione
        if(strlen($msg)==0){
            if(!move_uploaded_file($image["tmp_name"], $fullPath)){
                $msg.= "Errore nel caricamento dell'immagine.";
            }
            else{
                $result = 1;
                $msg = $imageName;
            }
        }
        return array($result, $msg);
    }

    //------------------!!!!!--------------------------HOME-AUTENTICAZIONE----------------------!!!!!---------------
    function redirectTo($page){
        header("Location: {$page}.php");
    }

    //Funzione di Singout 
    function signout(){ 
        unset($_SESSION['email']);
        session_destroy();
        session_regenerate_id(true);
        redirectTo('homeAutenticazione');
    }

//------------------!!!!!--------------------------LOGIN-------------------------!!!!!---------------

    //Crea un messagio di errore o di successo
    function flashMessage($message, $passOrFail = "Fail"){
    if($passOrFail === "Pass") {
        $data = "<div class='alert alert-success' role='alert'>{$message}"; 
    }
    else {
        $data = "<div class='alert alert-danger' role='alert'>{$message}";
    }

    return $data;
    }

    /**
     * @param $required_fields_array, n array contenente la lista di campi richiesti
     * @return array, contiene tutti  gli erorri
     */
    function check_empty_fields($required_fields_array){
        $form_errors = array();

        foreach($required_fields_array as $name_of_field){
            if(!isset($_POST[$name_of_field]) || $_POST[$name_of_field] == NULL){
                $form_errors[] = $name_of_field . " is a required field";
            }
        }
        return $form_errors;
    }

    /**
     * @param $form_errors_array, un array che contenente tutti
     * gli errori che si vogliono mostrare
     * @return string, lista contenete tutti  gli erorri
     */
    function show_errors($form_errors_array){
        $errors = "<ul>";
        foreach($form_errors_array as $the_error){
            $errors .= "<li> {$the_error} </li>";
        }
        $errors .= "</ul>";
        return $errors;
    }

    //------------------!!!!!--------------------------REGISTER-------------------------!!!!!---------------
    /*NON più utile*/
    function getEmptyUser(){
        return array("nome"=>"", "cognome"=>"", "email"=>"", "cel"=>"", "via"=>"", "numero"=>"", "citta"=>"", "provincia"=>"", "cap"=>"", "password"=>"", "newsletter"=>"0");
    }

    /**
     * @param $fields_to_check_length, un array che contenente tutti i campi
     * per cui si vuole controllare la minima lunghezza richiesta ('password' => 8)
     * @return array, contiene tutti gli errori
     */
    function check_min_length($fields_to_check_length){
        $form_errors = array();

        foreach($fields_to_check_length as $name_of_field => $minimum_length_required){
            if(strlen(trim($_POST[$name_of_field])) < $minimum_length_required){
                $form_errors[] = $name_of_field . " è troppo corta, deve essere lunga {$minimum_length_required} caratteri";
            }
        }
        return $form_errors;
    }

    function check_length_number($fields_to_check_length){
        $form_errors = array();

        foreach($fields_to_check_length as $name_of_field => $length_required){
            $sanitizeField = preg_replace('#[^0-9]#', '', $_POST[$name_of_field]);

            if(strlen(trim($sanitizeField)) < $length_required || strlen(trim($sanitizeField)) > $length_required){
                $form_errors[] = $name_of_field . " deve essere lunga {$length_required} caratteri";
            }
            if(!(strlen(trim($sanitizeField))===strlen(trim($_POST[$name_of_field]))) ){
                $form_errors[] = $name_of_field . " inseriti dei caratteri non validi";
            }
        }
        return $form_errors;
    }

    function check_length($fields_to_check_length){
        $form_errors = array();
        foreach($fields_to_check_length as $name_of_field => $length_required){
            $sanitizeField = preg_replace("/[^A-Za-z]/", '', $_POST[$name_of_field]);

            if(strlen(trim($sanitizeField)) < $length_required || strlen(trim($sanitizeField)) > $length_required){
                $form_errors[] = $name_of_field . " deve essere lunga {$length_required} caratteri";
            }
            if(!(strlen(trim($sanitizeField))===strlen(trim($_POST[$name_of_field]))) ){
                $form_errors[] = $name_of_field . " inseriti dei caratteri non validi";
            }
        }
        return $form_errors;
    }

    /* CON REQUIRE
    function check_email($data){
        //initialize an array to store error messages
        $form_errors = array();

        if($data != null){
            $email = $data;
            $clean_email = filter_var($email, FILTER_SANITIZE_EMAIL);
            //check if input is a valid email address
            if(filter_var($clean_email, FILTER_VALIDATE_EMAIL) === false){
               $form_errors[] = " l'indirizzo email non è valido";
            }
        }
        return $form_errors;
    }
    */

    function check_phoneNumbers($data){

        $form_errors = array();
        if($data != null){
            //$cel = $data;
            //$clean_cel = filter_var($cel, FILTER_SANITIZE_NUMBER_INT);
            $clean_cel = preg_replace('/[^0-9]/', '', $data);
            if(filter_var($clean_cel, FILTER_SANITIZE_NUMBER_INT) === false){
                $form_errors[] = " il numero di telefono non è valido ";
            }
        }
        
        return $form_errors;
    }






?>