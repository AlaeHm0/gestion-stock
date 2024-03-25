<?php
include '../backend/database.php';


$id = $_POST['id'];
$categorie = $_POST['nom'];
if($id == ''){
    mysqli_query($conn, "INSERT INTO categorie (nom) VALUES ('$categorie')");
    echo "categorie ajouter avec success!";
}else{
    mysqli_query($conn, "UPDATE categorie SET nom = '$categorie' WHERE id = '$id'");
    echo "Categorie mise ajoure avec success!";
}

mysqli_close($conn);
?>