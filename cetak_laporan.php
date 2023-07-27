<?php
require_once('koneksi.php');

// Periksa apakah parameter tanggal ada dalam URL
if (isset($_GET['tanggal'])) {
    $tanggal = $_GET['tanggal'];

    // Query untuk mengambil data laporan dengan join antara tabel karyawan dan kehadiran
    $query = "SELECT karyawan.id, karyawan.nama, COUNT(kehadiran.id_karyawan) AS jumlah_kehadiran, SUM(kehadiran.keterlambatan) AS keterlambatan, SUM(kehadiran.pulang_cepat) AS pulang_cepat, SUM(kehadiran.lembur) AS lembur FROM karyawan LEFT JOIN kehadiran ON karyawan.id = kehadiran.id_karyawan WHERE kehadiran.tanggal = '$tanggal' GROUP BY karyawan.id, karyawan.nama";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
?>
        <!DOCTYPE html>
        <html>
        <head>
            <!-- SweetAlert library CSS -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
            <meta charset="UTF-8">
            <title>Laporan</title>
            <style>
                table {
                    border-collapse: collapse;
                    margin: 0 auto; /* Untuk mengatur tabel agar berada di tengah halaman */
                }
                table th, table td {
                    border: 1px solid black;
                    padding: 8px;
                }
                .center {
                    text-align: center;
                }
            </style>
        </head>
        <body>
            <h1 class="center">Laporan Absensi Karyawan</h1>
            <h2 class="center">Tanggal <?php echo $tanggal; ?></h2>
            <table>
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
                    ?>
                </tbody>
            </table>

            <script>
                window.onload = function() {
                    window.print(); // Memicu pencetakan halaman saat halaman selesai dimuat
                }
            </script>
        </body>
        </html>
<?php
        exit;
    } else {
        // Data tidak ditemukan, tampilkan SweetAlert
        echo '<script>alert("Tidak ada data laporan pada tanggal tersebut");</script>';
        // Redirect kembali ke halaman sebelumnya (misalnya halaman laporan.php)
        echo '<script>window.history.back();</script>';
    }
} else {
    // Tidak ada tanggal yang dipilih, tampilkan SweetAlert
    echo '<script>alert("Tanggal tidak valid");</script>';
    // Redirect kembali ke halaman sebelumnya (misalnya halaman laporan.php)
    echo '<script>window.history.back();</script>';
}
?>
