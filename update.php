<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "crud_db");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Periksa apakah ID ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Validasi ID untuk memastikan adalah angka
    if (!is_numeric($id)) {
        die("ID tidak valid.");
    }

    // Ambil data pengguna berdasarkan ID
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $email = $row['email'];
        $phone = $row['phone'];
    } else {
        die("Data tidak ditemukan.");
    }
    $stmt->close();
}

// Proses form update jika ada data POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Update data berdasarkan ID
    $sql = "UPDATE users SET name = ?, email = ?, phone = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $email, $phone, $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Redirect ke halaman utama setelah update
        header("Location: index.php");
        exit();
    } else {
        echo "Error: Data gagal diperbarui.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data Pengguna</title>
</head>
<body>
    <h2>Update Pengguna</h2>
    <form method="POST">
        <label for="name">Nama:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required><br>

        <label for="phone">Telepon:</label>
        <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>" required><br>

        <button type="submit">Update</button>
    </form>
    <br>
    <a href="index.php">Kembali ke Daftar Pengguna</a>
</body>
</html>

<?php $conn->close(); ?>
