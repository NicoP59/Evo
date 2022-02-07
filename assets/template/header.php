<?php

try{

    require('assets/bdd/bddconfig.php');


    $objBdd = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8" , $bddlogin, $bddpass);
    $objBdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $PDOlistlogins = $objBdd->query("SELECT * FROM user");


}catch(Exception $prme){

    die("Erreur" . $prme->getMessage());
}

?>






<head>
   <link rel="stylesheet" href="assets/css/header.css">
   <link rel="stylesheet" href="assets/css/header_media.css">
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Bungee&display=swap" rel="stylesheet">
</head>

<body>

    <header>

    <section id="header">

    <div><img id="logoheader" src="assets/img/Logo.svg" alt="logo"></div>


    <!--barre de recherche-->


    
    

        <a href="index.php?page=recherche"><span class="iconify" data-icon="akar-icons:search" style="color: #8f249e;"></span></a>

    <!--menu burger-->

            <!--icône-->

    <div class="content">

        <div id="btnnavbar">
        <span class="iconify" data-icon="carbon:user-avatar-filled" style="color: #c276b7;" data-width="104" data-height="103"></span>
        </div>

    </div>

            <!--liens menu burger-->

   <div id="liensnav">

   <?php
       if($type== "admin"){
    ?>

      <a href="index.php?page=gestion_utilisateur" class="linky">Gestion d'utilisateur</a>
   <?php
   }
   ?>


       
        <a href="#" class="linky">Modifier mon profil</a>
        <a href="index.php?page=connexion" class="linky">Connexion</a> 
        <a href="index.php?page=deconnexion" class="linky">Deconnexion</a>
        <a href="index.php?page=inscription" class="linky">Inscription</a>
        <a href="index.php?page=home" class="linky">Home</a>
        <a href="index.php?page=profil_perso" class="linky">Mon profil</a>
        

    </div>

    </section>

    <div id="barre_rose"></div>

    </header>

    
    <script src="assets/js/menuhamburger.js"></script>
    <script src="https://code.iconify.design/2/2.1.1/iconify.min.js"></script>

</body>

</html>