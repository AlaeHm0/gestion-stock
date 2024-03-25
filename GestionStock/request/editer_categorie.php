<?php
require_once('../backend/database.php');

$id = $_GET['id'];


$result = mysqli_query($conn, "SELECT * FROM categorie WHERE id = '$id'");
$row = mysqli_fetch_assoc($result);

ob_clean();
echo json_encode($row);

mysqli_close($conn);


?>