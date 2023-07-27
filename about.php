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
            <a href="index.php" class="text-white nav-link">About</a>
            
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
        <h1>History</h1>
        <p>PT. KB Insurance Indonesia is a general Insurance company. It was founded in 1997 under the name PT. LG Simas Insurance Indonesia, and was renamed PT. KB Insurance Indonesia in 2015. KB Insurance aspires to become the best Insurance firm in customer preference by offering both optimum insurance coverage and comprehensive financial services. With experience in the insurance industry, KB Insurance provides a range of general insurance products and innovative services to match customer needs. Our insurance products are supported by reputable reinsurance companies both at home and abroad. The company is also committed to providing quality service to the customers through its marketing network, which encompasses the Head Office in Jakarta and the Representative Office in Surabaya, supported in its operations by reliable human resources that are qualified both locally and internationally.</p>
        
        <p>In accordance with its mission, the company continues to innovate and develop information technology to support its services for customers and other stakeholders. Such efforts will not cease by the accomplishments made thus far. We continue to perform our role as a risk caretaker for our clients, both globally and locally. In addition, we will continuously invest in building up infrastructure to broaden and deepen customer services, which will be accompanied by higher professionalism of employees. The Management envisions that customer satisfaction can be achieved only when all efforts from employees and management are combined. To this end, we focus on dedicating our corporate competencies to customer satisfaction and mobilize all the available resources to improve our services.</p>
        
        <p>PT KB Insurance Indonesia is already registered and supervised by OJK with permit license KEP-547/NB.1/2015.</p>
    </div>
</div>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
