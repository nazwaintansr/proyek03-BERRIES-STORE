<?php
include '../../koneksi.php';
if($_GET['action'] == 'insert') {
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $email = $_POST['email'];
    $query = "INSERT INTO karyawan (nama, jabatan, alamat, telepon, email) VALUES ('$nama', '$jabatan', '$alamat', '$telepon', '$email')";
    $mysqli->query($query);
    header("Location: ../../index.php?modul=karyawan");
}elseif($_GET['action'] == 'update') {
    $id = $_GET['id'];
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $email = $_POST['email'];
    $query = "UPDATE karyawan SET  nama = '$nama', jabatan = '$jabatan', alamat = '$alamat', telepon = '$telepon', email = '$email' WHERE id = $id";
    $mysqli->query($query);
    header("Location: ../../index.php?modul=karyawan");
}elseif($_GET['action'] == 'delete') {
    $id = $_GET['id'];
    $query = "DELETE FROM karyawan WHERE id = $id";
    $mysqli->query($query);
    header("Location: ../../index.php?modul=karyawan");
}else{
    header("Location:../../ index.php");
}
?>