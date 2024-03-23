<?php
include '../backend/database.php';

$categorie = $_POST['nom'];

mysqli_query($conn, "INSERT INTO categorie (nom) VALUES ('$categorie')");

echo "categorie ajouter avec success!";
mysqli_close($conn);
?>