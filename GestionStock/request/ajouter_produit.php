<?php
require_once("../backend/database.php");
$id = $_POST['id'];
$code = $_POST['code'];
$nom = $_POST['nom'];
$categorie = $_POST['categorie'];
$desc = $conn->real_escape_string($_POST['description']);

if($id == ''){
    mysqli_query($conn, "INSERT INTO `produit` (`code`, `nom`, `categorie`, `description`) VALUES ('$code', '$nom', '$categorie', '$desc')");
    echo "Produit est ajoute avec success";
}else{
    mysqli_query($conn, "UPDATE produit SET code = '$code', nom = '$nom', categorie = '$categorie', description = '$desc' WHERE id = '$id'");
    echo "Produit est mise ajoure avec success!";
}

mysqli_close($conn);
?>