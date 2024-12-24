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

    // Query untuk menghapus data pengguna berdasarkan ID
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Redirect ke index.php setelah data dihapus
        header("Location: index.php");
        exit();
    } else {
        echo "Error: Data gagal dihapus atau tidak ditemukan.";
    }

    $stmt->close();
} else {
    echo "ID tidak ditemukan.";
}

$conn->close();
?>
