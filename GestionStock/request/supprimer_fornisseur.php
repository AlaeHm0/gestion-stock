<?php

require_once("../backend/database.php");
$id = $_POST['id'];
if(mysqli_query($conn, "DELETE FROM fornisseur WHERE id = '$id'")){
    echo "Fornisseur est supprime avec success!";
}else{
    echo "Error : " . mysqli_error($conn);
}
mysqli_close($conn);
?>