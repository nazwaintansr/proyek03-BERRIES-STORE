<?php
include "koneksi.php";

if (!isset($_GET['kategori'])) {
    echo "<p class='text-center text-danger'>Kategori tidak ditemukan.</p>";
    exit;
}

$kategori = $_GET['kategori'];

$query = "SELECT * FROM barang WHERE kategori = '$kategori'";
$result = $mysqli->query($query);


echo "<h3 class='text-center text-theme'>Katalog Produk " . ucfirst($kategori) . "</h3>";

if ($result && mysqli_num_rows($result) > 0) {
    echo '<div class="row row-cols-1 row-cols-md-4 g-4">';
    while ($row = mysqli_fetch_assoc($result)) {
        $gambarPath = 'uploads/' . $row['gambar'];

        if (!file_exists($gambarPath) || empty($row['gambar'])) {
            $gambarPath = 'uploads/default.png'; 
        }

        echo '
            <div class="col">
                <div class="card h-100"> <!-- h-100 untuk membuat card memiliki tinggi yang sama -->
                    <img src="' . $gambarPath . '" class="card-img-top" alt="' . $row['namabarang'] . '">
                    <div class="card-body">
                        <h5 class="card-title text-theme">' . $row['namabarang'] . '</h5>
                        <p class="card-text">Rp ' . number_format($row['harga'], 0, ',', '.') . '</p>
                       <a href="modul/barang/deskripsi.php?id=' . $row['id'] . '" class="btn btn-theme">Lihat Detail</a>
                    </div>
                </div>
            </div>';
    }
    echo '</div>';
} else {
    echo "<p class='text-center text-theme'>Belum ada produk di kategori ini.</p>";
}
?>

<!-- Tombol Kembali ke Halaman Utama -->
<div class="row">
    <div class="col text-start">
        <a href="index.php" class="btn btn-secondary btn-sm">Kembali</a>
    </div>
</div>

<style>
    .text-theme {
        color: #000000;
    }

    .btn-theme {
        background-color: #f5dada; 
        border-color: #f5dada;   
        color: black;             
    }

    .btn-theme:hover {
        background-color: black;  
        border-color: #f5dada;  
        color: #f5dada;          
    }

    .bg-theme {
        background-color: #f78fb3; 
    }

    .table thead th {
        background-color: #f78fb3; 
        color: white;
    }

    .modal-header.bg-theme {
        background-color: #f78fb3; 
    }

    .btn-secondary {
        background-color: #f0f0f0;
        border-color: #ddd;
        color: #495057;
    }

    .btn-secondary:hover {
        background-color: #e0e0e0;
        border-color: #ccc;
    }


    .card {
        display: flex;
        flex-direction: column;
        height: 100%; 
    }

    .card-img-top {
        object-fit: cover;
        width: 100%;
        aspect-ratio: 1 / 1; 
    }

    .card-body {
        flex-grow: 1; 
        display: flex;
        flex-direction: column;
        justify-content: space-between; 
    }

    .card-title {
        font-size: 1rem;
        text-align: left; 
        margin-bottom: 0.5rem; 
    }

    .card-text {
        font-size: 0.9rem;
        text-align: left; 
        margin-bottom: 1rem; 
    }
</style>

