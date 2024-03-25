<?php
require_once("../backend/database.php");

$nom = $_POST['nom'];
$cap_max = $_POST['capacity_max'];
$id = $_POST['id'];
if($id == ''){
    mysqli_query($conn, "INSERT INTO emplacement (nom , capacity_max) VALUES ('$nom', '$cap_max')");
echo "emplacement est ajoute avec succes!";
}else{
    $result = mysqli_query($conn, "SELECT * FROM emplacement WHERE id='$id'");
    $row = mysqli_fetch_assoc($result);
    if($row['capacity_actuelle'] <= $cap_max){
        mysqli_query($conn, "UPDATE emplacement SET nom = '$nom', capacity_max = '$cap_max' WHERE id = '$id' ");
        echo "Emplcement est mise ajoure avec success!";
    }else{
        echo "Error : la Capacity maximal doit etre supperieur ou egal a capacity disponible";
    }
}
mysqli_close($conn);
?>