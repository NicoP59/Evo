<?php

$commentaire =  htmlspecialchars($_POST["commentaire"]);
$pseudo =  htmlspecialchars( $_POST["pseudo"]);
$iduser =  htmlspecialchars( $_POST["iduser"]);
$idpost =  htmlspecialchars($_POST["idpost"]);

// echo $iduser;
// echo $pseudo;
// echo $idpost;

// die("erreur" . $iduser );

require("bddconfig.php");

try{

    $objBdd = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);  
    $objBdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 
    $PDOinsert = $objBdd->prepare("INSERT INTO `commentaire` (`commentaire`, `pseudo`, `iduser`, `idpost`) VALUES (:commentaire, :pseudo, :iduser, :idpost) ");

    $PDOinsert->bindParam(':commentaire' , $commentaire , PDO::PARAM_STR);
    $PDOinsert->bindParam(':pseudo' , $pseudo , PDO::PARAM_STR);
    $PDOinsert->bindParam(':iduser' , $iduser , PDO::PARAM_STR);
    $PDOinsert->bindParam(':idpost' , $idpost , PDO::PARAM_STR);
  
    $PDOinsert->execute();

    header('Location: ../../index.php');

}catch( Exception $prmE){

    die("ERREUR : " . $prmE->getMessage());

}