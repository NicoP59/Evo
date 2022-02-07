<head>
    <link rel="stylesheet" href="assets/css/style_connexion.css">
</head>

<main>

    <form method="POST" action="assets/bdd/connexion_action.php">

        <h3>Connexion</h3>
        <div class="container-connexion">
        <div class="connexion">
        
            <input placeholder="Pseudo*" type="text" name="pseudo" required>
        </div>
<hr>
        <div class="connexion">
            
            <input placeholder="Mot de Passe*" type="password" name="mdp" required>
        </div>
        <hr>
        </div>

        <div class="connexion1">
            <input id="envoyer" type="submit">
        </div>
<div class="container-href">
        <a href="index.php?page=inscription" class="redirection">S'inscrire</a>
        </div>
    </form>
    

</main>