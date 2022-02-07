<?php

//  si 0 !=  l'utilisateur est connecter
if( $verif_co != 0){
    
     //header("Location: index.php");
    
}

?>


<head>

    <link rel="stylesheet" href="assets/css/style_inscription.css">

</head>

<main>


    <form method="POST" action="assets/bdd/inscription_action.php">

        <h3>Inscription</h3>
<div class="container-connexion">
        <div class="connexion">
        
            <input placeholder="Nom" type="text" name="nom" required>
        </div>
<hr>
        <div class="connexion">
            
            <input placeholder="Prénom" type="text" name="prenom" required>
        </div>
<hr>
        <div class="connexion">
            
            <input placeholder="Pseudo" type="text" name="pseudo" required>
        </div>
<hr>
        <div class="connexion">
            
            <input placeholder="Email" type="email" name="email" required>
        </div>
<hr>
        <div class="connexion">
            
            <input placeholder="Mot De Passe" type="password" name="mdp" required>
        </div>
<hr>
        <div class="connexion">
            
            <input placeholder="Confirmer le Mot de Passe" type="password" name="mdp2" required>
        </div>
        <hr>
</div>
        <div class="connexion1">
            <input id="envoyer" type="submit" value="ENVOYER">
        </div>
        <div class="container-href">
        <a href="index.php?page=connexion" class="redirection">Se Connecter</a>
</div>
    </form>


</main>