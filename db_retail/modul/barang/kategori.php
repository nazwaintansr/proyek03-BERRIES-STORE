<?php
$kategori_selected = isset($_GET['kategori']) ? $_GET['kategori'] : '';


include 'koneksi.php';


$kategori = [
    'make up' => ['name' => 'Makeup', 'image' => 'makeup.jpg'],
    'skincare' => ['name' => 'Skincare', 'image' => 'skincare.jpg'],
    'bodycare' => ['name' => 'Bodycare', 'image' => 'bodycare.jpg'],
    'haircare' => ['name' => 'Haircare', 'image' => 'haircare.jpg'],
    'parfum' => ['name' => 'Parfum', 'image' => 'paarfum.jpg']
];

echo '<div class="row justify-content-center">'; 

foreach ($kategori as $key => $data) {
   
    $is_active = ($key == $kategori_selected) ? 'active' : '';
    echo '
        <div class="col-12 mb-4">  
            <div class="category-card shadow-lg text-center ' . $is_active . '" 
                 style="background-image: url(\'modul/img/' . $data['image'] . '\'); 
                 background-size: cover; background-position: center; 
                 border-radius: 5;">
             <div class="category-card-body">
                    <h5 class="card-title mb-3" style="font-size: 2rem; font-weight: 600; color: #000000;">' . $data['name'] . '</h5>
                    <a href="index.php?modul=katalog&kategori=' . $key . '" class="btn-cta-text">Lihat Produk</a>
            </div>
            </div>
        </div>';
}

echo '</div>';
?>

<style>.btn-cta-text {
    color: #f5dada;
    font-weight: bold;
    text-decoration: none;
}

.btn-cta-text:hover {
    text-decoration: underline; 
    color: #eac0c0;
}
</style>


<div id="produk-detail" class="d-none mt-4">
    <h3 id="produk-nama"></h3>
    <img id="produk-gambar" src="" alt="" class="img-fluid">
    <p id="produk-deskripsi"></p>
    <p id="produk-harga"></p>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    
    $(".beli-btn").click(function() {
        var id = $(this).data("id");
        var namabarang = $(this).data("namabarang");
        var harga = $(this).data("harga");
        var gambar = $(this).data("gambar");
        var deskripsi = $(this).data("deskripsi");

        
        $("#produk-nama").text(namabarang);
        $("#produk-harga").text("Harga: Rp. " + harga.toLocaleString());
        $("#produk-deskripsi").text(deskripsi);
        $("#produk-gambar").attr("src", "uploads/" + gambar);
        
       
        $("#produk-detail").removeClass("d-none");
    });
});
</script>
