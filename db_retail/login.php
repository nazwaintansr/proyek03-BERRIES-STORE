<?php
session_start(); 
if (!isset($_SESSION['selected_user'])) {
    header('Location: user-select.php');
    exit;
}

if (isset($_SESSION['username'])) {
    header('Location: dashboard.php'); 
    exit;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];


    if ($_SESSION['selected_user'] == 'alifianazwa' && $username == 'alifianazwa' && $password == '123') {
        $_SESSION['username'] = $username;
        header('Location: index.php');
        exit;
    } elseif ($_SESSION['selected_user'] == 'nazwaintansari' && $username == 'nazwaintansari' && $password == '456') {
        $_SESSION['username'] = $username;
        header('Location: index.php');
        exit;
    } elseif ($_SESSION['selected_user'] == 'baebae' && $username == 'baebae' && $password == '789') {
        $_SESSION['username'] = $username;
        header('Location: index.php');
        exit;
    } else {
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aplikasi Penjualan Produk Kecantikan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            color: #495057;
            font-family: 'Poppins', sans-serif;
        }
        .container {
            max-width: 450px;
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
        .btn-theme {
            background-color: black;
            border-color: #f5dada;
            color: #f5dada;
            font-size: 1.1rem;
        }
        .btn-theme:hover {
            background-color: #333333;
            border-color: #333333;
            color: white;
        }
        .alert-danger {
            background-color: #FDE8E8;
            color: #F44336;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            Login sebagai <?php echo $_SESSION['selected_user']; ?>
        </div>
        <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
        <form method="POST" action="login.php">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-theme w-100">Login</button>
        </form>
    </div>
</body>
</html>
