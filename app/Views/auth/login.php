<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<style>
    :root {
        --primary-color: #3b82f6; /* Modern Blue */
        --primary-hover: #2563eb;
        --primary-soft: #eff6ff;
        --bg-light: #f8fafc;
    }
    body { background-color: var(--bg-light) !important; }
    .card { border-radius: 24px !important; }
    .form-control { border-radius: 12px !important; padding: 0.75rem 1rem !important; }
    .btn-primary { border-radius: 12px !important; padding: 0.75rem !important; background-color: var(--primary-color) !important; border: none !important; }
    .btn-primary:hover { background-color: var(--primary-hover) !important; }
</style>

<div class="row justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="col-md-5 col-lg-4">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-dark">Welcome Back</h2>
            <p class="text-muted">Enter your credentials to access your portal</p>
        </div>
        
        <?php if (session('error')): ?>
            <div class="alert alert-danger border-0 shadow-sm rounded-4 small py-3 mb-4 d-flex align-items-center">
                <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <?= session('error') ?>
            </div>
        <?php endif; ?>
        
        <?php if (session('success')): ?>
            <div class="alert alert-success border-0 shadow-sm rounded-4 small py-3 mb-4 d-flex align-items-center">
                <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                <?= session('success') ?>
            </div>
        <?php endif; ?>
        
        <div class="card p-4 shadow-sm border-0">
            <form action="<?= base_url('login/auth') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label class="form-label small fw-bold text-dark opacity-75">Email Address</label>
                    <input type="email" name="email" class="form-control bg-light border-0" placeholder="name@email.com" required>
                </div>
                
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <label class="form-label small fw-bold text-dark opacity-75">Password</label>
                    </div>
                    <input type="password" name="password" class="form-control bg-light border-0" placeholder="••••••••" required>
                </div>
                
                <button type="submit" class="btn btn-primary w-100 fw-bold shadow-sm transition-transform hover-scale">Sign In</button>
            </form>
        </div>

        <div class="text-center mt-5">
            <p class="small text-muted mb-0">Don't have an account? 
                <a href="<?= base_url('register') ?>" class="text-primary text-decoration-none fw-bold">Create Account</a>
            </p>
        </div>
    </div>
</div>
<?= $this->endSection() ?>