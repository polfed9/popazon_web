<?php
require_once ('bootstrap.php');
$categorie = $dbh->getAllCatSofCatP($_POST["catP"]);
header('Content-Type: application/json');
echo json_encode($categorie);
?>