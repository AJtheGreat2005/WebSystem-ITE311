<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Authentication System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('dashboard') ?>">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url('dashboard') ?>">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('announcements') ?>">Announcements</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i> <?= esc($name) ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i> Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="<?= base_url('logout') ?>">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill"></i>
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="bi bi-house-door"></i> Welcome to Your Dashboard</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="text-primary">User Information</h5>
                                <table class="table table-borderless">
                                    <tr>
                                        <td width="150"><strong><i class="bi bi-person"></i> Name:</strong></td>
                                        <td><?= esc($name) ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong><i class="bi bi-envelope"></i> Email:</strong></td>
                                        <td><?= esc($email) ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong><i class="bi bi-shield"></i> Role:</strong></td>
                                        <td><span class="badge bg-info"><?= esc(ucfirst($role)) ?></span></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <div class="alert alert-info">
                                    <h5 class="alert-heading"><i class="bi bi-info-circle"></i> Protected Area</h5>
                                    <p class="mb-0">This is a protected dashboard page. Only authenticated users can access this page.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <i class="bi bi-people-fill text-primary" style="font-size: 3rem;"></i>
                        <h5 class="card-title mt-3">Users</h5>
                        <p class="card-text">Manage user accounts</p>
                        <a href="#" class="btn btn-primary">View Users</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <i class="bi bi-megaphone-fill text-success" style="font-size: 3rem;"></i>
                        <h5 class="card-title mt-3">Announcements</h5>
                        <p class="card-text">View latest announcements</p>
                        <a href="<?= base_url('announcements') ?>" class="btn btn-success">View Announcements</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <i class="bi bi-gear-fill text-warning" style="font-size: 3rem;"></i>
                        <h5 class="card-title mt-3">Settings</h5>
                        <p class="card-text">Configure system settings</p>
                        <a href="#" class="btn btn-warning">View Settings</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
