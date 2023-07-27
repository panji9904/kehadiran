<?php
require_once('koneksi.php');

// Periksa apakah parameter id ada dalam URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus karyawan berdasarkan ID
    $query = "DELETE FROM karyawan WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Redirect kembali ke halaman index.php setelah menghapus data
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "ID tidak valid";
}
?>
