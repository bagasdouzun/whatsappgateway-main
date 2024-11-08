<?php
// Termasuk file koneksi dan pengaturan
include 'koneksi.php';
include 'pengaturan.php';

// Cek apakah form sudah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil nilai baru dari form
    $batas_masuk = $_POST['batas_masuk'];
    $batas_pulang = $_POST['batas_pulang'];

    // Validasi format waktu
    if (strtotime($batas_masuk) === false || strtotime($batas_pulang) === false) {
        echo "Format waktu tidak valid.";
    } else {
        // Simpan pengaturan baru ke dalam file pengaturan.php
        $file_pengaturan = 'pengaturan.php';

        // Membaca isi file pengaturan.php
        $content = file_get_contents($file_pengaturan);

        // Mengganti nilai batas waktu masuk dan pulang
        $content = preg_replace('/define\(\'BATAS_MASUK\', \'[0-9:\- ]+\'\);/', "define('BATAS_MASUK', '$batas_masuk');", $content);
        $content = preg_replace('/define\(\'BATAS_PULANG\', \'[0-9:\- ]+\'\);/', "define('BATAS_PULANG', '$batas_pulang');", $content);

        // Menulis kembali ke file
        if (file_put_contents($file_pengaturan, $content)) {
            echo "Pengaturan waktu berhasil diubah.";
        } else {
            echo "Gagal mengubah pengaturan.";
        }
    }
} else {
    // Menampilkan form dengan nilai default dari pengaturan
    $batas_masuk = BATAS_MASUK;
    $batas_pulang = BATAS_PULANG;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Pengaturan Waktu Absensi</title>
    <link rel="stylesheet" href="ubah_pengaturan_style.css">
</head>
<body>
    <h1>Ubah Pengaturan Waktu Absensi</h1>
    <form method="POST" action="ubah_pengaturan.php">
        <label for="batas_masuk">Batas Waktu Masuk:</label><br>
        <input type="time" id="batas_masuk" name="batas_masuk" value="<?php echo $batas_masuk; ?>" required><br><br>
        
        <label for="batas_pulang">Batas Waktu Pulang:</label><br>
        <input type="time" id="batas_pulang" name="batas_pulang" value="<?php echo $batas_pulang; ?>" required><br><br>
        
        <button type="submit">Simpan Pengaturan</button>
    </form>
</body>
</html>
