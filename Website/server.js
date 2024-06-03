

const mysql = require('mysql');
const readline = require('readline');

// Buat koneksi ke basis data
const connection = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: 'srzenez',
  database: 'admin_login_db'
});

// Middleware untuk mengizinkan parsing JSON
app.use(express.json());

// Endpoint untuk login admin
app.post('/login', (req, res) => {
  const { username, password } = req.body;
  const query = `SELECT * FROM admin WHERE username = ? AND password = ?`;
  connection.query(query, [username, password], (err, results) => {
    if (err) {
      console.error('Error:', err);
      res.status(500).send('Server Error');
    } else {
      if (results.length > 0) {
        res.send('Login berhasil');
      } else {
        res.status(401).send('Login gagal');
      }
    }
  });
});

// Mulai server
app.listen(port, () => console.log(`Server berjalan di http://localhost:${port}`));
