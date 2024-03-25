<?php
require_once("../backend/database.php");
$id = $_POST['id'];
$ice = $_POST['ice'];
$email = $_POST['email'];
$nom = $_POST['nom'];
$phone = $_POST['phone'];
$adresse = $_POST['adresse'];

if($id != ''){
    mysqli_query($conn, "UPDATE fornisseur SET nom = '$nom', ice = '$ice', email = '$email', phone = '$phone', adresse = '$adresse' WHERE id = '$id'");
    echo "Fornisseur est mise ajoure avec success!";
}else{
    mysqli_query($conn, "INSERT INTO fornisseur (nom, ice, email, phone, adresse) VALUES ('$nom', '$ice', '$email', '$phone', '$adresse')");
    echo "Fornisseur est ajoute avec success!";
}

mysqli_close($conn);
?>