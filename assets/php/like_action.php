<?php 

session_start();


require("../bdd/bddconfig.php");

try {

    $objBdd = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);

    $objBdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $recup = $objBdd->query("SELECT * FROM `likes`, `post` WHERE post.idpost = likes.idpost ");
    

} catch (Exception $prmE) {
    die("ERREUR : " . $prmE->getMessage());
}

$getidpost = intval($_POST['idpost']);

$dejalike = $objBdd->prepare('SELECT * FROM `likes` WHERE  iduser = :iduser AND idpost = :idpost');

$dejalike->bindParam(':iduser', $_SESSION['logged_in']['iduser'], PDO::PARAM_STR);
$dejalike->bindParam(':idpost', $getidpost, PDO::PARAM_STR);
$dejalike->execute();

$dejalike = $dejalike->rowCount();
    
if($dejalike == 0){

    $addlike = $objBdd->prepare('INSERT INTO `likes` (iduser, idpost) VALUES (?,?)');
    $addlike->execute(array($_SESSION['logged_in']['iduser'],$getidpost));

}else if($dejalike == 1){

    $deletelike = $objBdd->prepare('DELETE FROM `likes` WHERE  iduser = :iduser AND idpost = :idpost');
    $deletelike->bindParam(':iduser', $_SESSION['logged_in']['iduser'], PDO::PARAM_STR);
    $deletelike->bindParam(':idpost', $getidpost, PDO::PARAM_STR);
    $deletelike->execute();
}


header("Location: ../../index.php?page=profil_perso");