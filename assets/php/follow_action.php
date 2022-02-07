<?php 

session_start();

require("../bdd/bddconfig.php");

$objBdd = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);  
$objBdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$getfollowedid = intval($_GET['followedid']);

echo $getfollowedid;

if( $getfollowedid != $_SESSION['logged_in']['iduser']) {


    $dejafollowed = $objBdd->prepare('SELECT * FROM abonnement WHERE idsuivie = ? AND idsuiveur = ?');
    $dejafollowed->execute(array($_SESSION['logged_in']['iduser'], $getfollowedid));
    $dejafollowed = $dejafollowed->rowCount();

    if($dejafollowed == 0){

        $addfollow = $objBdd->prepare('INSERT INTO abonnement (idsuivie, idsuiveur) VALUES(?,?)');
        $addfollow->execute(array($_SESSION['logged_in']['iduser'],$getfollowedid));

    }else if($dejafollowed == 1){

        $deletefollow = $objBdd->prepare('DELETE FROM abonnement WHERE idsuivie = ? AND idsuiveur = ? ');
        $deletefollow->execute(array($_SESSION['logged_in']['iduser'],$getfollowedid));
    }

}

header("Location: ../../index.php");