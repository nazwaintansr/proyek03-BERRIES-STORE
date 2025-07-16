<div class="row mb-3">
    <div class="col">
        <h5 class="text-black">Data Karyawan</h5> 
    </div>
</div>

<div class="row mb-3 d-flex justify-content-between">
    <div class="col-auto">
        <a class="btn btn-theme btn-sm" href="?modul=formtambah">Tambah Karyawan</a>
    </div>
    <div class="col-auto">
        <form action="" method="get" class="d-flex">
            <input type="hidden" name="modul" value="karyawan">
            <input type="hidden" name="kategori" value="<?php echo htmlspecialchars($kategori); ?>">

            <select name="filter" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                <option value="">Filter Berdasarkan</option>
                <option value="az" <?php echo isset($_GET['filter']) && $_GET['filter'] == 'az' ? 'selected' : ''; ?>>Nama A-Z</option>
                <option value="za" <?php echo isset($_GET['filter']) && $_GET['filter'] == 'za' ? 'selected' : ''; ?>>Nama Z-A</option>
            </select>
        </form>
    </div>
</div>

<table class="table table-bordered table-hover">
    <thead class="bg-theme text-white">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Jabatan</th>
            <th>Alamat</th>
            <th>Telepon</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Filter value
        $filter = isset($_GET['filter']) ? $_GET['filter'] : '';
        $query = "SELECT * FROM karyawan";
        if ($filter == 'az') {
            $query .= " ORDER BY nama ASC";
        } elseif ($filter == 'za') {
            $query .= " ORDER BY nama DESC";
        }

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
                    <td><?php $nama = strlen($row['nama']) > 20 ? substr($row['nama'], 0, 20) . '...' : $row['nama']; echo $nama; ?> </td>
                    <td><?php echo $row['jabatan']; ?></td>
                    <td><?php $alamat = strlen($row['alamat']) > 20 ? substr($row['alamat'], 0, 20) . '...' : $row['alamat']; echo $alamat; ?> </td>
                    <td><?php echo $row['telepon']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td>
                        <a class="btn btn-sm btn-theme" href="<?= '?modul=formedit&id=' . $row['id']; ?>">Edit</a>
                        <a class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $row['id']; ?>" href="#">Hapus</a>

                        <!-- Modal -->
                        <div class="modal fade" id="hapusModal<?= $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-theme text-white">
                                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah Anda yakin ingin menghapus data ini? 
                                        <strong class="truncate-text"><?= $row['nama']; ?></strong>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <a class="btn btn-theme" href="<?= 'modul/karyawan/proses.php?action=delete&id=' . $row['id']; ?>">Yakin</a>
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

    .text-theme {
        color: #000000; 
    }

    .btn-theme {
        background-color: rgba(245, 218, 223, 1); 
        border-color: rgba(245, 218, 223, 1);
        color: black;
    }

    .btn-theme:hover {
        background-color: rgba(245, 168, 174, 1); 
        border-color: rgba(245, 168, 174, 1);
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
        
    .modal-header .modal-title {
        color: #000000;
    }


    .table td {
        word-wrap: break-word; 
    }

    .table td:nth-child(7) {
        max-width: 200px; 
        overflow: hidden; 
        text-overflow: ellipsis; 
        white-space: nowrap; /
    }

    .modal-body strong {
        word-wrap: break-word; 
        white-space: normal; 
    }
</style>
