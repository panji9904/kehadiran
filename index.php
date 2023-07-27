<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karyawan Panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navbar -->
   <!-- Navbar -->
<nav class="navbar fixed-top navbar-dark bg-dark navbar-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="">
            <img src="img/kb.jpg" alt="Logo" class="logo-img" style="width: 140px; height: auto; margin-right: 10px;">
        </a>
        <div class="d-flex align-items-center mr-auto">
            <a href="index.php" class="text-white nav-link">Home</a>
            <a href="about.php" class="text-white nav-link">About</a>
            
            <div class="dropdown ml-3">
                <a class="text-white dropdown-toggle" href="#" role="button" id="absenDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Absen
                </a>
                <div class="dropdown-menu" aria-labelledby="absenDropdown">
                    <a class="dropdown-item" href="datang.php">Absen Datang</a>
                    <a class="dropdown-item" href="pulang.php">Absen Pulang</a>
                </div>
            </div>
        </div>
        <span class="text-white">Karyawan Panel</span>
    </div>
</nav>

<!-- Konten Admin -->
<div class="container-fluid">
    <div class="text-center">
        <h1>Selamat datang, Karyawan!</h1>
        <p>Di sini Anda dapat Inputkan kehadiran Anda</p>
        <!-- Tambahkan konten admin lainnya di sini -->
    </div>
</div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
