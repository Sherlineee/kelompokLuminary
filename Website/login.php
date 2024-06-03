<?php
session_start();
include('config.php');
$konesksi = mysql_connect("localhost", "root", "", "admin_login_db")
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Escape input to prevent SQL Injection
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    $sql = "SELECT id, password FROM admins WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin_login'] = $username;
            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo "Invalid username or password";
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>