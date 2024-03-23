<?php
require_once("../backend/database.php");

$client = $_POST['client'];
$date_livraison = $_POST['date_livraison'];
$user = $_POST['user'];

mysqli_query($conn, "INSERT INTO facture(type) VALUES ('expedition')");

$result = mysqli_query($conn, "SELECT LAST_INSERT_ID() as id");
$row = mysqli_fetch_assoc($result);
$fac_id = $row['id'];

if(mysqli_query($conn, "UPDATE sortie SET client = '$client', date_livraison = '$date_livraison',  statut = 'associe', facture = '$fac_id' WHERE statut = 'selection' AND user = '$user'")){
    echo "Expedition est confirme avec success!";
}else{
    echo "Error : " . mysqli_error($conn);
}


mysqli_close($conn);
?>