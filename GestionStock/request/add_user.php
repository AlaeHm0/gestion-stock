<?php
require_once('../backend/database.php');

$nom = $_POST['nom'];
$login = $_POST['login'];
$psw = $_POST['psw'];
$role = $_POST['role'];

$result = mysqli_query($conn, "INSERT INTO user (nom, login, motpass, role) VALUES ('$nom', '$login', '$psw', '$role')");
if($result){
    echo  "Utilisateur est ajoute avec success!";
}else{
    echo "Error : " . mysqli_error($conn);
}
mysqli_close($conn);
?>