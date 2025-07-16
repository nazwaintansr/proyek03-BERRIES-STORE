<?php
session_start(); 

if (!isset($_SESSION['username'])) {
    header('Location: login.php'); 
    exit;
}

if (isset($_GET['logout'])) {
    session_destroy(); 
    header('Location: login.php'); 
    exit;
}

// Data admin 
$admin_profiles = [
    'alifianazwa' => ['name' => 'Alifia Nazwa', 'email' => 'alifianazwa@gmail.com', 'image' => 'admin1.jpg'],
    'nazwaintansari' => ['name' => 'Nazwa Intan Sari', 'email' => 'nazwaintansr@gmail.com', 'image' => 'admin2.jpg'],
    'baebae' => ['name' => 'Bae Bae', 'email' => 'baebae@gmail.com', 'image' => 'admin3.jpg'],
];

$current_admin = $admin_profiles[$_SESSION['username']] ?? null;
if (!$current_admin) {
    $current_admin = ['name' => 'Tidak Diketahui', 'email' => 'N/A', 'image' => 'admin1.png']; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Penjualan Produk Kecantikan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: rgba(245, 218, 223, 1);  
            color: black;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            min-height: 100vh; 
            display: flex;
            flex-direction: column; 
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

        .menu-toggle {
            background: none;
            border: none;
            color: black;  
            font-size: 1.5rem;
            cursor: pointer;
        }

        .menu-toggle:focus {
            outline: none;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: -250px;
            width: 250px;
            height: 100%;
            background-color: rgba(245, 218, 223, 1);  
            color: black;  
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2);
            transition: left 0.3s ease;
            z-index: 9999;
        }

        .sidebar.active {
            left: 0;
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .sidebar-header h2 {
            margin: 0;
            margin-left: 10px;
        }

        .sidebar a {
            color: black;  
            text-decoration: none;
            display: block;
            margin: 15px 0;
        }

        .sidebar a:hover {
            background-color: black;
            color: #f5dada;
            padding-left: 10px;
            transition: all 0.2s ease;
        }


        /* Sidebar Logout Button */
        .sidebar .logout-btn {
            background-color: black; 
            color: white;  
            border: none;  
            padding: 5px 10px;  
            font-size: 1rem;  
            border-radius: 5px; 
            width: 100%; 
            transition: background-color 0.3s ease;  
        }

        .sidebar .logout-btn:hover {
            background-color: #333333;  
            border-color: #333333;      
            color: white;              
        }

        .container {
            margin-top: 30px;
            padding: 30px;
            border-radius: 10px;
            background-color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            position: relative;
            flex-grow: 1; 
        }

        .category-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
            padding: 30px;
            height: 300px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .category-card .category-card-body {
            padding: 20px;
        }

        .category-card .btn-cta {
            background-color: rgba(245, 218, 223, 1);  
            border-color: rgba(245, 218, 223, 1);  
            color: black; 
            border-radius: 5px;
            padding: 15px 30px;
            font-weight: 600;
            transition: background-color 0.3s ease;
            font-size: 1.2rem;
        }

        .category-card .btn-cta:hover {
            background-color: #f56d8f;
            border-color: #f56d8f;
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

        .btn-cta-text {
            background: none;
            color: #f78fb3;
            border: none;
            font-weight: 600;
            font-size: 1.2rem;
            text-decoration: none;
            transition: color 0.3s ease;
            cursor: pointer;
        }

        .btn-cta-text:hover {
            color: #f56d8f;
            text-decoration: underline;
        }


    .btn-black {
        background-color: black;      
        color: #f5dada;                
        border: none;                  
    }

    .btn-black:hover {
        background-color: #333;        
        color: #f5dada;               
    }
</style>
        
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
        <div class="sidebar-header">
            <button class="menu-toggle" onclick="toggleSidebar()">☰</button>
        </div>
        <div class="profile-section">
        <?php $imagePath = "modul/img/" . htmlspecialchars($current_admin['image']); ?>
    <img src="<?php echo $imagePath; ?>" class="card-img-top rounded-circle" alt="Admin Picture" style="width: 80px; height: 80px; object-fit: cover;">
        <h4><?php echo htmlspecialchars($current_admin['name']); ?></h4>
            <p><?php echo htmlspecialchars($current_admin['email']); ?></p> 
        </div>
        <a href="index.php?modul=barang">Produk</a>
        <a href="index.php?modul=karyawan">Karyawan</a>
        <a href="index.php?logout=true" class="btn btn-danger logout-btn mt-3">Logout</a>
    </div>
    </div>

    <!-- Header -->
    <div class="header">
        <button class="menu-toggle" onclick="toggleSidebar()">☰</button>
        <h1>‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ BERRIES STORE</h1>
    <!-- Form pencarian di index.php -->
    <form action="modul/barang/detail.php" method="get" class="d-flex">
    <input type="text" name="search" class="form-control me-2" placeholder="Cari produk..." required style="max-width: 250px; padding: 2px 5px;">
    <button type="submit" class="btn btn-black text-light" style="padding: 3px 6px; font-size: 0.9rem;">Cari</button>
</form>


<div id="searchResults"></div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col">
                <?php
                   include "koneksi.php";
                   $modul = isset($_GET['modul']) ? $_GET['modul'] : null;
                    if ($modul === null) {
                        include "modul/barang/kategori.php";
                    } elseif ($modul == 'barang') {
                        include "modul/barang/index.php";
                    } elseif ($modul == 'form-tambah') {
                        include "modul/barang/form-tambah.php";
                    } elseif ($modul == 'form-edit') {
                        include "modul/barang/form-edit.php";
                    } elseif ($modul == 'karyawan') {
                        include "modul/karyawan/index.php";
                    } elseif ($modul == 'formtambah') {
                        include "modul/karyawan/formtambah.php";
                    } elseif ($modul == 'formedit') {
                        include "modul/karyawan/formedit.php";
                
                    } elseif ($modul == 'katalog' && isset($_GET['kategori'])) {
                        include "modul/barang/katalog.php";
                    } else {
                        echo "<p class='text-center text-danger'>Modul tidak ditemukan. Silakan periksa kembali URL Anda.</p>";
                    }
                ?>
            </div>
        </div>
    </div>

    <footer>
        © 2024 Berries Store Kecantikan dan Perawatan Kulit - All Rights Reserved
    </footer>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }
    </script>

<script>
document.getElementById('searchButton').addEventListener('click', function () {
    const query = document.getElementById('search_query').value;

    // Buat permintaan AJAX
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'modul/barang/search.php?query=' + encodeURIComponent(query), true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            document.getElementById('searchResults').innerHTML = xhr.responseText;
        } else {
            console.error('Error:', xhr.statusText);
        }
    };
    xhr.send();
});
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>