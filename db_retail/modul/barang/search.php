<?php
include "../../koneksi.php"; 

if (!isset($_GET['id'])) {
    echo "<p class='text-center text-danger'>Produk tidak ditemukan. ID tidak diberikan.</p>";
    exit;
}

$id = $_GET['id'];


$query = "SELECT * FROM barang WHERE id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();


if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    
    $gambarPath = '../../uploads/' . $row['gambar'];
    if (!file_exists($gambarPath) || empty($row['gambar'])) {
        $gambarPath = '../../uploads/default.png';
    }

    
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Detail Produk</title>
      
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container mt-4">
            <h3><?= htmlspecialchars($row['namabarang']) ?></h3>
            <img src="<?= $gambarPath ?>" alt="<?= htmlspecialchars($row['namabarang']) ?>" class="img-fluid">
            <p><strong>Kategori:</strong> <?= ucfirst(htmlspecialchars($row['kategori'])) ?></p>
            <p><strong>Harga:</strong> Rp <?= number_format($row['harga'], 0, ',', '.') ?></p>
            <p><strong>Stok:</strong> <?= $row['stok'] ?> pcs</p>
            <p><strong>Tanggal Masuk:</strong> <?= $row['tanggalmasuk'] ?></p>
            <p><strong>Tanggal Kadaluarsa:</strong> <?= $row['tanggalkadaluarsa'] ?></p>
            <p><strong>Deskripsi:</strong> <?= nl2br(htmlspecialchars($row['deskripsi'])) ?></p>
            <a href="<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'katalog.php' ?>" class="btn btn-secondary">Kembali</a>
        </div>
    </body>
    </html>
    <?php
} else {
    echo "<p class='text-center text-danger'>Produk tidak ditemukan.</p>";
}
?>
