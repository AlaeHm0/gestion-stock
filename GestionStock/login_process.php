<?php
session_start();
require_once("backend/database.php");

$login = $_POST['login'];
$psw = $_POST['psw'];

$stmt = $pdo->prepare("SELECT * FROM user WHERE login = :login AND motpass = :psw");
$stmt->bindParam(':login', $login, PDO::PARAM_STR);
$stmt->bindParam(':psw', $psw, PDO::PARAM_STR);
$stmt->execute();
if($stmt->rowCount() == 1){
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $_SESSION['id'] = $user['id'];
    $_SESSION['login'] = $user['login'];
    $_SESSION['nom'] = $user['nom'];
    header("Location: dashboard.php");
}else{
    header("Location: login.php?msg=Invalid login or password!");
}


?>