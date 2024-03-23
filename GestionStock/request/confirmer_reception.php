<?php
require_once("../backend/database.php");

$fornisseur = $_POST['fornisseur'];
$date_reception = $_POST['date_reception'];
$emplacement = $_POST['emplacement'];
$user = $_POST['user'];

mysqli_query($conn, "INSERT INTO facture(type) VALUES ('reception')");

$result = mysqli_query($conn, "SELECT LAST_INSERT_ID() as id");
$row = mysqli_fetch_assoc($result);
$fac_id = $row['id'];

if(mysqli_query($conn, "UPDATE reception SET fornisseur = '$fornisseur', date_reception = '$date_reception', emplacement =  '$emplacement', statut = 'associe', facture = '$fac_id' WHERE statut = 'selection' AND user = '$user'")){
    echo "Reception est confirme avec success!";
}else{
    echo "Error : " . mysqli_error($conn);
}


mysqli_close($conn);
?>