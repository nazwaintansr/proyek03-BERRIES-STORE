<div class="p-4 border rounded" style="background-color: #f9f9f9;">
    <h5 class="text-black">Form Input Karyawan</h5> 
    <hr>
    <form action="modul/karyawan/proses.php?action=insert" method="post">

        <!-- Nama Input -->
        <div class="row mb-3">
            <label for="nama" class="col-sm-3 col-form-label text-black text-start">Nama</label> 
            <div class="col-sm-9">
                <input type="text" class="form-control" name="nama" placeholder="Masukkan nama" required />
            </div>
        </div>

        <!-- Jabatan Input -->
        <div class="row mb-3">
            <label for="jabatan" class="col-sm-3 col-form-label text-black text-start">Jabatan</label> 
            <div class="col-sm-9">
                <input type="text" class="form-control" name="jabatan" placeholder="Masukkan jabatan" required />
            </div>
        </div>

        <!-- Alamat Input -->
        <div class="row mb-3">
            <label for="alamat" class="col-sm-3 col-form-label text-black text-start">Alamat</label> 
            <div class="col-sm-9">
                <input type="text" class="form-control" name="alamat" placeholder="Masukkan alamat" required />
            </div>
        </div>

        <!-- Telepon Input -->
        <div class="row mb-3">
            <label for="telepon" class="col-sm-3 col-form-label text-black text-start">Telepon</label> 
            <div class="col-sm-9">
                <input type="text" class="form-control" name="telepon" placeholder="Masukkan telepon" required />
            </div>
        </div>

        <!-- Email Input -->
        <div class="row mb-3">
            <label for="email" class="col-sm-3 col-form-label text-black text-start">Email</label> 
            <div class="col-sm-9">
                <input type="email" class="form-control" name="email" placeholder="Masukkan email" required />
            </div>
        </div>

        <!-- Tombol Simpan dan Tombol Batal -->
        <div class="row">
            <div class="col text-end">
                <button type="submit" class="btn btn-theme btn-small">Simpan</button> 
                <button type="button" class="btn btn-secondary btn-small" onclick="history.back()">Batal</button> 
            </div>
        </div>
    </form>
</div>

<style>
    .text-black {
        color: #000000; 
        font-weight: bold;
        font-size: 1.1rem; 
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
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 1rem;
        transition: background-color 0.3s ease, border-color 0.3s ease;
    }

    .btn-secondary:hover {
        background-color: #e0e0e0;
        border-color: #ccc;
    }

    .btn-small {
        padding: 6px 12px; 
        font-size: 0.9rem; 
    }

    .form-control {
        font-size: 0.95rem;
        border-radius: 10px;
        border: 1px solid #ddd;
        box-shadow: none;
        transition: border 0.3s;
        padding: 8px 12px; 
    }

    .form-control:focus {
        border-color: #f78fb3;
        box-shadow: 0 0 5px rgba(246, 143, 179, 0.5);
    }

    .row {
        margin-bottom: 16px; 
    }

  
    .col-sm-9 {
        max-width: 75%;
    }
    @media (max-width: 768px) {
        .col-sm-3, .col-sm-9 {
            text-align: left;
        }

        .text-black {
            font-size: 1rem; 
        }

        .btn-theme {
            font-size: 1rem; 
            padding: 8px 16px; */
        }

        .form-control {
            font-size: 0.9rem; 
        }
    }
</style>
