<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_stock";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$dsn = "mysql:host=$servername;dbname=$dbname";
$pdo = new PDO($dsn, $username, $password);



?>