<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "crud_db");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data pengguna dari database
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengguna</title>
    <style>
        /* Gaya umum untuk body */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0e7f1; /* Latar belakang soft pink */
            margin: 0;
            padding: 0;
        }

        /* Container utama */
        .container {
            width: 80%;
            margin: 30px auto;
            background-color: #fff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Heading */
        h2 {
            text-align: center;
            color: #b36b7d;
            font-size: 2em;
            margin-bottom: 20px;
        }

        /* Tombol Tambah Pengguna Baru */
        .add-btn {
            display: block;
            width: 200px;
            padding: 12px;
            background-color: #f4a3d9;
            color: white;
            text-align: center;
            text-decoration: none;
            font-size: 1.1em;
            border-radius: 8px;
            margin: 20px auto;
            transition: background-color 0.3s ease;
        }

        .add-btn:hover {
            background-color: #e68fbf;
        }

        /* Tabel */
        .table-container {
            margin-top: 20px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
        }

        th, td {
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #fbe3f0;
            color: #b36b7d;
        }

        tr:nth-child(even) {
            background-color: #f9e9f2;
        }

        /* Tautan Edit dan Hapus */
        .action-links {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .btn-edit, .btn-delete {
            padding: 8px 16px;
            text-decoration: none;
            font-size: 14px;
            border-radius: 6px;
            color: white;
            transition: background-color 0.3s ease;
        }

        .btn-edit {
            background-color: #f4a3d9;
        }

        .btn-edit:hover {
            background-color: #e68fbf;
        }

        .btn-delete {
            background-color: #b36b7d;
        }

        .btn-delete:hover {
            background-color: #9e4f66;
        }

        /* Responsivitas */
        @media (max-width: 768px) {
            .container {
                width: 90%;
            }

            table {
                font-size: 14px;
            }

            .add-btn {
                font-size: 1em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Daftar Pengguna</h2>

        <!-- Tombol untuk menambah pengguna baru -->
        <a href="create.php" class="add-btn">Tambah Pengguna Baru</a>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['phone'] . "</td>";
                            echo "<td class='action-links'>
                                    <a href='update.php?id=" . $row['id'] . "' class='btn-edit'>Edit</a>
                                    <a href='delete.php?id=" . $row['id'] . "' class='btn-delete'>Hapus</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Tidak ada data pengguna</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php $conn->close(); ?>
</body>
</html>
