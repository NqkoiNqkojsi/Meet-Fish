<?php
$servername = "localhost";
$username = "u157928248_fish";
$password = "8!d/Xn9K=gJ";
$dbname = "u157928248_fishing";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
echo "database conection";
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
