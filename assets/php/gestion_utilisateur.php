<?php

if($type != "admin"){
    header("location: index.php?page=connexion");
}
?>



<!DOCTYPE html>
<html lang="fr">

<?php

require("assets/bdd/bddconfig.php");

try {

    $objBdd = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);

    $objBdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $recup = $objBdd->query("SELECT * from user");

} catch (Exception $prmE) {

    die("ERREUR : " . $prmE->getMessage());
}

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/gestion_utilisateur.css">
    <title>Document</title>
</head>
<body>

<div class="gros_bloc">
        <div class="header_gros_bloc">
            <div class="NOM"><p>Nom</p></div>
            <div class="EMAIL"><p>Email</p></div>
            <div class="OPTIONS"><p>Options</p></div>
        </div>

        <?php 
    while ($messageSimple = $recup-> fetch()) {
    ?>

        <div class="users">
            <form id="form" method="POST" action="assets/bdd/post_type.php?id=<?php echo $messageSimple["iduser"] ?>">
            <div class="pseudo"><p><?php echo stripslashes($messageSimple['pseudo']); ?></p></div>
            <div class="pseudo_mail"><p><?php echo stripslashes($messageSimple['email']); ?></p></div>
            <div class="type">
                <div class="round" >
                    <input type="radio" id="admin" name="type" value="admin" />
                    <label for="admin">Admin</label>
                </div>
                <div class="round">
                    <input type="radio" id="user" name="type" value="user" checked />
                    <label for="user">User</label>
                </div>
                <div>
                    <a onclick="return checkdelete()" href="assets/bdd/delete_user.php?id= <?php echo $messageSimple["iduser"] ?>"><img  src="assets/Img/bin.svg" alt="" class="bin" /></a>
                </div>
                <div class="input-validate">
                    <input type="submit" value="Valider" class="valider" name="insert" required>
                </div>
            </form>
        </div>
</div>
 
        <?php
                                }
                                ?>


<script src="assets/js/delete_utilisateur.js"></script>

</body>
</html>