<?php
$query = "SELECT * FROM karyawan WHERE id=$_GET[id]";
$result = $mysqli->query($query);
$row = $result->fetch_assoc();
?>
<div class="p-4 border rounded" style="background-color: #f9f9f9;">
    <h5 class="text-black">Edit Karyawan</h5> 
    <hr>
    <form action="<?= 'modul/karyawan/proses.php?action=update&id=' . $_GET['id']; ?>" method="post">
        
        <!-- Nama Karyawan -->
        <div class="row mb-3">
            <label for="nama" class="col-sm-3 col-form-label text-black text-start">Nama Karyawan</label> 
            <div class="col-sm-9">
                <input type="text" class="form-control" name="nama" value="<?= $row['nama']; ?>" required />
            </div>
        </div>
        
        <!-- Jabatan -->
        <div class="row mb-3">
            <label for="jabatan" class="col-sm-3 col-form-label text-black text-start">Jabatan</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="jabatan" value="<?= $row['jabatan']; ?>" required />
            </div>
        </div>

        <!-- Alamat -->
        <div class="row mb-3">
            <label for="alamat" class="col-sm-3 col-form-label text-black text-start">Alamat</label> 
            <div class="col-sm-9">
                <input type="text" class="form-control" name="alamat" value="<?= $row['alamat']; ?>" required />
            </div>
        </div>

        <!-- Telepon -->
        <div class="row mb-3">
            <label for="telepon" class="col-sm-3 col-form-label text-black text-start">Telepon</label> 
            <div class="col-sm-9">
                <input type="number" class="form-control" name="telepon" value="<?= $row['telepon']; ?>" required />
            </div>
        </div>

        <!-- Email -->
        <div class="row mb-3">
            <label for="email" class="col-sm-3 col-form-label text-black text-start">Email</label> 
            <div class="col-sm-9">
                <input type="text" class="form-control" name="email" value="<?= $row['email']; ?>" required />
            </div>
        </div>

        <!-- Tombol Update dan Tombol Batal -->
        <div class="row">
            <div class="col text-end">
                <button type="submit" class="btn btn-theme btn-small">Update</button>
                <button type="button" class="btn btn-secondary btn-small" onclick="history.back()">Batal</button>
            </div>
        </div>
    </form>
</div>

<style>
    .text-black {
        color: #000000; 
        font-weight: bold;
    }

    .btn-theme {
        background-color: rgba(245, 218, 223, 1); 
        border-color: rgba(245, 218, 223, 1);
        color: black;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 1rem;
        transition: background-color 0.3s ease, border-color 0.3s ease;
    }

    .btn-theme:hover {
        background-color: rgba(245, 168, 174, 1); 
        border-color: rgba(245, 168, 174, 1);
    }

    .btn-secondary {
        background-color: #f0f0f0;
        border-color: #ddd;
        color: #495057;
        border-radius: 8px;
        font-size: 1rem;
        transition: background-color 0.3s ease, border-color 0.3s ease;
        padding: 8px 16px;
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
        box-shadow: none;
        transition: border 0.3s;
    }

    .form-control:focus, .form-select:focus {
        border-color: #f78fb3;
        box-shadow: 0 0 5px rgba(246, 143, 179, 0.5);
    }

    @media (max-width: 768px) {
        .col-sm-3, .col-sm-9 {
            text-align: left;
        }
    }
</style>
