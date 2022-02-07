<?php

if( $verif_co != 0){
    
  // header("Location: index.php");
    
}

?>

<head>

<link rel="stylesheet" href="assets/css/update_post_form.css">

</head>

     
      <main id="main">
      <h1>Modifier mon Post</h1>

        <form name="formulaire" method="POST" action="assets/php/update_post.php">


            <textarea name="legende" id="legende" required placeholder="Écrivez une légende" onKeyUp="textCounter()" maxlength="200"></textarea> <br> <br>
             <!-- <p><span id="counter">0</span> / 200</p> -->
             <div id="compteur" style="text-align:right"> 0 / 200</div>
            <input type="submit" value="Envoyer" class="envoyer" required>
            <input type="hidden" name="idpost" value="<?php echo $_GET["id"]?>">


            

        </form>
         <!-- <input type="submit" value="Supprimer" class="supprimer"> -->
        </main>

        <script src="assets/js/text-counter.js"></script>