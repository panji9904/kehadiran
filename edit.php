<?php
require_once('koneksi.php');

// Periksa apakah parameter ID telah diterima
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mendapatkan data karyawan berdasarkan ID
    $query = "SELECT * FROM karyawan WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    // Periksa hasil query
    if ($result) {
        // Periksa apakah data karyawan ditemukan
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $idKaryawan = $row['id'];
            $namaKaryawan = $row['nama'];
        } else {
            // Redirect jika data karyawan tidak ditemukan
            header("Location: admin.php");
            exit();
        }
    } else {
        echo "Error: " . mysqli_error($conn);
        exit();
    }
} else {
    // Redirect jika parameter ID tidak ditemukan
    header("Location: admin.php");
    exit();
}

// Proses update data karyawan
if (isset($_POST['submit'])) {
    $newIdKaryawan = $_POST['id_karyawan'];
    $newNamaKaryawan = $_POST['nama_karyawan'];

    // Query untuk mengupdate data karyawan
    $queryUpdate = "UPDATE karyawan SET id = '$newIdKaryawan', nama = '$newNamaKaryawan' WHERE id = '$id'";
    $resultUpdate = mysqli_query($conn, $queryUpdate);

    if ($resultUpdate) {
        echo "<script>
                window.onload = function() {
                    Swal.fire({
                        title: 'Berhasil',
                        text: 'Data berhasil diubah',
                        icon: 'success'
                    }).then(() => {
                        window.location.href = 'karyawan.php';
                    });
                }
             </script>";
    } else {
        echo "Error: " . mysqli_error($conn);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Karyawan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="admin.php">Admin Panel</a>
    </nav>

    <main style="margin-top: 60px;">
        <div class="container">
            <h2>Edit Data Karyawan</h2>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="id_karyawan">ID Karyawan:</label>
                    <input type="text" class="form-control" id="id_karyawan" name="id_karyawan" value="<?php echo $idKaryawan; ?>" required>
                </div>
                <div class="form-group">
                    <label for="nama_karyawan">Nama Karyawan:</label>
                    <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan" value="<?php echo $namaKaryawan; ?>" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
