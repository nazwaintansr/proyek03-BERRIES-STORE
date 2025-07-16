<div class="row mb-3">
    <div class="col text-start">
        <?php
        //untuk produk yang mendekati kadaluarsa
        $queryKadaluarsa = "SELECT id, namabarang, tanggalkadaluarsa FROM barang WHERE tanggalkadaluarsa BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 3 MONTH)";
        $resultKadaluarsa = $mysqli->query($queryKadaluarsa);

        if ($resultKadaluarsa->num_rows > 0) {
            echo "<div class='alert alert-warning'>
                    <strong>Perhatian!</strong> Produk berikut akan kadaluarsa dalam waktu dekat:
                    <ul>";
            while ($rowKadaluarsa = $resultKadaluarsa->fetch_assoc()) {
                echo "<li>{$rowKadaluarsa['namabarang']} (Kadaluarsa: {$rowKadaluarsa['tanggalkadaluarsa']})</li>";
            }
            echo "</ul>
                  </div>";
        }

        //untuk produk dengan stok kurang dari 10
        $queryStok = "SELECT id, namabarang, stok FROM barang WHERE stok < 10";
        $resultStok = $mysqli->query($queryStok);

        if ($resultStok->num_rows > 0) {
            echo "<div class='alert alert-danger'>
                    <strong>Perhatian!</strong> Stok barang berikut kurang dari 10:
                    <ul>";
            while ($rowStok = $resultStok->fetch_assoc()) {
                echo "<li>{$rowStok['namabarang']} (Stok: {$rowStok['stok']})</li>";
            }
            echo "</ul>
                </div>";
        }

        ?>

        <h5 class="text-black">Data Produk</h5>
        <p>Pilih kategori untuk melihat data produk:</p>
    </div>
</div>

<!-- Kategori Buttons -->
<div class="row mb-3 justify-content-center">
    <div class="col-auto">
        <?php
        $kategoriParam = isset($_GET['kategori']) ? $_GET['kategori'] : '';
        $categories = ['Make Up', 'Skincare', 'Bodycare', 'Haircare', 'Parfum'];

        foreach ($categories as $cat) {
            if ($kategoriParam == $cat) {
                echo "<a href='?modul=barang' class='btn btn-theme mx-1 mb-1 text-black'>$cat</a>";
            } else {
                echo "<a href='?modul=barang&kategori=$cat' class='btn btn-theme mx-1 mb-1 text-black'>$cat</a>";
            }
        }
        ?>
    </div>
</div>

<!-- Form Filter dan Tombol "Tambah Produk" -->
<?php


if (isset($_GET['kategori'])) {
    $kategori = $_GET['kategori'];
    $filter = isset($_GET['filter']) ? $_GET['filter'] : '';
    ?>

    <div class="row mb-3 justify-content-between">
        <div class="col-auto">
            <a class="btn btn-theme btn-sm" href="?modul=form-tambah">Tambah Produk</a>
        </div>

        <div class="col-auto">
            <form action="" method="get" class="d-flex">
                <input type="hidden" name="modul" value="barang">
                <input type="hidden" name="kategori" value="<?php echo htmlspecialchars($kategori); ?>">

                <select name="filter" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                    <option value="">Filter Berdasarkan</option>
                    <option value="az" <?php echo $filter == 'az' ? 'selected' : ''; ?>>Nama A-Z</option>
                    <option value="za" <?php echo $filter == 'za' ? 'selected' : ''; ?>>Nama Z-A</option>
                    <option value="harga_asc" <?php echo $filter == 'harga_asc' ? 'selected' : ''; ?>>Harga: Murah ke Mahal</option>
                    <option value="harga_desc" <?php echo $filter == 'harga_desc' ? 'selected' : ''; ?>>Harga: Mahal ke Murah</option>
                    <option value="kadaluarsa_asc" <?php echo $filter == 'kadaluarsa_asc' ? 'selected' : ''; ?>>Tanggal Kadaluarsa: Paling Dekat</option>
                    <option value="kadaluarsa_desc" <?php echo $filter == 'kadaluarsa_desc' ? 'selected' : ''; ?>>Tanggal Kadaluarsa: Paling Jauh</option>
                </select>
            </form>
        </div>
    </div>

    <h6 class="bg-theme text-black p-2 text-center">Kategori: <?php echo htmlspecialchars($kategori); ?></h6>

    <!-- Tabel Produk -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="bg-theme text-black">
                <tr>
                    <th>ID</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Tanggal Masuk</th>
                    <th>Tanggal Kadaluarsa</th>
                    <th>Deskripsi</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $filter_query = "";
                if ($filter == 'az') {
                    $filter_query = " ORDER BY namabarang ASC";
                } elseif ($filter == 'za') {
                    $filter_query = " ORDER BY namabarang DESC";
                } elseif ($filter == 'harga_asc') {
                    $filter_query = " ORDER BY harga ASC";
                } elseif ($filter == 'harga_desc') {
                    $filter_query = " ORDER BY harga DESC";
                } elseif ($filter == 'kadaluarsa_asc') {
                    $filter_query = " ORDER BY tanggalkadaluarsa ASC";
                } elseif ($filter == 'kadaluarsa_desc') {
                    $filter_query = " ORDER BY tanggalkadaluarsa DESC";
                }

                $query = "SELECT * FROM barang WHERE kategori = '$kategori'" . $filter_query;
                $result = $mysqli->query($query);
                $cek_data = $result->num_rows;
                $id = 0;
                if ($cek_data == 0) {
                ?> 
                <tr>
                    <td colspan="7" class="text-center text-danger">Tidak Ada Data</td>
                </tr>
                <?php
                } else {
                    while ($row = $result->fetch_assoc()) {
                        $id++;
                        ?> 
                    <tr>
    <td><?php echo $id; ?></td>
    <td><?php echo strlen($row['namabarang']) > 20 ? substr($row['namabarang'], 0, 20) . '...' : $row['namabarang']; ?></td>
    <td>Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
    <td><?php echo $row['stok']; ?></td>
    <td><?php echo $row['tanggalmasuk']; ?></td>
    <td><?php echo $row['tanggalkadaluarsa']; ?></td>
    <td><?php echo strlen($row['deskripsi']) > 50 ? substr($row['deskripsi'], 0, 50) . '...' : $row['deskripsi']; ?></td>
    <td>
    <img src="uploads/<?php echo $row['gambar']; ?>" alt="<?php echo $row['namabarang']; ?>" width="50" height="50">
</td>

    <td>
        <a class="btn btn-sm btn-theme" href="<?= '?modul=form-edit&id=' . $row['id']; ?>">Edit</a>
        <a class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $row['id']; ?>" href="#">Hapus</a>

        <div class="modal fade" id="hapusModal<?= $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-theme text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus data ini? <strong><?= $row['namabarang']; ?></strong>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <a class="btn btn-theme" href="<?= 'modul/barang/proses.php?action=delete&id=' . $row['id']; ?>">Yakin</a>
                    </div>
                </div>
            </div>
        </div>
    </td>
</tr>

                        <?php    
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

<?php
} else {
    echo "<p class='text-center text-muted'></p>";
}
?>

<!-- Tombol Kembali ke Halaman Utama -->
<div class="row">
    <div class="col text-start">
        <a href="index.php" class="btn btn-secondary btn-sm">Kembali</a>
    </div>
</div>

<style>
    .text-black {
        color: #000000;
    }
    .btn-theme {
        background-color: rgba(245, 218, 223, 1); 
        border-color: rgba(245, 218, 223, 1);
        color: black; 
    }
    .btn-theme:hover {
        background-color: rgba(245, 150, 160, 1); 
        border-color: rgba(245, 150, 160, 1);
        color: black; 
    }


    .btn-danger {
        background-color: #000000;  
        border-color: #000000;    
        color: white;              
    }

    .btn-danger:hover {
        background-color: #333333;  
        border-color: #333333;  
        color: white;              
    }


    .bg-theme {
        background-color: rgba(245, 218, 223, 1); 
    }
    .table thead th {
        background-color: rgba(245, 218, 223, 1); 
        color: black; 
    }
    .modal-header.bg-theme {
        background-color: rgba(245, 218, 223, 1); 
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

    .table td {
        word-wrap: break-word;
    }
    .table td:nth-child(7) {
        max-width: 200px; 
        overflow: hidden; 
        text-overflow: ellipsis; 
        white-space: nowrap; 
    }

    .alert {
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 5px;
    }
    .alert-warning {
        background-color: #fff3cd;
        color: #856404;
        border-color: #ffeeba;
    }

    .alert {
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 5px;
}

.alert-warning {
    background-color: #fff3cd;
    color: #856404;
    border-color: #ffeeba;
}

.alert-danger {
    background-color: #f8d7da; 
    color: #721c24; 
    border-color: #f5c6cb; 
}



</style>
