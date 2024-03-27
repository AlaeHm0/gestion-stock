<?php
session_start();
require_once("backend/database.php");

$nom = $_POST['nom'];
$login = $_POST['login'];
$pw = $_POST['pw'];
$role = $_POST['role'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$sql = "INSERT INTO user (nom, login, motpass, role, email, phone) VALUES ('$nom', '$login', '$pw', '$role', '$email', '$phone')";
$result = mysqli_query($conn, $sql);
    if($result){
        $result = mysqli_query($conn , "SELECT LAST_INSERT_ID() as id FROM USER");
        $row = mysqli_fetch_assoc($result);
        $_SESSION['id'] = $row['id'];
        $_SESSION['login'] = $login;
        $_SESSION['nom'] = $nom;
        header("Location: dashboard.php");
    }else{
        echo "Error : " . mysqli_error($conn);
    }


mysqli_close($conn);

?>