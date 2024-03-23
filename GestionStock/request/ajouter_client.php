<?php
require_once("../backend/database.php");
$ice = $_POST['ice'];
$email = $_POST['email'];
$nom = $_POST['nom'];
$phone = $_POST['phone'];
$adresse = $_POST['adresse'];

if(mysqli_query($conn, "INSERT INTO client (nom, ice, email, phone, adresse) VALUES ('$nom', '$ice', '$email', '$phone', '$adresse')")){
    echo "Client est ajoute avec success!";
}else{
    echo "Error : " . mysqli_error($conn);
}
mysqli_close($conn);
?>