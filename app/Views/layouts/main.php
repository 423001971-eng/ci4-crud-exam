<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal | Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        <?php 
            $role = strtolower(session('user')['role'] ?? '');
            $primaryColor = '#ec4899'; // Default Pink
            $primaryHover = '#db2777';
            $primarySoft = '#fdf2f8';
            $bgLight = '#fff5f7';
            $textMain = '#4d0a2d';

            if ($role === 'admin') {
                $primaryColor = '#dc3545'; // Red
                $primaryHover = '#bd2130';
                $primarySoft = '#f8d7da';
                $bgLight = '#fff5f5';
                $textMain = '#721c24';
            } elseif (in_array($role, ['teacher', 'coordinator'])) {
                $primaryColor = '#198754'; // Green
                $primaryHover = '#157347';
                $primarySoft = '#d1e7dd';
                $bgLight = '#f8fff9';
                $textMain = '#0f5132';
            } elseif ($role === 'student') {
                $primaryColor = '#0d6efd'; // Blue
                $primaryHover = '#0b5ed7';
                $primarySoft = '#cfe2ff';
                $bgLight = '#f0f7ff';
                $textMain = '#084298';
            }
        ?>
        :root {
            --primary-color: <?= $primaryColor ?>;
            --primary-hover: <?= $primaryHover ?>;
            --primary-soft: <?= $primarySoft ?>;
            --bg-light: <?= $bgLight ?>;
            --text-main: <?= $textMain ?>;
        }
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: var(--bg-light); 
            color: var(--text-main);
            -webkit-font-smoothing: antialiased;
        }
        .navbar { 
            backdrop-filter: blur(12px); 
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 0.75rem 0;
            transition: all 0.3s ease;
        }
        .navbar:not(.bg-white) {
            background-color: rgba(0, 0, 0, 0.1) !important;
            backdrop-filter: blur(20px);
        }
        .navbar.bg-white {
            background: rgba(255, 255, 255, 0.8) !important;
        }
        .navbar.bg-danger { background-color: #dc3545 !important; }
        .navbar.bg-success { background-color: #198754 !important; }
        .navbar.bg-primary { background-color: #0d6efd !important; }
        .navbar-brand { font-size: 1.4rem; letter-spacing: -0.5px; }
        .text-primary { color: var(--primary-color) !important; }
        .bg-primary { background-color: var(--primary-color) !important; }
        .btn-primary { background-color: var(--primary-color) !important; border: none; padding: 0.6rem 1.5rem; border-radius: 12px; font-weight: 600; }
        .btn-primary:hover { background-color: var(--primary-hover) !important; transform: translateY(-1px); }
        .btn-outline-primary { border-color: var(--primary-color); color: var(--primary-color); }
        .btn-outline-primary:hover { background-color: var(--primary-color); border-color: var(--primary-color); color: white; }
        
        .nav-link { 
            transition: all 0.2s ease;
            border-radius: 8px;
            margin: 0 2px;
            font-weight: 500;
        }
        .nav-link:hover { color: var(--primary-color) !important; background: var(--primary-soft); }
        
        .card { 
            border: none; 
            border-radius: 20px; 
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card:hover { transform: translateY(-3px); box-shadow: 0 20px 30px -10px rgba(0, 0, 0, 0.1); }
        
        .profile-img { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); border: 2px solid var(--primary-color) !important; }
        .profile-img:hover { transform: scale(1.1); box-shadow: 0 0 15px var(--primary-color); }
        
        .leading-none { line-height: 1.1; }
        .hover-scale:hover { transform: scale(1.05); }
        .transition-transform { transition: transform 0.2s ease; }
        
        .badge.bg-primary { background-color: var(--primary-color) !important; }
        .alert-primary { background-color: var(--primary-soft); border-color: rgba(0, 0, 0, 0.05); color: var(--text-main); }

        /* Role-Based Aesthetic Overrides */
        .bg-success, .bg-warning, .bg-info, .bg-secondary { background-color: var(--primary-color) !important; color: white !important; }
        .text-success, .text-warning, .text-info, .text-secondary { color: var(--primary-color) !important; }
        
        /* Soft versions for all backgrounds */
        .bg-success.bg-opacity-10, 
        .bg-warning.bg-opacity-10, 
        .bg-info.bg-opacity-10, 
        .bg-primary.bg-opacity-10,
        .bg-secondary.bg-opacity-10 { 
            background-color: var(--primary-soft) !important; 
        }

        .border-primary, .border-success, .border-info, .border-warning {
            border-color: var(--primary-soft) !important;
        }

        /* Table overrides */
        .table-dark { background-color: var(--primary-color) !important; border-color: var(--primary-hover) !important; }
        .table-light { background-color: var(--primary-soft) !important; }
        
        /* Specific button overrides to keep them pink/white */
        .btn-success, .btn-info, .btn-warning {
            background-color: var(--primary-color) !important;
            border: none !important;
            color: white !important;
        }
        .btn-outline-success, .btn-outline-info, .btn-outline-warning {
            border-color: var(--primary-color) !important;
            color: var(--primary-color) !important;
        }
        .btn-outline-success:hover, .btn-outline-info:hover, .btn-outline-warning:hover {
            background-color: var(--primary-color) !important;
            color: white !important;
        }
    </style>
</head>
<body>

<nav class="navbar sticky-top navbar-expand-lg mb-5 shadow-sm <?= (session()->get('isLoggedIn') && !in_array(service('uri')->getSegment(1), ['login', 'register'])) ? (
    strtolower(session('user')['role'] ?? '') === 'admin' ? 'navbar-dark bg-danger' : (
    in_array(strtolower(session('user')['role'] ?? ''), ['teacher', 'coordinator']) ? 'navbar-dark bg-success' : (
    strtolower(session('user')['role'] ?? '') === 'student' ? 'navbar-dark bg-primary' : ''
))) : '' ?>">
    <div class="container">
        <!-- Logo -->
        <?php 
            $role = strtolower(session('user')['role'] ?? '');
            $brandClass = (session()->get('isLoggedIn') && in_array($role, ['admin', 'teacher', 'coordinator', 'student'])) ? 'text-white' : 'text-primary';
        ?>
        <a class="navbar-brand fw-bold <?= $brandClass ?>" href="<?= base_url('dashboard') ?>">🎓 Student<span class="<?= $brandClass === 'text-white' ? 'text-white opacity-75' : 'text-dark' ?>">Portal</span></a>
        
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <?php 
                $uri = service('uri');
                $isAuthPage = in_array($uri->getSegment(1), ['login', 'register']);
            ?>
            <?php if(session()->get('isLoggedIn') && !$isAuthPage): ?>
                <?php 
                    $badgeClass = 'bg-primary';
                    if ($role === 'admin') $badgeClass = 'bg-light text-danger';
                    elseif (in_array($role, ['teacher', 'coordinator'])) $badgeClass = 'bg-light text-success';
                    elseif ($role === 'student') $badgeClass = 'bg-light text-primary';
                    
                    $linkClass = ($role === 'admin' || in_array($role, ['teacher', 'coordinator', 'student'])) ? 'text-white' : 'text-dark';
                ?>
                <!-- Left-side Navigation and User Info -->
                <ul class="navbar-nav me-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link fw-semibold <?= $linkClass ?> px-3" href="<?= base_url($role === 'coordinator' ? 'coordinator/dashboard' : 'dashboard') ?>">Dashboard</a>
                    </li>
                    
                    <!-- Vertical Divider (Desktop Only) -->
                    <div class="vr mx-2 d-none d-lg-block <?= $linkClass === 'text-white' ? 'bg-white' : 'text-secondary' ?> opacity-25" style="height: 24px;"></div>

                    <!-- User Name & Role -->
                    <li class="nav-item px-3 d-flex flex-column justify-content-center">
                        <span class="fw-bold <?= $linkClass ?> small leading-none"><?= session()->get('user')['name'] ?></span>
                        <span class="badge <?= $badgeClass ?> fw-bold text-uppercase mt-1" style="font-size: 0.6rem; letter-spacing: 0.5px;">
                            <?= session()->get('user')['role'] ?>
                        </span>
                    </li>

                    <div class="vr mx-2 d-none d-lg-block <?= $linkClass === 'text-white' ? 'bg-white' : 'text-secondary' ?> opacity-25" style="height: 24px;"></div>

                    <!-- Role-based Links -->
                    <?php if ($role === 'admin'): ?>
                        <li class="nav-item">
                            <a class="nav-link px-3 <?= $linkClass ?>" href="<?= base_url('students') ?>">Students</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3 <?= $linkClass ?>" href="<?= base_url('admin/roles') ?>">Roles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3 <?= $linkClass ?>" href="<?= base_url('admin/users') ?>">Users</a>
                        </li>
                    <?php elseif (in_array($role, ['teacher', 'coordinator'])): ?>
                        <li class="nav-item">
                            <a class="nav-link px-3 <?= $linkClass ?>" href="<?= base_url('students') ?>">Records</a>
                        </li>
                        <?php if ($role === 'coordinator'): ?>
                            <li class="nav-item">
                                <a class="nav-link px-3 <?= $linkClass ?>" href="<?= base_url('coordinator/files') ?>">Files</a>
                            </li>
                        <?php endif; ?>
                    <?php elseif ($role === 'student'): ?>
                        <li class="nav-item">
                            <a class="nav-link px-3 <?= $linkClass ?>" href="<?= base_url('profile') ?>">My Profile</a>
                        </li>
                    <?php endif; ?>
                </ul>

                <!-- Right-side Actions -->
                <div class="ms-auto d-flex align-items-center gap-3">
                    <!-- Profile Link (Avatar Only) -->
                    <a href="<?= base_url('profile') ?>" class="profile-img-link transition-transform hover-scale">
                        <img src="<?= base_url('uploads/profiles/' . (session()->get('user')['profile_image'] ?? 'default-avatar.png')) ?>" 
                             class="profile-img shadow-sm border-2" 
                             alt="User"
                             style="width: 42px; height: 42px; border-radius: 50%; object-fit: cover; border: 2px solid <?= $role === 'admin' ? '#fff' : 'var(--primary-color)' ?>;">
                    </a>
                    
                    <!-- Logout -->
                    <a href="<?= base_url('logout') ?>" class="btn btn-sm <?= $linkClass === 'text-white' ? 'btn-light text-danger' : 'btn-outline-danger' ?> fw-bold px-3 rounded-pill shadow-sm">Logout</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="container mb-5">
    <?= $this->renderSection('content') ?>
</div>

<script src="https://cdn