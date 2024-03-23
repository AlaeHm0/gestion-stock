<?php
require_once('../backend/database.php');

$produit = $_POST['produit'];
$qte = $_POST['qte'];
$user = $_POST['user'];

$query = mysqli_query($conn, "SELECT '$produit' IN (SELECT produit FROM reception WHERE statut = 'selection' AND user = '$user') as exist");
$result = mysqli_fetch_assoc($query);
if($result['exist'] == 1){
    mysqli_query($conn, "UPDATE reception SET quantite = quantite + '$qte' WHERE statut = 'selection' AND produit = '$produit' AND user = '$user' ");
    echo "Quantite mettre ajour avec success!";
}else{
    mysqli_query($conn, "INSERT INTO reception ( produit, quantite, statut, user ) VALUES ('$produit', '$qte', 'selection', '$user') ");
    echo "Reception est ajoute avec success!";
}

mysqli_close($conn);
?>