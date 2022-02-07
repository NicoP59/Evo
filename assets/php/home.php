<head>

    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="assets/css/home_media.css">

</head>

<body>

    <main>

        <section id="section1">

            <?php
                if( $verif_co != 0 ){
            ?>
                <h1 class="bjr_pseudo">Bonjour <span id="co_pseudo"><?php echo  $_SESSION["logged_in"]["pseudo"]; ?></span></h1>
                        
            <?php 
                }else if( $verif_co == 0){
            ?>

                <h1 class="bjr_pseudo"><?php echo "Bonjour " ; ?></h1>

            <?php 
            }
            ?>  

            <div id="barre"></div>

        </section>
        
            <?php

                require("assets/bdd/bddconfig.php");
                
                try {

                    $objBdd = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);

                    $objBdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $recup = $objBdd->query("SELECT * FROM `user`, `post`, `file` WHERE user.iduser = post.iduser AND post.idpost = file.idpost ORDER BY DATE DESC ");

                } catch (Exception $prmE) {

                    die("ERREUR : " . $prmE->getMessage());
                }

            ?>
            
        <section id="section2">

            <?php

            while ($messageSimple = $recup->fetch()) {

            ?>

                <div class="content_post" >
                        
                    <!-- Page popup -->
                    <div id="<?php echo $messageSimple["idpost"] ?>" class="popup">

                        <section  id="section1p">

                            <!-- Générer la légende de la popup en responsive uniquement-->
                            <div class="marge legende" id="legende2">

                                <p>"<?php echo stripslashes($messageSimple["legende"]); ?>"</p>
                                
                            </div>
    
                            <div>
                                <!-- Générer l'image de la popup-->
                                <img class="popup_img" src="assets/upload/<?php echo stripslashes($messageSimple['image']); ?>" alt="image" >
                            
                            </div>
    
                        </section>

                        <section id="section2p">

                            <article id="article1">

                                <div class="content_fonctionnalites">

                                        <!-- Générer pseudo de la popup-->
                                        <div>
                                                
                                            <h2 id="post_pseudo" class="post_pseudo_popup">@<?php echo stripslashes($messageSimple["pseudo"]); ?></h2>
                                            
                                        </div>

                                        <!-- Générer la légende de la popup -->
                                        <div class="legende" id="legende1">

                                            <p>"<?php echo stripslashes($messageSimple["legende"]); ?>"</p>
                                                
                                        </div>

                                        <!-- Affichage de la date du post -->
                                        <div id="date"> <?php echo $messageSimple["date"]; ?></div>

                                </div>

                                <!-- Animation coeur pour liker -->
                                <div class="heart" id="heart2"></div>

                                <div class="content_fonctionnalites"> 

                                    <!-- Croix pour fermer la popup -->
                                    <div class="btnferme">

                                        <span class="iconify ico" data-icon="ep:circle-close-filled" style="color: #c276b7;" data-width="30"></span>
                                                
                                    </div>

                                    <!-- Bouton pour rediriger vers modifier le post -->
                                    <?php
                                        if($messageSimple["iduser"] == $verif_co){
                                    ?>

                                        <div class="btngear">

                                            <a href="index.php?page=update_post_form&id=<?php echo $messageSimple["idpost"] ?>"><span class="iconify ico" data-icon="bi:gear" style="color: #2b2238;" data-width="30"></span></a>
                                                    
                                        </div>

                                    <?php
                                    }
                                    ?>

                                </div>

                            </article>

                            <article id="article2">

                                <div id="barre_rose2"></div>

                                <!-- Espace commentaires -->
                                <?php

                                    require("assets/bdd/bddconfig.php");

                                    try {

                                        $idpost = $messageSimple["idpost"];

                                        $objBdd2 = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);
                                        $objBdd2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                        $recup2 = $objBdd2->prepare("SELECT * FROM  `post`, `commentaire` WHERE post.idpost = commentaire.idpost AND post.idpost = :idpost  ORDER BY commentaire.idcommentaire DESC ");
                                        $recup2->bindParam(':idpost' , $idpost , PDO::PARAM_STR);
                                        $recup2->execute();
        
                                    } catch (Exception $prmE) {

                                        die("ERREUR : " . $prmE->getMessage());
                                    }

                                ?>

                                <!-- Affichage des commentaires ici -->
                                <div class="affichage_com">

                                    <?php
                                                
                                    while ($plop = $recup2->fetch()) {

                                    ?>
                                                                
                                        <p id="pseudo_com">@<?php echo stripslashes($plop["pseudo"]); ?>
                                        <br>
                                        <span id="com"><?php echo stripslashes($plop["commentaire"]); ?></span></p>

                                    <?php
                                    }
                                    ?>

                                </div>

                                <!-- Ajouter un commentaire -->
                                <!-- Tu dois être connecté pour pouvoir laisser un commentaire -->
                                <?php
                                    if( $verif_co != 0 ){
                                ?>

                                    <form method="POST" action="assets/bdd/commentaire_action.php"> 

                                        <textarea maxlength="255" name="commentaire" class="marge textarea" id="arena" placeholder="Ajouter un commentaire" cols="100" rows="10" autofocus="" required=""></textarea>    
                                                    
                                        <input type="hidden" name="pseudo" value="<?php echo $_SESSION["logged_in"]["pseudo"]?>">
                                        <input type="hidden" name="idpost" value="<?php echo $messageSimple["idpost"]?>">
                                        <input type="hidden" name="iduser" value="<?php echo $_SESSION["logged_in"]["iduser"]?>">

                                        <input type="submit" value="Soumettre" id="soumettre">

                                    </form>
                        
                                <!-- Sinon tu ne peux pas laisser de commentaire -->
                                <?php 
                                    }else if( $verif_co == 0){
                                ?>

                                <?php 
                                    }
                                ?>  

                            </article>

                        </section>

                    </div>

                    <!-- PAGE HOME -->
                    <!-- Générer pseudo et si on clique dessus redirige vers profil-->
                    <?php
                        if($messageSimple["iduser"] == $verif_co){
                    ?>

                        <a href="index.php?page=profil_perso&id=<?php echo $messageSimple["idpost"] ?>">
                            <h2 id="post_pseudo">@<?php echo stripslashes($messageSimple["pseudo"]); ?></h2>
                        </a>

                    <?php
                        }else{
                    ?>

                        <a href="index.php?page=other_profile&id=<?php echo $messageSimple["idpost"] ?>">
                            <h2 id="post_pseudo">@<?php echo stripslashes($messageSimple["pseudo"]); ?></h2>
                        </a>
                                        
                    <?php
                        }
                    ?>               

                    <!-- Générer image + lien de la popup pour qu'elle apparaisse -->
                    <div class="btn" data-modal="<?php echo $messageSimple["idpost"] ?>">

                        <img id="post_img" src="assets/upload/<?php echo stripslashes($messageSimple['image']); ?>" alt="image" >

                    </div>

                    <div id="like_com">

                        <!-- Animation coeur pour liker -->
                        <div class="heart"></div>

                        <!-- Ajouter un commentaire -->
                        <div class="btn" data-modal="<?php echo $messageSimple["idpost"] ?>">

                            <span class="iconify ico" data-icon="bi:chat" style="color: #2b2238;" data-width="30"></span>
                            
                        </div>
                        
                    </div>

                </div>

            <?php
            }
            ?>

        </section>

    </main>
    
    <script src="https://code.iconify.design/2/2.1.1/iconify.min.js"></script>
    <script src="assets/js/script_heart.js"></script>
    <script src="assets/js/script_popup.js"></script>
</body>
</html>