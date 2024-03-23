<?php
include '../backend/database.php';

$id = $_POST['id'];
mysqli_query($conn, "DELETE FROM categorie WHERE id = '$id' ");
echo "Categorie est supprime avec success";
?>