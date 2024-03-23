<?php
require_once("../backend/database.php");

$code = $_POST['code'];
$nom = $_POST['nom'];
$categorie = $_POST['categorie'];
$desc = @$_POST['description'];

if(mysqli_query($conn, "INSERT INTO `produit` (`code`, `nom`, `categorie`, `description`) VALUES ('$code', '$nom', '$categorie', '$desc')")){
    echo "Produit est ajoute avec success";
}else{
    echo "Error : " . mysqli_error($conn);
}

mysqli_close($conn);
?>