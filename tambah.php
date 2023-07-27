<?php
require_once('koneksi.php');

// Variabel untuk menyimpan pesan validasi atau notifikasi
$message = '';

// Proses tambah data karyawan
if (isset($_POST['submit'])) {
    $idKaryawan = $_POST['id'];
    $namaKaryawan = $_POST['nama'];

    // Format ID dengan leading zeros
    $formattedId = sprintf("%03d", $idKaryawan);

    // Query untuk menambahkan data karyawan ke tabel "karyawan"
    $queryKaryawan = "INSERT INTO karyawan (id_karyawan, nama) VALUES ('$formattedId', '$namaKaryawan')";
    $resultKaryawan = mysqli_query($conn, $queryKaryawan);

    if (!$resultKaryawan) {
        echo "Error: " . mysqli_error($conn);
        exit();
    }

    // Menyimpan pesan notifikasi
    $message = "Data berhasil disimpan";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Karyawan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="admin.php">Admin Panel</a>
    </nav>

    <main style="margin-top: 60px;">
        <div class="container">
            <h2>Tambah Data Karyawan</h2>
            <?php if ($message) { ?>
                <script>
                    Swal.fire({
                        title: 'Sukses',
                        text: '<?php echo $message; ?>',
                        icon: 'success'
                    }).then(() => {
                        // Redirect ke halaman admin setelah mengklik tombol "OK"
                        window.location.href = 'karyawan.php';
                    });
                </script>
            <?php } ?>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="id">ID Karyawan:</label>
                    <input type="text" class="form-control" id="id" name="id" required>
                </div>
                <div class="form-group">
                    <label for="nama">Nama Karyawan:</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
