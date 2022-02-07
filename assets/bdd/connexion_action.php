<?php

session_start();
// on recup la saisie de l'utilisateur en POST
$pseudo = htmlspecialchars(strtolower($_POST["pseudo"]));
$mdp =  htmlspecialchars(strval($_POST["mdp"]));

try{

    // on va verifier si l'email et mot de passe ne sont pas vides
    if($pseudo != ""  && $mdp!= "") {
    
        require('../bdd/bddconfig.php');
    
        // Connecte a la base mysql
        $objBdd = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);  
        // En cas de problème renvoie dans le catch avec l'erreur
        $objBdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // ici on prepare notre requête SQL
        $PDOlistlogins = $objBdd->prepare("SELECT * FROM user, file WHERE pseudo = :pseudo");
        // on initialise notre :pseudo avec la variable qui récup le pseudo
        $PDOlistlogins->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        // execute la requête SQL
        $PDOlistlogins->execute();
    
        // on initialise une variable avec les données de utilisateur
        $row_userweb = $PDOlistlogins->fetch();

        echo $row_userweb["mdp"];
    
        if ($row_userweb != false) {
    
        // vérif du password :
            if (password_verify($mdp, $row_userweb['mdp'])) {
                //authentification réussie
                //création de la variable de session : 
    
                // on stock les données utilisateur dans un tableau
                $session_data = array(
                    'iduser' => $row_userweb['iduser'],
                    'pseudo' => $row_userweb['pseudo'],
                    'type' => $row_userweb['type']
                );
    
                //régénérer le session id pour eviter d'avoir 2 user dans le $_SESSION
                session_regenerate_id();
                //enregistrer les données dans une variable de session
                $_SESSION['logged_in'] = $session_data;
                // $_SESSION['logged_in']["id"] = $row_userweb['idUser'];
                $PDOlistlogins->closeCursor();
    
                header("Location: ../../index.php");
    
            } else {
                //Mauvais password
                session_destroy();
                header("Location: ../../index.php?page=connexion" );
            }
    
        } else {
            //Mauvais login
            session_destroy();
            header("Location: ../../index.php?page=connexion" );
        }
    
    } else {
        header("Location: ../../index.php");
    }

    

    

}catch( Exception $prmE){

    die("Erreur" . $prmE->getMessage());




    
}


