<?php
require_once('koneksi.php');

// Inisialisasi variabel tanggal dengan nilai default
$tanggal = date('Y-m-d');
$data_not_found = false;

// Jika tombol cari diklik, ambil tanggal dari input
if (isset($_POST['cari'])) {
    $tanggal = $_POST['tanggal'];
}

// Jika tombol cetak diklik
if (isset($_POST['cetak'])) {
    // Query untuk memeriksa apakah ada data kehadiran pada tanggal yang dipilih
    $query_check_data = "SELECT * FROM kehadiran WHERE tanggal = '$tanggal'";
    $result_check_data = mysqli_query($conn, $query_check_data);

    if (mysqli_num_rows($result_check_data) === 0) {
        $data_not_found = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Laporan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="admin.php">Admin Panel</a>
    </nav>

    <main style="margin-top: 60px;">
        <div class="container">
            <h2>Form Laporan</h2>
           <form method="POST" action="laporan.php">
            <div class="form-group">
                <label for="tanggal">Tanggal:</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $tanggal; ?>">
            </div>
            <button type="submit" class="btn btn-primary" name="cari">Cari</button>
            <?php
            if (!$data_not_found) {
                // Tampilkan tombol Cetak Laporan hanya jika data ditemukan
                echo '<a class="btn btn-primary" href="cetak_laporan.php?tanggal=' . $tanggal . '">Cetak Laporan</a>';
            }
            ?>
           </form>

            <?php
            // Tampilkan pesan data tidak ditemukan jika kondisi terpenuhi
            if ($data_not_found) {
                echo "<p>Data tidak ditemukan pada tanggal tersebut.</p>";
            } else {
            ?>
            <h2>Tabel Laporan</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Kehadiran</th>
                        <th>Jumlah Keterlambatan</th>
                        <th>Jumlah Pulang Cepat</th>
                        <th>Jumlah Lembur</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Query untuk mengambil data laporan dengan join antara tabel karyawan dan kehadiran
                    $query = "SELECT karyawan.id, karyawan.nama, COUNT(kehadiran.id_karyawan) AS jumlah_kehadiran, SUM(kehadiran.keterlambatan) AS keterlambatan, SUM(kehadiran.pulang_cepat) AS pulang_cepat, SUM(kehadiran.lembur) AS lembur FROM karyawan LEFT JOIN kehadiran ON karyawan.id = kehadiran.id_karyawan WHERE kehadiran.tanggal = '$tanggal' GROUP BY karyawan.id, karyawan.nama";
                    $result = mysqli_query($conn, $query);

                    // Periksa hasil query
                    if ($result && mysqli_num_rows($result) > 0) {
                        // Loop melalui hasil query
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['nama'] . "</td>";
                            echo "<td>" . $row['jumlah_kehadiran'] . "</td>";
                            echo "<td>" . $row['keterlambatan'] . " menit</td>";
                            echo "<td>" . $row['pulang_cepat'] . " menit</td>";
                            echo "<td>" . $row['lembur'] . " menit</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>Tidak ada data laporan</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <?php } ?>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
