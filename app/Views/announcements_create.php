<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Create Announcement') ?></title>
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
        .form-card {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
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
                        <a class="nav-link" href="<?= base_url('announcements') ?>">Announcements</a>
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

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-card">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3><i class="bi bi-megaphone"></i> Create New Announcement</h3>
                        <a href="<?= base_url('announcements') ?>" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                    </div>

                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            <?= session()->getFlashdata('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('announcements/store') ?>" method="post">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label for="title" class="form-label">Announcement Title <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control <?= isset($validation) && $validation->hasError('title') ? 'is-invalid' : '' ?>" 
                                   id="title" 
                                   name="title" 
                                   value="<?= old('title') ?>" 
                                   placeholder="Enter announcement title"
                                   required>
                            <?php if (isset($validation) && $validation->hasError('title')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('title') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-4">
                            <label for="content" class="form-label">Content <span class="text-danger">*</span></label>
                            <textarea class="form-control <?= isset($validation) && $validation->hasError('content') ? 'is-invalid' : '' ?>" 
                                      id="content" 
                                      name="content" 
                                      rows="8" 
                                      placeholder="Enter announcement content"
                                      required><?= old('content') ?></textarea>
                            <?php if (isset($validation) && $validation->hasError('content')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('content') ?>
                                </div>
                            <?php endif; ?>
                            <div class="form-text">Provide detailed information about the announcement.</div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-send"></i> Post Announcement
                            </button>
                            <a href="<?= base_url('announcements') ?>" class="btn btn-outline-secondary">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
