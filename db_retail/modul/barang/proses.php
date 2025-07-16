<?php
include '../../koneksi.php';

if ($_GET['action'] == 'insert') {

    $namabarang = $_POST['namabarang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $kategori = $_POST['kategori'];
    $tanggalmasuk = $_POST['tanggalmasuk'];
    $tanggalkadaluarsa = $_POST['tanggalkadaluarsa'];
    $deskripsi = $_POST['deskripsi'];

    
    
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $gambar = $_FILES['gambar'];
        $gambar_name = $gambar['name'];
        $gambar_tmp = $gambar['tmp_name'];
        $gambar_size = $gambar['size'];
        $gambar_ext = pathinfo($gambar_name, PATHINFO_EXTENSION);


        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array(strtolower($gambar_ext), $allowed_extensions)) {
            echo "Ekstensi gambar tidak valid!";
            exit;
        }


        if ($gambar_size > 2 * 1024 * 1024) {
            echo "Ukuran gambar terlalu besar! Maksimal 2MB.";
            exit;
        }

     
        $gambar_new_name = uniqid() . '.' . $gambar_ext;
        $upload_dir = '../../uploads/';
        $gambar_path = $upload_dir . $gambar_new_name;

      
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }


        if (!move_uploaded_file($gambar_tmp, $gambar_path)) {
            echo "Gagal mengupload gambar.";
            exit;
        }
    } else {
        $gambar_new_name = null;
    }

  
    $query = "INSERT INTO barang (namabarang, harga, stok, kategori, tanggalmasuk, tanggalkadaluarsa, deskripsi, gambar) 
              VALUES ('$namabarang', '$harga', '$stok', '$kategori', '$tanggalmasuk', '$tanggalkadaluarsa', '$deskripsi', '$gambar_new_name')";
    if ($mysqli->query($query)) {
        header("Location: ../../index.php?modul=barang&kategori=" . urlencode($kategori));
        exit;
    } else {
        echo "Gagal menambah data produk.";
    }

} elseif ($_GET['action'] == 'update') {
    $id = $_GET['id'];
    $namabarang = $_POST['namabarang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $kategori = $_POST['kategori'];
    $tanggalmasuk = $_POST['tanggalmasuk'];
    $tanggalkadaluarsa = $_POST['tanggalkadaluarsa'];
    $deskripsi = $_POST['deskripsi'];

    $gambar_new_name = null; 
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $gambar = $_FILES['gambar'];
        $gambar_name = $gambar['name'];
        $gambar_tmp = $gambar['tmp_name'];
        $gambar_size = $gambar['size'];
        $gambar_ext = pathinfo($gambar_name, PATHINFO_EXTENSION);

      
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array(strtolower($gambar_ext), $allowed_extensions)) {
            echo "Ekstensi gambar tidak valid!";
            exit;
        }

   
        if ($gambar_size > 2 * 1024 * 1024) {
            echo "Ukuran gambar terlalu besar! Maksimal 2MB.";
            exit;
        }

     
        $gambar_new_name = uniqid() . '.' . $gambar_ext;
        $upload_dir = '../../uploads/';
        $gambar_path = $upload_dir . $gambar_new_name;

        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

    
        if (!move_uploaded_file($gambar_tmp, $gambar_path)) {
            echo "Gagal mengupload gambar.";
            exit;
        }
    }

    
    if ($gambar_new_name) {
     
        $query = "UPDATE barang SET namabarang = '$namabarang', harga = '$harga', stok = '$stok', 
                  kategori = '$kategori', tanggalmasuk = '$tanggalmasuk', tanggalkadaluarsa = '$tanggalkadaluarsa', 
                  deskripsi = '$deskripsi', gambar = '$gambar_new_name' WHERE id = $id";
    } else {
        
        $query = "UPDATE barang SET namabarang = '$namabarang', harga = '$harga', stok = '$stok', 
                  kategori = '$kategori', tanggalmasuk = '$tanggalmasuk', tanggalkadaluarsa = '$tanggalkadaluarsa', 
                  deskripsi = '$deskripsi' WHERE id = $id";
    }

    if ($mysqli->query($query)) {
        header("Location: ../../index.php?modul=barang&kategori=" . urlencode($kategori));
        exit;
    } else {
        echo "Gagal memperbarui data produk.";
    }

} elseif ($_GET['action'] == 'delete') {
    $id = $_GET['id'];


    $query = "SELECT kategori, gambar FROM barang WHERE id = $id";
    $result = $mysqli->query($query);
    $row = $result->fetch_assoc();
    $kategori = $row['kategori'];
    $gambar = $row['gambar'];


    if ($gambar) {
        $gambar_path = '../../uploads/' . $gambar;
        if (file_exists($gambar_path)) {
            unlink($gambar_path);
        }
    }


    $query = "DELETE FROM barang WHERE id = $id";
    if ($mysqli->query($query)) {
        header("Location: ../../index.php?modul=barang&kategori=" . urlencode($kategori));
        exit;
    } else {
        echo "Gagal menghapus data produk.";
    }

} else {
    header("Location: ../../index.php");
    exit;
}
?>
