<?php
session_start();
require_once("backend/database.php");

$nom = $_POST['nom'];
$login = $_POST['login'];
$pw = $_POST['pw'];
$role = $_POST['role'];

$sql = "INSERT INTO user (nom, login, motpass, role) VALUES ('$nom', '$login', '$pw', '$role')";
$result = mysqli_query($conn, $sql);
    if($result){
        $_SESSION['login'] = $login;
        header("Location: categories.php");
    }else{
        echo "Error : " . mysqli_error($conn);
    }


mysqli_close($conn);

?>