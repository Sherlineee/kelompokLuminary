<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Result</title>
    <link href="https://fonts.googleapis.com/css2?family=Judson:ital,wght@0,400;0,900;1,400&display=swap" rel="stylesheet">
    <style>
        body{
            display: block;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #ebedec;
        }
        .container a{
            height: 30px;
            width: 60px;
            background-color: #a3a9b0;
            border-radius: 10px;
            position: absolute;
            left: 48%;
            top: 20rem;
        }
        .link{
            text-align: center;
            top: 15rem;
            text-decoration: none;
            padding: 3px;
            font-size: 20px;
            font-weight: 300;    /* utk ketebalan font*/
            color: #000000;
        }
        .error-message {
            padding-top: 10rem;
            text-align: center;
            color: #000000;
             
        }
        .error-message1 {
            text-align: center;
            color: #000000;
        }
    </style>
</head>
<body>
    <section class="container">
        <a class="link" href="http://localhost/Website/Login.html">Back</a>
    </section>

    <?php
    include('db.php');
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Mengambil data dari formulir login
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Membuat pernyataan SQL untuk memeriksa kredensial login
        $stmt = $conn->prepare("SELECT id, username, password FROM admin WHERE username = ?");
        $stmt->bind_param("s", $username);

        // Menjalankan pernyataan dan memeriksa keberhasilan eksekusi
        if ($stmt->execute()) {
            // Mengambil hasil dari pernyataan
            $result = $stmt->get_result();
            // Memeriksa apakah baris ditemukan
            if ($result->num_rows == 1) {
                // Mengambil data pengguna
                $row = $result->fetch_assoc();
                // Memeriksa kebenaran password
                if (password_verify($password, $row['password'])) {
                    // Kredensial benar, arahkan ke halaman admin
                    session_start();
                    $_SESSION['admin_id'] = $row['id'];
                    $_SESSION['admin_username'] = $row['username'];
                    header("Location: admin_dashboard.php");
                    exit();
                } else {
                    // Password salah
                    echo "<p class='error-message'>Your Password is Wrong</p>",
                    "<p class='error-message1'>Please Check Again</p>"
                    ;
                }
            } else {
                // Username tidak ditemukan
                echo "<p class='error-message'>Username tidak ditemukan.</p>";
            }
        } else {
            // Gagal mengeksekusi pernyataan SQL
            echo "<p class='error-message'>Terjadi kesalahan dalam proses login.</p>";
        }

        // Menutup pernyataan dan koneksi database
        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>