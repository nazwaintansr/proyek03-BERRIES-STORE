<?php
include "koneksi.php";

$query = "SELECT * FROM barang WHERE id=$_GET[id]";
$result = $mysqli->query($query);
$row = $result->fetch_assoc();
?>
<div class="p-4 border rounded" style="background-color: #f9f9f9;">
    <h5 class="text-theme">Edit Produk</h5>
    <hr>
    <form action="<?= 'modul/barang/proses.php?action=update&id=' . $_GET['id']; ?>" method="post" enctype="multipart/form-data">
        
        <!-- Nama Barang -->
        <div class="row mb-3">
            <label for="namabarang" class="col-sm-3 col-form-label text-theme text-start">Nama Barang</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="namabarang" value="<?= $row['namabarang']; ?>" required />
            </div>
        </div>
        
        <!-- Harga -->
        <div class="row mb-3">
            <label for="harga" class="col-sm-3 col-form-label text-theme text-start">Harga</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="harga" value="<?= $row['harga']; ?>" required />
            </div>
        </div>

        <!-- Stok -->
        <div class="row mb-3">
            <label for="stok" class="col-sm-3 col-form-label text-theme text-start">Stok</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" name="stok" value="<?= $row['stok']; ?>" required />
            </div>
        </div>

        <!-- Kategori -->
        <div class="row mb-3">
            <label for="kategori" class="col-sm-3 col-form-label text-theme text-start">Kategori</label>
            <div class="col-sm-9">
                <select name="kategori" class="form-select" required>
                    <option <?= ($row['kategori'] == 'Skincare') ? 'selected' : ''; ?> value="Skincare">Skincare</option>
                    <option <?= ($row['kategori'] == 'Make Up') ? 'selected' : ''; ?> value="Make Up">Makeup</option>
                    <option <?= ($row['kategori'] == 'Bodycare') ? 'selected' : ''; ?> value="Bodycare">Bodycare</option>
                    <option <?= ($row['kategori'] == 'Haircare') ? 'selected' : ''; ?> value="Haircare">Haircare</option>
                    <option <?= ($row['kategori'] == 'Parfum') ? 'selected' : ''; ?> value="Parfum">Parfum</option>
                </select>
            </div>
        </div>

        <!-- Tanggal Masuk -->
        <div class="row mb-3">
            <label for="tanggalmasuk" class="col-sm-3 col-form-label text-theme text-start">Tanggal Masuk</label>
            <div class="col-sm-9">
                <input type="date" class="form-control" name="tanggalmasuk" value="<?= $row['tanggalmasuk']; ?>" required />
            </div>
        </div>

        <!-- Tanggal Kadaluarsa -->
        <div class="row mb-3">
            <label for="tanggalkadaluarsa" class="col-sm-3 col-form-label text-theme text-start">Tanggal Kadaluarsa</label>
            <div class="col-sm-9">
                <input type="date" class="form-control" name="tanggalkadaluarsa" value="<?= $row['tanggalkadaluarsa']; ?>" required />
            </div>
        </div>

        <!-- Deskripsi -->
        <div class="row mb-3">
            <label for="deskripsi" class="col-sm-3 col-form-label text-theme text-start">Deskripsi</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="deskripsi" value="<?= $row['deskripsi']; ?>" required />
            </div>
        </div>

        <!-- Gambar Produk -->
        <div class="row mb-3">
            <label for="gambar" class="col-sm-3 col-form-label text-theme text-start">Gambar Produk</label>
            <div class="col-sm-9">
                <div class="mb-3">
                    <img src="uploads/<?= $row['gambar']; ?>" alt="Gambar Produk" class="img-fluid rounded" style="max-height: 200px;">
                </div>
                <input type="file" class="form-control" name="gambar" />
                <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
            </div>
        </div>

        <!-- Tombol Update dan Tombol Batal -->
        <div class="row">
            <div class="col text-end"> 
                <button type="submit" class="btn btn-theme btn-small">Update</button>
                <button type="button" class="btn btn-secondary btn-small" onclick="history.back()">Batal</button> <!-- Tombol Batal -->
            </div>
        </div>
    </form>
</div>

<style>
     
    .text-theme {
        color: #000000;
        font-weight: bold;
    }

    .btn-theme {
        background-color: rgba(245, 218, 223, 1);
        border-color: rgba(245, 218, 223, 1);
        color: #000000;
    }

    .btn-theme:hover {
        background-color: rgba(245, 218, 223, 0.8);
        border-color: rgba(245, 218, 223, 0.8);
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

    .btn-small {
        padding: 6px 12px;
        font-size: 0.9rem;
    }

    .form-control, .form-select {
        font-size: 1rem;
        border-radius: 10px;
        border: 1px solid #ddd;
    }
</style>
