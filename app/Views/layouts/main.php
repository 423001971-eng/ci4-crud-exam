<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Pro | Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; color: #334155; }
        .navbar { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px); border-bottom: 1px solid #e2e8f0; }
        .card { border: none; border-radius: 12px; transition: transform 0.2s; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        .btn-primary { background-color: #4f46e5; border: none; border-radius: 8px; padding: 10px 20px; }
        .btn-primary:hover { background-color: #4338ca; }
        .table thead { background-color: #f1f5f9; color: #64748b; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.05em; }
    </style>
</head>
<body>

<nav class="navbar sticky-top navbar-expand-lg mb-5">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="<?= base_url('products') ?>">📦 Inventory<span class="text-dark">Pro</span></a>
        <div class="ms-auto d-flex align-items-center">
            <?php if(session()->get('isLoggedIn')): ?>
                <span class="me-3 small text-muted">Hi, <strong><?= session()->get('user_name') ?></strong></span>
                <a href="<?= base_url('logout') ?>" class="btn btn-sm btn-outline-danger">Logout</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="container mb-5">
    <?= $this->renderSection('content') ?>
</div>

</body>
</html>