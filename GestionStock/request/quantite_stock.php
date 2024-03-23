<?php
require_once('../backend/database.php');

$produit = $_GET['produit'];
$emplacement = $_GET['id'];

$result = mysqli_query($conn, "SELECT quantite FROM stock WHERE produit = '$produit' AND emplacement = '$emplacement'");


ob_clean();

if(mysqli_num_rows($result) == 1){

    $row = mysqli_fetch_assoc($result);
    echo json_encode($row);
}else{
    echo json_encode(['quantite'=>0]);
}
mysqli_close($conn);

?>
