<div class="p-4 border rounded" style="background-color: #f9f9f9;">
    <h5 class="text-black">Form Input Produk</h5>
    <hr>
    <form action="modul/barang/proses.php?action=insert" method="post" enctype="multipart/form-data" id="form-tambah">
        
        <!-- Nama Barang -->
        <div class="row mb-3">
            <label for="namabarang" class="col-sm-3 col-form-label text-black text-start">Nama Barang</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="namabarang" id="namabarang" placeholder="Masukkan nama barang" required />
            </div>
        </div>
        
        <!-- Harga -->
        <div class="row mb-3">
            <label for="harga" class="col-sm-3 col-form-label text-black text-start">Harga</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" name="harga" id="harga" placeholder="Masukkan harga" required />
            </div>
        </div>

        <!-- Stok -->
        <div class="row mb-3">
            <label for="stok" class="col-sm-3 col-form-label text-black text-start">Stok</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" name="stok" id="stok" placeholder="Masukkan stok" required />
            </div>
        </div>

        <!-- Kategori -->
        <div class="row mb-3">
            <label for="kategori" class="col-sm-3 col-form-label text-black text-start">Kategori</label>
            <div class="col-sm-9">
                <select name="kategori" class="form-select" id="kategori" required>
                    <option value="" disabled selected>Pilih kategori</option>
                    <option value="Make Up">Makeup</option>
                    <option value="Skincare">Skincare</option>
                    <option value="Bodycare">Bodycare</option>
                    <option value="Haircare">Haircare</option>
                    <option value="Parfum">Parfum</option>
                </select>
            </div>
        </div>

        <!-- Tanggal Masuk -->
        <div class="row mb-3">
            <label for="tanggalmasuk" class="col-sm-3 col-form-label text-black text-start">Tanggal Masuk</label>
            <div class="col-sm-9">
                <input type="date" class="form-control" name="tanggalmasuk" id="tanggalmasuk" required />
            </div>
        </div>

        <!-- Tanggal Kadaluarsa -->
        <div class="row mb-3">
            <label for="tanggalkadaluarsa" class="col-sm-3 col-form-label text-black text-start">Tanggal Kadaluarsa</label>
            <div class="col-sm-9">
                <input type="date" class="form-control" name="tanggalkadaluarsa" id="tanggalkadaluarsa" required />
            </div>
        </div>

        <!-- Deskripsi -->
        <div class="row mb-3">
            <label for="deskripsi" class="col-sm-3 col-form-label text-black text-start">Deskripsi</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="deskripsi" id="deskripsi" placeholder="Masukkan deskripsi" required />
            </div>
        </div>

        <!-- Gambar Produk -->
        <div class="row mb-3">
            <label for="gambar" class="col-sm-3 col-form-label text-black text-start">Gambar Produk</label>
            <div class="col-sm-9">
                <input type="file" class="form-control" name="gambar" id="gambar" accept="image/*" required />
                <small class="form-text text-muted">Pastikan gambar dalam format JPG, PNG, atau GIF.</small>
            </div>
        </div>

        <!-- Tombol Simpan dan Tombol Batal -->
        <div class="row">
            <div class="col text-end">
                <button type="submit" class="btn btn-theme btn-sm">Simpan</button>
                <button type="button" class="btn btn-secondary btn-sm" onclick="history.back()">Batal</button>
            </div>
        </div>
    </form>
</div>

<style>
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
    .form-text {
        font-size: 0.875rem;
    }
</style>
