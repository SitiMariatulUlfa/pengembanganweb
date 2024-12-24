<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "crud_db");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses form jika data dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Query untuk menyimpan data pengguna baru
    $sql = "INSERT INTO users (name, email, phone) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $phone);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Redirect ke index.php setelah sukses
        header("Location: index.php");
        exit();
    } else {
        echo "Error: Data gagal disimpan.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengguna</title>
</head>
<body>
    <h2>Tambah Pengguna Baru</h2>
    <form method="POST">
        <label for="name">Nama:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="phone">Telepon:</label>
        <input type="text" id="phone" name="phone" required><br>

        <button type="submit">Simpan</button>
    </form>
    <br>
    <a href="index.php">Kembali ke Daftar Pengguna</a>
</body>
</html>

<?php $conn->close(); ?>
