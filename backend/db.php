<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pokemon_cms";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
