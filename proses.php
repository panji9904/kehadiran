<?php
// Mendapatkan data absensi dari form
$id = $_POST['id'];
$nama = $_POST['nama'];
$jamMasuk = $_POST['jam_masuk'];
$jamPulang = $_POST['jam_pulang'];

// Menghitung jumlah keterlambatan
$jamMasukSplit = explode(':', $jamMasuk);
$jamMasukHour = intval($jamMasukSplit[0]);
$jamMasukMinute = intval($jamMasukSplit[1]);
$jamMasukTotalMinutes = ($jamMasukHour * 60) + $jamMasukMinute;
$keterlambatan = max(0, $jamMasukTotalMinutes - (8 * 60)); // Menghitung selisih dengan jam masuk yang diharapkan (08:00)

// Menghitung jumlah pulang cepat
$pulangCepat = 0;
if (!empty($jamPulang)) {
    $jamPulangSplit = explode(':', $jamPulang);
    $jamPulangHour = intval($jamPulangSplit[0]);
    $jamPulangMinute = intval($jamPulangSplit[1]);
    $jamPulangTotalMinutes = ($jamPulangHour * 60) + $jamPulangMinute;
    
    if ($jamPulangTotalMinutes < (17 * 60)) { // Memastikan jam pulang sebelum pukul 17:00
        $pulangCepat = max(0, (17 * 60) - $jamPulangTotalMinutes); // Menghitung selisih dengan jam pulang yang diharapkan (17:00)
    }
}

// Menghitung jumlah lembur
$lembur = 0;
if ($jamPulangTotalMinutes > (17 * 60)) { // Memastikan jam pulang setelah pukul 17:00
    $lembur = $jamPulangTotalMinutes - (17 * 60); // Menghitung selisih dengan jam pulang yang diharapkan (17:00)
}

// Simpan data absensi ke database
require_once('koneksi.php'); // Menggunakan file koneksi.php untuk melakukan koneksi ke database

// Mendapatkan tanggal saat ini
$tanggal = date('Y-m-d');

// Cek apakah sudah ada entri absen dengan tanggal yang sama
$queryCheckAttendance = "SELECT * FROM kehadiran WHERE id_karyawan = '$id' AND tanggal = '$tanggal'";
$resultCheckAttendance = mysqli_query($conn, $queryCheckAttendance);
$attendanceCount = mysqli_num_rows($resultCheckAttendance);

if ($attendanceCount == 0) {
    // Jika belum ada entri absen, lakukan proses absen datang
    $query = "INSERT INTO kehadiran (id_karyawan, tanggal, jam_masuk, keterlambatan) 
              VALUES ('$id', '$tanggal', '$jamMasuk', $keterlambatan)";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Menampilkan pesan sukses jika data berhasil disimpan
        echo "<script>
                  alert('Absen datang berhasil disimpan');
                  window.location.href = 'index.php';
              </script>";
        exit; // Menghentikan eksekusi script setelah mengarahkan halaman
    } else {
        // Menampilkan pesan error jika terjadi masalah saat menyimpan data
        echo "<script>
                  alert('Absen datang gagal disimpan');
                  window.history.back();
              </script>";
        exit; // Menghentikan eksekusi script setelah menampilkan pesan
    }
} else {
    // Jika sudah ada entri absen, lakukan proses absen pulang
    $query = "UPDATE kehadiran SET jam_pulang = '$jamPulang', pulang_cepat = $pulangCepat, lembur = $lembur WHERE id_karyawan = '$id' AND tanggal = '$tanggal'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Menampilkan pesan sukses jika data berhasil disimpan
        echo "<script>
                  alert('Absen pulang berhasil disimpan');
                  window.location.href = 'index.php';
              </script>";
        exit; // Menghentikan eksekusi script setelah mengarahkan halaman
    } else {
        // Menampilkan pesan error jika terjadi masalah saat menyimpan data
        echo "<script>
                  alert('Absen pulang gagal disimpan');
                  window.history.back();
              </script>";
        exit; // Menghentikan eksekusi script setelah menampilkan pesan
    }
}

// Menutup koneksi database
mysqli_close($conn);
?>
