<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: LogIn.html");
    exit();
}

echo "Welcome, " . $_SESSION['username'];
// Tambahkan konten dashboard admin di sini.
?>