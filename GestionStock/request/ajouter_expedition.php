<?php
require_once('../backend/database.php');

$produit = $_POST['produit'];
$qte = $_POST['qte'];
$user = $_POST['user'];
$qte_stock = $_POST['qte_stock'];
$emplacement = $_POST['emplacement'];

$query = mysqli_query($conn, "SELECT '$produit' IN (SELECT produit FROM sortie WHERE statut = 'selection' AND user = '$user' AND emplacement = '$emplacement') as exist");
$result = mysqli_fetch_assoc($query);
if($result['exist'] == 1){
    $result = mysqli_query($conn, "SELECT quantite FROM sortie WHERE statut = 'selection' AND user = '$user' AND emplacement = '$emplacement'");
    $row = mysqli_fetch_assoc($result);
    if( $row['quantite'] + $qte > $qte_stock){
        echo "Impossible de ajouter ce quantite, le stock est insuffisant.\nVeiller reducer quantite ou changer l'emplacement";
    }else{
        mysqli_query($conn, "UPDATE sortie set quantite = quantite + '$qte' WHERE statut = 'selection' AND user = '$user' AND emplacement = '$emplacement'");
        echo "Quantite mettre ajour avec success!";
    }
}else{
    mysqli_query($conn, "INSERT INTO sortie ( produit, quantite, statut, user, emplacement ) VALUES ('$produit', '$qte', 'selection', '$user', '$emplacement') ");
    echo "Expedition est ajoute avec success!";
}

mysqli_close($conn);
?>