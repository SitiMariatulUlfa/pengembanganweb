<?php
// koneksi ke database
$conn = new mysqli("localhost" , "root" , "" , "crud_db");
if ($conn->connect_error) {
    die("koneksi gagal: " .$conn->connect_error);
}
?>