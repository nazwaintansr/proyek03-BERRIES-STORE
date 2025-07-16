<?php
include "../../koneksi.php"; 

if (isset($_GET['search'])) {
    $search = $_GET['search'];

    $query = "SELECT * FROM barang WHERE namabarang LIKE ?";
    $stmt = $mysqli->prepare($query);
    $searchTerm = "%" . $search . "%";
    $stmt->bind_param("s", $searchTerm);
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
            
 
            <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

        
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

            <style>
                body {
                    display: flex;
                    flex-direction: column;
                    min-height: 100vh;
                    background-color: #f5dada; 
                    font-family: 'Poppins', sans-serif;
                }

                .container {
                    background-color: white; 
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                    flex-grow: 1;  
                }

                .btn-theme {
                    background-color: #f0f0f0;
                    border-color: #ddd;     
                    color: #495057;              
                    font-size: 14px;          
                    padding: 5px 10px;        
                }

                .btn-theme:hover {
                    background-color: #e0e0e0;
                    border-color: #f5dada;   
                    color: white;           
                }

                .header {
                    background-color: #f5dada; 
                    color: black; 
                    padding: 20px 20px;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    z-index: 100;
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                }

                .header h1 {
                    margin: 0;
                    font-size: 1.5rem;
                    font-weight: 600;
                    flex-grow: 1;
                    text-align: center;
                }

                footer {
                    background-color: #f5dada; 
                    color: black;  
                    text-align: center;
                    padding: 20px 0;
                    width: 100%;
                    margin-top: auto; 
                }

                .row {
                    margin-top: 30px;
                }

                .product-name {
                    font-weight: bold;
                    font-size: 1.2rem;  
                }

                .product-details {
                    font-size: 0.9rem; 
                }
            </style>
        </head>
        <body>
           
            <div class="header">
                <h1>BERRIES STORE</h1>
            </div>

            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-4">
                        <img src="<?= $gambarPath ?>" class="img-fluid" alt="<?= $row['namabarang'] ?>">
                    </div>
                    <div class="col-md-8">
                        <br><h3 class="product-name"><?= $row['namabarang'] ?></h3> <br>
                        <p class="product-details"><strong>Kategori:</strong> <?= ucfirst($row['kategori']) ?></p>
                        <p class="product-details"><strong>Harga:</strong> Rp <?= number_format($row['harga'], 0, ',', '.') ?></p>
                        <p class="product-details"><strong>Stok:</strong> <?= $row['stok'] ?> pcs</p>
                        <p class="product-details"><strong>Tanggal Masuk:</strong> <?= $row['tanggalmasuk'] ?></p>
                        <p class="product-details"><strong>Tanggal Kadaluarsa:</strong> <?= $row['tanggalkadaluarsa'] ?></p>
                        <p class="product-details"><strong>Deskripsi:</strong> <?= nl2br($row['deskripsi']) ?></p>
                        <a href="<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'katalog.php' ?>" class="btn btn-theme">Kembali</a>
                    </div>
                </div>
            </div>
            <footer>
                © 2024 Berries Store Kecantikan dan Perawatan Kulit - All Rights Reserved
            </footer>
        </body>
        </html>
        <?php
    } else {
        echo "<p class='text-center text-danger'>Produk tidak ditemukan.</p>";
    }
} else {
    echo "<p class='text-center text-danger'>Produk tidak ditemukan.</p>";
}
?>