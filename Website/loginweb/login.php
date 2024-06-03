<?php
require 'vendor/autoload.php'; // Autoload untuk bcrypt jika menggunakan Composer

use Bcrypt\Bcrypt;

$bcrypt = new Bcrypt();

$username = $_POST['username'];
$password = $_POST['password'];

$servername = "localhost";
$dbname = "db_login_admin";
$dbusername = "root";
$dbpassword = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM admins WHERE username = :username";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin && $bcrypt->verify($password, $admin['password'])) {
        echo "Login successful. Welcome, " . $admin['username'];
    } else {
        echo "Invalid username or password";
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>