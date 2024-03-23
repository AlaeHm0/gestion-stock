<?php

require_once("../backend/database.php");
$id = $_GET['id'];
if(mysqli_query($conn, "DELETE FROM reception WHERE id = '$id'")){
    echo "Reception est supprime avec success!";
}else{
    echo "Error : " . mysqli_error($conn);
}
mysqli_close($conn);
?>