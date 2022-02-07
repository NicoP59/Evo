<?php 

$nom = htmlspecialchars($_POST["nom"]);
$prenom = htmlspecialchars($_POST["prenom"]);
$pseudo = htmlspecialchars($_POST["pseudo"]);
$email = htmlspecialchars(strtolower($_POST["email"]));
$mdp=  htmlspecialchars(strval($_POST["mdp"]));
$confirm_password = htmlspecialchars(strval($_POST["mdp2"]));
$avatar = "avatar.png";
$type = "user";


if( $nom != "" && $prenom != "" && $email != ""  && $mdp != ""  && $pseudo != "" && $confirm_password != "")  {

    if( $mdp == $confirm_password){

        $hash_password = password_hash( $mdp, PASSWORD_BCRYPT);

        require("../bdd/bddconfig.php");

        try {

            $objBdd = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);  
            $objBdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $PDOinsertuserweb = $objBdd->prepare("INSERT INTO  `user` (nom, prenom, email, mdp, pseudo, avatar, type) VALUES (:nom, :prenom, :email, :mdp, :pseudo, :avatar, :type)");
            
            $PDOinsertuserweb->bindParam(':nom', $nom, PDO::PARAM_STR);
            $PDOinsertuserweb->bindParam(':prenom', $prenom, PDO::PARAM_STR);
            $PDOinsertuserweb->bindParam(':email', $email, PDO::PARAM_STR);
            $PDOinsertuserweb->bindParam(':avatar', $avatar, PDO::PARAM_STR);
            $PDOinsertuserweb->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
            $PDOinsertuserweb->bindParam(':type', $type, PDO::PARAM_STR);
            $PDOinsertuserweb->bindParam(':mdp', $hash_password, PDO::PARAM_STR);
            $PDOinsertuserweb->execute();

            $lastId = $objBdd->lastInsertId();
            

            header("Location: ../../index.php");
    
        } catch (Exception $prmE) {
            die('Erreur : ' . $prmE->getMessage());
        }

    }else{
        header("Location: ../../index.php?page=inscription" );
    }

}else{
    header("Location: ../index.php?page=inscription");
}
