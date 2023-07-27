// Event listener untuk tombol submit pada form
document.querySelector('form').addEventListener('submit', function (e) {
    e.preventDefault(); // Mencegah form submit secara default

    // Mendapatkan nilai input dari form
    var id = document.getElementById('id').value;
    var jamMasuk = document.getElementById('jam_masuk').value;
    var jamPulang = document.getElementById('jam_pulang').value;

    // Validasi jam masuk dan jam pulang
    var isValid = validateTime(jamMasuk) && validateTime(jamPulang);

    if (isValid) {
        // Mengirim data ke proses.php menggunakan AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'proses.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if (xhr.status === 200) {
                // Menampilkan notifikasi jika absen berhasil
                showNotification('Absen berhasil', 'success');
            } else {
                // Menampilkan notifikasi jika absen gagal
                showNotification('Absen gagal', 'error');
            }
        };
        xhr.send('id=' + id + '&jam_masuk=' + jamMasuk + '&jam_pulang=' + jamPulang);
    } else {
        alert('Format waktu tidak valid!');
    }
});

// Fungsi untuk memvalidasi format waktu
function validateTime(time) {
    var pattern = /^([01]\d|2[0-3]):([0-5]\d)$/; // Format HH:MM
    return pattern.test(time);
}

// Fungsi untuk menampilkan popup notifikasi
function showNotification(message, type) {
    Swal.fire({
        text: message,
        icon: type,
        showConfirmButton: false,
        timer: 2000
    });
}
