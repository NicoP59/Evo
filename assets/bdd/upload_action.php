<?php

require("bddconfig.php");

$tmpName = $_FILES['file']['tmp_name'];
$name = $_FILES['file']['name'];
$size = $_FILES['file']['size'];
$error = $_FILES['file']['error'];
$idpost = 1;
$idcompte = 20;

try{

    if(isset($_FILES['file'])){

        $tabExtension = explode('.', $name);
        $extension = strtolower(end($tabExtension));
        $extensions = ['jpg', 'png', 'jpeg', 'gif'];
        $maxSize = 400000;
        
        if(in_array($extension, $extensions) && $size <= $maxSize && $error == 0){
    
            $uniqueName = uniqid('', true);
            $file = $uniqueName.".".$extension;
            
            move_uploaded_file($tmpName, '../upload/'.$file);

            
            $objBdd = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);  
            $objBdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $PDOInsertFile = $objBdd->prepare('INSERT INTO `file` ( `image`, `idpost`, `idcompte` ) VALUES ( :image, :idpost, :idcompte )');
            $PDOInsertFile->bindParam(':image', $file, PDO::PARAM_STR);
            $PDOInsertFile->bindParam(':idpost', $file, PDO::PARAM_STR);
            $PDOInsertFile->bindParam(':idcompte', $file, PDO::PARAM_STR);
            $PDOInsertFile->execute();
            
            header("Location: ../../index.php");

        }else{
            header("Location: ../../index.php");
        }

    }else{
        header("Location: ../../index.php");
    }

}catch(Exception $prmE){
    die('Erreur : '.$prmE->getMessage());
    
}