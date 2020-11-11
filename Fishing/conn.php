<?php
$servername = "localhost";
$username = "id12821943_root";
$password = "12345";
$dbname = "id12821943_fishing";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>