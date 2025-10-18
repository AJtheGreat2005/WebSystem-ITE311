<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Learning Management System' ?></title>
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
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 80px 0;
            margin-bottom: 50px;
        }
        .hero-section h1 {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .hero-section p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            opacity: 0.9;
        }
        .feature-card {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            height: 100%;
            text-align: center;
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.2);
        }
        .feature-icon {
            font-size: 3rem;
            margin-bottom: 20px;
        }
        .feature-card h5 {
            font-weight: bold;
            margin-bottom: 15px;
            color: #2c3e50;
        }
        .feature-card p {
            color: #6c757d;
            line-height: 1.6;
        }
        footer {
            background-color: #34495e;
            color: white;
            padding: 30px 0;
            margin-top: 80px;
        }
        .btn-learn-more {
            background-color: #3498db;
            border: none;
            padding: 12px 30px;
            font-size: 1.1rem;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .btn-learn-more:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">
                <i class="bi bi-book"></i> LMS
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url() ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('about') ?>">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('contact') ?>">Contact</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a href="<?= base_url('login') ?>" class="btn btn-outline-light me-2">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </a>
                    <a href="<?= base_url('register') ?>" class="btn btn-light">
                        <i class="bi bi-person-plus"></i> Register
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section text-center">
        <div class="container">
            <h1><?= $page_title ?? 'Welcome to LMS' ?></h1>
            <p><?= $description ?? 'Your comprehensive learning management platform' ?></p>
            <a href="<?= base_url('about') ?>" class="btn btn-light btn-learn-more">Learn More</a>
        </div>
    </div>

    <!-- Features Section -->
    <div class="container mb-5">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">📚</div>
                    <h5>Course Management</h5>
                    <p>Create and manage courses with ease. Organize lessons, quizzes, and assignments in one place.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">👥</div>
                    <h5>Student Tracking</h5>
                    <p>Monitor student progress, track enrollments, and manage submissions efficiently.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">📊</div>
                    <h5>Analytics</h5>
                    <p>Get insights into student performance and course effectiveness with detailed analytics.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center">
        <div class="container">
            <p class="mb-0">&copy; 2024 Learning Management System. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
