<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Absensi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <!-- Navbar -->
        <nav class="navbar fixed-top navbar-dark bg-dark navbar-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="absen.php">
                    <img src="img/kb.jpg" alt="Logo" class="logo-img" style="width: 140px; height: auto; margin-right: 10px;">
                </a>
                <span class="mr-auto">
                    <a href="index.php" class="text-white">Home</a>
                </span>
                <span class="text-white">Karyawan Panel</span>
            </div>
        </nav>
    </header>

    <main style="margin-top: 100px;">
        <section class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="card shadow">
                            <div class="card-body">
                                <h2 class="card-title text-center">Absensi Kedatangan</h2>
                                <form action="proses.php" method="POST">
                                    <div class="form-group">
                                        <label for="id">ID Karyawan:</label>
                                        <input type="text" class="form-control" id="id" name="id" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Nama:</label>
                                        <input type="text" class="form-control" id="nama" name="nama" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal:</label>
                                        <input type="text" class="form-control" id="tanggal" name="tanggal" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="jam_masuk">Jam Masuk:</label>
                                        <input type="time" class="form-control" id="jam_masuk" name="jam_masuk" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Event listener untuk tombol submit pada form
        document.querySelector('form').addEventListener('submit', function (e) {
            e.preventDefault(); // Mencegah form submit secara default

            // Mendapatkan nilai input dari form
            var id = document.getElementById('id').value;
            var nama = document.getElementById('nama').value;
            var jamMasuk = document.getElementById('jam_masuk').value;

            // Mengirim data ke proses.php menggunakan AJAX
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'proses.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (xhr.status === 200) {
                    // Menampilkan notifikasi jika absen berhasil
                    showNotification('Absen berhasil', 'success', function() {
                        window.location.href = 'index.php'; // Mengarahkan halaman ke index.php setelah mengklik OK pada notifikasi
                    });
                } else {
                    // Menampilkan notifikasi jika absen gagal
                    showNotification('Absen gagal', 'error');
                }
            };
            xhr.send('id=' + id + '&nama=' + nama + '&jam_masuk=' + jamMasuk);
        });

        // Fungsi untuk menampilkan popup notifikasi
        function showNotification(message, type, callback) {
            Swal.fire({
                text: message,
                icon: type,
                showConfirmButton: true,
            }).then(function(result) {
                if (result.isConfirmed && typeof callback === 'function') {
                    callback(); // Memanggil callback jika tombol OK diklik
                }
            });
        }

        // Mengisi input tanggal dengan tanggal saat ini
        var currentDate = new Date();
        var currentYear = currentDate.getFullYear();
        var currentMonth = (currentDate.getMonth() + 1).toString().padStart(2, '0');
        var currentDay = currentDate.getDate().toString().padStart(2, '0');

        document.getElementById('tanggal').value = currentYear + '-' + currentMonth + '-' + currentDay;

        // Mengisi input jam_masuk dengan waktu saat ini
        var currentDateTime = new Date();
        var currentHour = currentDateTime.getHours().toString().padStart(2, '0');
        var currentMinute = currentDateTime.getMinutes().toString().padStart(2, '0');

        document.getElementById('jam_masuk').value = currentHour + ':' + currentMinute;
    </script>
</body>
</html>
