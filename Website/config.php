<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admin_login_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$hashed_password = password_hash('your_password', PASSWORD_DEFAULT);
$sql = "INSERT INTO admins (username, password) VALUES ('admin_username', '$hashed_password')";
?>