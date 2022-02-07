<?php
require('assets/bdd/bddconfig.php');
    
// Connecte a la base mysql
$objbdd = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);  


$allusers = $objbdd->query('SELECT * FROM user ORDER BY iduser DESC');

if(isset($_GET['s']) AND !empty($_GET['s'])){
    $recherche = htmlspecialchars($_GET['s']);
    $allusers = $objbdd->query('SELECT pseudo,avatar FROM user WHERE pseudo LIKE "%'.$recherche.'%" ORDER BY iduser DESC');
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <link rel="stylesheet" href="assets/css/style_search.css">
    <title>Document</title>
</head>
<body>
<div class="container_page">
    <form method="GET" action="index.php">
<div class="container_recherche">
    <input type="hidden" name="page" value="recherche">
        <input type="search" name="s" placeholder="Rechercher un utilisateur ..." autocomplete="off">
    </form>
    <section class="content_section">

    <?php
    if($allusers-> rowCount()>0){
        while($user= $allusers-> fetch()){
            ?>
            <div class="container_echo">
            <img class="taille" src="assets/upload/<?php echo $user ['avatar']  ?>"  alt="avatar">
                <p class="echo"> <?php echo $user ['pseudo'];?></p>
                
            </div>
            <?php
        }

    }else{
        ?>
        <p class="echo">Aucun Utilisateur Trouvé</p>
        <?php
    }

    ?>

    </section>
    </div>
    
    
</body>
</html>