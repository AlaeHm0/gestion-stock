<?php

require_once("../backend/database.php");
$id = $_POST['id'];
if(mysqli_query($conn, "DELETE FROM client WHERE id = '$id'")){
    echo "Client est supprime avec success!";
}else{
    echo "Error : " . mysqli_error($conn);
}
mysqli_close($conn);
?>