
<?php


require("bddconfig.php");

if(isset($_POST['insert'])) {
   $id = htmlspecialchars($_GET["id"]);
   echo $id;
   $types = htmlspecialchars( $_POST['type']);
 try{

    $objBdd = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);  
 
    $objBdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $recup = $objBdd->prepare("UPDATE `user` SET `type` = :types WHERE `iduser` = $id ");
    
    $recup->bindParam(':types' , $types , PDO::PARAM_STR);

   
    $recup->execute();

    header('Location: ../../index.php?page=gestion_utilisateur');
   
 }catch( Exception $prmE){

    
    die("ERREUR : " . $prmE->getMessage());

 }
}







