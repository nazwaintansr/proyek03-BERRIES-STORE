<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); 
    exit;
}

// Data admin
$admin_profiles = [
    'baebae' => ['name' => 'Bae Bae', 'email' => 'Baebae@gmail.com', 'image' => 'admin1.png'],
    'nazwaintansari' => ['name' => 'Nazwa Intan Sari', 'email' => 'nazwaintansr@gmail.com', 'image' => 'admin2.png'],
    'baebae' => ['name' => 'Bae Bae', 'email' => 'baebae@gmail.com', 'image' => 'admin3.png'],
];

$current_admin = $admin_profiles[$_SESSION['username']] ?? null;

if (!$current_admin) {
    $current_admin = [
        'name' => 'Tidak Diketahui',
        'email' => 'N/A',
        'image' => 'images/default.jpg' 
    ];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Profil Admin</h1>
        <div class="card">
            <div class="card-body text-center">
                <img src="<?php echo htmlspecialchars($current_admin['image']); ?>" alt="Admin Picture" class="rounded-circle mb-3" style="width: 150px; height: 150px;">
                <h3 class="card-title"><?php echo htmlspecialchars($current_admin['name']); ?></h3>
                <p class="card-text"><strong>Email:</strong> <?php echo htmlspecialchars($current_admin['email']); ?></p>
            </div>
        </div>
        <a href="index.php" class="btn btn-primary mt-3">Kembali ke Dashboard</a>
    </div>
</body>
</html>
