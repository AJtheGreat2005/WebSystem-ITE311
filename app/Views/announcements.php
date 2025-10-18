<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Announcements') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #2c3e50 !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .announcement-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .announcement-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        .announcement-title {
            color: #2c3e50;
            font-weight: bold;
            font-size: 1.5rem;
            margin-bottom: 10px;
        }
        .announcement-meta {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }
        .announcement-content {
            color: #495057;
            line-height: 1.6;
        }
        .badge-role {
            font-size: 0.75rem;
            padding: 4px 8px;
        }
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .empty-state i {
            font-size: 4rem;
            color: #dee2e6;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">
                <i class="bi bi-book"></i> Student Portal
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
                        <a class="nav-link" href="<?= base_url('dashboard') ?>">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url('announcements') ?>">Announcements</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <span class="text-white me-3">
                        <i class="bi bi-person-circle"></i> <?= esc($user['name']) ?>
                        <span class="badge bg-info ms-1"><?= esc(ucfirst($user['role'])) ?></span>
                    </span>
                    <a href="<?= base_url('logout') ?>" class="btn btn-outline-light btn-sm">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2><i class="bi bi-megaphone"></i> Announcements</h2>
                <p class="text-muted mb-0">Stay updated with the latest news and information</p>
            </div>
            <?php if (isset($user['role']) && $user['role'] === 'admin'): ?>
                <a href="<?= base_url('announcements/create') ?>" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> New Announcement
                </a>
            <?php endif; ?>
        </div>

        <!-- Flash Messages -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill"></i>
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Announcements List -->
        <?php if (!empty($announcements)): ?>
            <?php foreach ($announcements as $announcement): ?>
                <div class="announcement-card">
                    <div class="announcement-title">
                        <i class="bi bi-pin-angle-fill text-primary"></i>
                        <?= esc($announcement['title']) ?>
                    </div>
                    <div class="announcement-meta">
                        <i class="bi bi-person"></i> Posted by 
                        <strong><?= esc($announcement['posted_by_name']) ?></strong>
                        <span class="badge badge-role bg-secondary"><?= esc(ucfirst($announcement['role'])) ?></span>
                        <span class="ms-3">
                            <i class="bi bi-calendar"></i>
                            <?= date('F d, Y', strtotime($announcement['date_posted'])) ?>
                        </span>
                        <span class="ms-2">
                            <i class="bi bi-clock"></i>
                            <?= date('h:i A', strtotime($announcement['date_posted'])) ?>
                        </span>
                    </div>
                    <div class="announcement-content">
                        <?= nl2br(esc($announcement['content'])) ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Empty State -->
            <div class="empty-state">
                <i class="bi bi-inbox"></i>
                <h4 class="text-muted">No Announcements Yet</h4>
                <p class="text-muted">There are currently no announcements to display.</p>
                <?php if (isset($user['role']) && $user['role'] === 'admin'): ?>
                    <a href="<?= base_url('announcements/create') ?>" class="btn btn-primary mt-3">
                        <i class="bi bi-plus-circle"></i> Create First Announcement
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
