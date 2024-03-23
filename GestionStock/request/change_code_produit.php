<?php
require_once("../backend/database.php");

$code = $_GET['code'];

$result = mysqli_query($conn, "SELECT pd.nom as nom, ct.nom as categorie FROM produit pd JOIN categorie ct ON ct.id = pd.categorie WHERE pd.id = '$code' ");

$row = mysqli_fetch_assoc($result);

ob_clean();

echo json_encode($row);

mysqli_close($conn);

?>