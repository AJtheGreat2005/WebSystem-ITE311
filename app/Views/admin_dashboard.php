<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Admin Dashboard') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .welcome-card {
            background: white;
            border-radius: 20px;
            padding: 60px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            text-align: center;
            max-width: 600px;
        }
        .welcome-icon {
            font-size: 5rem;
            color: #f5576c;
            margin-bottom: 20px;
        }
        h1 {
            color: #2c3e50;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .user-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin: 30px 0;
        }
    </style>
</head>
<body>
    <div class="welcome-card">
        <i class="bi bi-shield-check welcome-icon"></i>
        <h1>Welcome, Admin!</h1>
        <p class="lead">You have successfully logged in to the Admin Dashboard</p>
        
        <div class="user-info">
            <p class="mb-2"><strong><i class="bi bi-person"></i> Name:</strong> <?= esc($name) ?></p>
            <p class="mb-2"><strong><i class="bi bi-envelope"></i> Email:</strong> <?= esc($email) ?></p>
            <p class="mb-0"><strong><i class="bi bi-shield"></i> Role:</strong> <span class="badge bg-danger"><?= esc(ucfirst($role)) ?></span></p>
        </div>

        <div class="d-grid gap-2">
            <a href="<?= base_url('announcements/create') ?>" class="btn btn-danger btn-lg">
                <i class="bi bi-plus-circle"></i> Create Announcement
            </a>
            <a href="<?= base_url('announcements') ?>" class="btn btn-primary">
                <i class="bi bi-megaphone"></i> View Announcements
            </a>
            <a href="<?= base_url('dashboard') ?>" class="btn btn-outline-secondary">
                <i class="bi bi-house"></i> Go to Main Dashboard
            </a>
            <a href="<?= base_url('logout') ?>" class="btn btn-outline-danger">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
