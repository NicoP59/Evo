<?php 

session_start(); 

if( isset($_SESSION["logged_in"]["iduser"])){
    
    $verif_co = $_SESSION["logged_in"]["iduser"];

    $type = $_SESSION["logged_in"]["type"];

}else{

    $verif_co = 0;
    $type = "invite";

}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Evo</title>
</head>
<body>

<?php require_once('assets/template/header.php'); ?>

<?php

if(isset($_GET['page']) && file_exists("assets/php/".$_GET['page'].'.php') ){
    
    require_once("assets/php/".$_GET['page'] .".php");

}else{

    require_once('assets/php/home.php');
    // require_once('assets/php/connexion.php');

}
?>

<?php require_once('assets/template/footer.php'); ?>

</body>
</html>