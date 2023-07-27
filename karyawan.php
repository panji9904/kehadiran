<?php
require_once('koneksi.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Nama Karyawan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="admin.php">Admin Panel</a>
    </nav>

    <main style="margin-top: 60px;">
        <div class="container">
            <h2>Daftar Nama Karyawan</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Query untuk mengambil data karyawan
                    $query = "SELECT * FROM karyawan";
                    $result = mysqli_query($conn, $query);

                    // Periksa hasil query
                    if ($result) {
                        // Loop melalui hasil query
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Format ID dengan leading zeros
                            $formattedId = sprintf("%03d", $row['id']);

                            echo "<tr>";
                            echo "<td>" . $formattedId . "</td>";
                            echo "<td>" . $row['nama'] . "</td>";
                            echo "<td>";
                            echo "<a href='edit.php?id=" . $row['id'] . "' class='btn btn-primary btn-sm'>Edit</a>";
                            echo "<button class='btn btn-danger btn-sm ml-2' onclick='hapusKaryawan(" . $row['id'] . ")'>Hapus</button>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "Error: " . mysqli_error($conn);
                    }
                    ?>
                </tbody>
            </table>
            <a href="tambah.php" class="btn btn-success">Tambah Karyawan</a>
        </div>
    </main>

    <script>
        // Fungsi untuk menampilkan popup konfirmasi hapus
        function hapusKaryawan(id) {
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Apakah Anda yakin ingin menghapus karyawan ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Mengirim permintaan hapus ke server
                    fetch('hapus.php?id=' + id)
                        .then(response => response.text())
                        .then(data => {
                            // Menampilkan pop-up bahwa data berhasil dihapus
                            Swal.fire({
                                title: 'Berhasil',
                                text: 'Data berhasil dihapus',
                                icon: 'success'
                            }).then(() => {
                                // Refresh halaman
                                window.location.reload();
                            });
                        })
                        .catch(error => {
                            console.error(error);
                            Swal.fire({
                                title: 'Error',
                                text: 'Terjadi kesalahan saat menghapus data',
                                icon: 'error'
                            });
                        });
                }
            });
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
