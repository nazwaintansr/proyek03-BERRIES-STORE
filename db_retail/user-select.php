<?php
session_start(); 
if (isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $selected_user = $_POST['user'];
    $_SESSION['selected_user'] = $selected_user; 
    header('Location: login.php'); 
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Pengguna - Aplikasi Penjualan Produk Kecantikan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; 
            color: #495057; 
            font-family: 'Poppins', sans-serif;
        }
        .container {
            max-width: 700px;
            margin-top: 120px;
            padding: 30px;
            background-color: #f5dada; 
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            font-size: 2.2rem;
            font-weight: 600;
            color: black;
            margin-bottom: 30px;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: scale(1.05); 
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.2); 
        }
        .card-body {
            text-align: center;
        }
        .card-img-top {
            width: 100px;  
            height: 100px; 
            object-fit: cover; 
            border-radius: 50%; 
            margin: 0 auto; 
        }
        .btn-theme {
            background-color: black;
            border-color: #f5dada;
            color: #f5dada;
            font-size: 1.1rem;
            border-radius: 10px;
        }
        .btn-theme:hover {
            background-color: #333333;
            border-color: #333333;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            Pilih Pengguna
        </div>
        <!-- Form untuk memilih admin -->
        <form id="userForm" method="POST" action="user-select.php">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <!-- Admin 1 -->
                <div class="col">
                    <div class="card" onclick="selectUser('alifianazwa')">
                        <img src="modul/img/admin1.jpg" class="card-img-top" alt="Admin 1">
                        <div class="card-body">
                            <h5 class="card-title">Admin</h5>
                            <p class="card-text">Bae Bae</p>
                        </div>
                    </div>
                </div>
                <!-- Admin 2 -->
                <div class="col">
                    <div class="card" onclick="selectUser('nazwaintansari')">
                        <img src="modul/img/admin2.jpg" class="card-img-top" alt="Admin 2">
                        <div class="card-body">
                            <h5 class="card-title">Admin</h5>
                            <p class="card-text">Nazwa Intan Sari</p>
                        </div>
                    </div>
                </div>
                <!-- Admin 3 -->
                <div class="col">
                    <div class="card" onclick="selectUser('baebae')">
                        <img src="modul/img/admin3.jpg" class="card-img-top" alt="Admin 3">
                        <div class="card-body">
                            <h5 class="card-title">Admin</h5>
                            <p class="card-text">Bae Bae</p>
                        </div>
                    </div>
                </div>
            </div>

            
            <input type="hidden" name="user" id="selectedUser" value="">
        </form>
    </div>

    <script>
        function selectUser(user) {
            document.getElementById('selectedUser').value = user;
            document.getElementById('userForm').submit();
        }
    </script>
</body>
</html>
