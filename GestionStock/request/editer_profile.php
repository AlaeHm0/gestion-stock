<?php
require_once('../backend/database.php');

$id = $_POST['id'];
$nom = $_POST['nom']; // assuming 'nom' is the field for name
$email = $_POST['email'];
$phone = $_POST['phone'];
$role = $_POST['role'];
$psw = $_POST['psw'];
$n_psw = $_POST['n_psw'];
// Prepare and execute the query to fetch user data
$stmt = $pdo->prepare("SELECT * FROM user WHERE id = :id AND motpass = :psw");
$stmt->bindParam(':id', $id, PDO::PARAM_STR);
$stmt->bindParam(':psw', $psw, PDO::PARAM_STR);
$stmt->execute();
if($stmt->rowCount() <= 0){
    header("Location: ../paramettre.php?error=Erreur de motpass. Veuillez réessayer.");
} else {
    // Update user information
    $stmt = $conn->prepare("UPDATE user SET nom = ?, email = ?, phone = ?, role = ?, motpass = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $nom, $email, $phone, $role, $n_psw, $id);
    if ($stmt->execute()) {
        header("Location: ../paramettre.php?success=Modifications enregistrées avec succès!");
    } else {
        header("Location: ../paramettre.php?error=Erreur lors de l'enregistrement des modifications. Veuillez réessayer.");
    }
}

?>
