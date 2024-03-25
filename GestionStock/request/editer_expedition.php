<?php
require_once('../backend/database.php');

$id = $_GET['id'];


$result = mysqli_query($conn, "SELECT rc.quantite as quantite, pr.code as code, pr.id as produit, em.id as emplacement FROM sortie rc JOIN produit pr ON pr.id = rc.produit JOIN emplacement em ON em.id = rc.emplacement WHERE rc.id = '$id'");
$row = mysqli_fetch_assoc($result);

ob_clean();
echo json_encode($row);

mysqli_close($conn);


?>