<?php
require_once("../backend/database.php");
session_start();

$id = $_POST['id'];
mysqli_query($conn, "DELETE FROM user WHERE id = '$id'");
echo "Utilisateur est supprime avce success!";
mysqli_close($conn);
?>