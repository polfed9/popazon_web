<?php
    session_start();
    require_once("utils/functions.php");
    require_once("db/database.php");
    require_once("utils/readConfig.php");
    $readConf = new ReadConfig();
    $dbh = new DatabaseHelper($readConf->getServername(), 
                                $readConf->getUsername(), 
                                $readConf->getPassword(),
                                $readConf->getDbName(),
                                $readConf->getPort());

    define("ROOT_PATH", "/popazon/POPazon_Progetto/php");
    define("CSS_DIR", ROOT_PATH . "/css");
    define("JS_DIR", ROOT_PATH . "/js");
    define("UPLOAD_DIR","upload/");
?>