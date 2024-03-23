<?php
require_once("../backend/database.php");

$nom = $_POST['nom'];
$cap_max = $_POST['capacity_max'];
mysqli_query($conn, "INSERT INTO emplacement (nom , capacity_max) VALUES ('$nom', '$cap_max')");
echo "emplacement est ajoute avec succes!";
mysqli_close($conn);
?>