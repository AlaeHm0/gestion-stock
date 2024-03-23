<?php
session_start();
require_once("backend/database.php");

$login = $_POST['login'];
$psw = $_POST['psw'];

$result = mysqli_query($conn, "SELECT * FROM user WHERE login = '$login' AND motpass = '$psw' ");

if(mysqli_num_rows($result) == 1){
    $row = mysqli_fetch_assoc($result);
    $_SESSION['id'] = $row['id'];
    $_SESSION['login'] = $row['login'];
    $_SESSION['nom'] = $row['nom'];
    header("Location: categories.php");
}else{
    echo "Invalid login or password!";
}
mysqli_close($conn);
?>