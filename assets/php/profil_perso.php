<head>
    <link rel="stylesheet" href="assets/css/style_profil.css">
    <link rel="stylesheet" href="assets/css/home.css">
    
</head>

                            <!-- PROFIL -->

<?php

    require("assets/bdd/bddconfig.php");

    try {
        $iduser = $verif_co;

        $objBdd = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);

        $objBdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $recup = $objBdd->query("SELECT * FROM `user` WHERE user.iduser = $iduser ");
        

    } catch (Exception $prmE) {
        die("ERREUR : " . $prmE->getMessage());
    }

?>

<?php
    while ($message = $recup->fetch()) {
    ?>
    <div class="profil">
        <div class="avatar">
            <span class="iconify" data-icon="carbon:user-avatar-filled"></span>
        </div>
        <div class="info-profil">
            <p>@<?php echo  $message["pseudo"]; ?></p>
            <div class="abonnés">
                <?php 
                
                if( $iduser == $_SESSION['logged_in']['iduser'] ){

                ?>

                <a href="index.php?page=profil_update" class="subscribe-button">Modifier Profil</a> 

                <?php    
                }else {
                ?>
                <a href="assets/php/follow_action.php?followedid=<?php echo $iduser ?>&" class="subscribe-button">S'abonner</a> 
                <?php 
                }
                ?>
            </div>
        </div>
    </div>

    <?php
}
?>

                            <!-- ABONNEMENT -->

<?php


    try {
        $abonnement = $verif_co     ;

        $objBdd2 = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);

        $objBdd2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $recup2 = $objBdd2->prepare("SELECT * FROM `abonnement` WHERE idsuivie = :abonnement");
        $recup2->bindParam(':abonnement', $abonnement, PDO::PARAM_STR);
        $recup2->execute();

        $verif2 = $recup->fetch();

        echo $verif2;
    } catch (Exception $prmE) {

        die("ERREUR : " . $prmE->getMessage());
    }

?>

                            <!-- PUBLICATION -->

<?php


    try {
        $publication = $verif_co;

        $objBdd3 = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);
        $objBdd3->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $recup3 = $objBdd3->prepare("SELECT * FROM `abonnement` WHERE idsuivie = :publication ");

        $recup3->bindParam(':publication', $publication, PDO::PARAM_STR);
        $recup3->execute();
        $verif3 = $recup3->fetch();


    } catch (Exception $prmE) {
        die("ERREUR : " . $prmE->getMessage());
    }

?>

                                <!-- ABONNE -->

<?php


    try {
        $abonne = $verif_co;

        $objBdd4 = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);

        $objBdd4->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $recup4 = $objBdd4->prepare("SELECT * FROM `post` WHERE iduser = :abonne ");
        $recup4->bindParam(':abonne', $abonne, PDO::PARAM_STR);
        $recup4->execute();
        $verif4 = $recup4->fetch();


    } catch (Exception $prmE) {
        die("ERREUR : " . $prmE->getMessage());
    }

?>
<div class="info-compte">


                                <!-- PUBLICATION -->
    <?php 
        if($verif4 == ""){
            $publication = 0;
    ?>
            <p><?php echo $publication ?> Publication</p>
    <?php
        }else{
            $publication = $recup4->rowCount();

    ?>
            <p><?php echo $publication ?> Publication</p>

    <?php   
        }
    ?>

                                <!-- ABONNE -->

    <?php 
        if($verif2 == ""){
            $abonne = 0;
    ?>
            <p><?php echo $abonne ?> Abonné</p>

    <?php
        }else {
            $abonne = $recup2->rowCount();
    ?>
            <p><?php echo $abonne ?> Abonné</p>
    <?php   
        }
    ?>

                                <!-- ABONNEMENT -->

    <?php 
        if($verif3 == ""){
            $abonnement = 0;

    ?>
            <p><?php echo $abonnement ?> Abonnement</p>

    <?php
        }else {
            $abonnement = $recup3->rowCount();

    ?>
            <p><?php echo $abonnement ?> Abonnement</p>

    <?php   
        }
    ?>
</div>

<a href="index.php?page=create_post" class="post"> Créer un post</a>


<?php
    require("assets/bdd/bddconfig.php");
    
    try {
        $objBdd = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);
        $objBdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $recup = $objBdd->query("SELECT * FROM `user`, `post`, `file` WHERE user.iduser = post.iduser AND post.idpost = file.idpost AND user.iduser = $iduser");
        
    } catch (Exception $prmE) {
        die("ERREUR : " . $prmE->getMessage());
    }
?>


<section id="section2">
    <?php
    while ($messageSimple = $recup->fetch()) {
    ?>
        <div class="content_post">

            <div>
                <!-- Générer image -->
                <img id="post_img" src="assets/upload/<?php echo stripslashes($messageSimple['image']); ?>" alt="image" >

            </div>

            <div id="like_com">

                <div class="heart"></div>
                <div><span class="iconify" data-icon="bi:chat" style="color: #2b2238;" data-width="30"></span></div>

            </div>

        </div>
        <?php
    }
    ?>
</section>



<script src="https://code.iconify.design/2/2.1.0/iconify.min.js"></script>
<script src="assets/js/script_heart.js"></script>