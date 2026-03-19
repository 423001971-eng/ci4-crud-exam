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

<div class="row justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="col-md-6 col-lg-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-dark">Create Account</h2>
            <p class="text-muted">Join our portal to start managing your records</p>
        </div>

        <div class="card p-4 shadow-sm border-0">
            <form action="<?= base_url('register/store') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label class="form-label small fw-bold text-dark opacity-75">Full Name</label>
                    <input type="text" name="name" class="form-control bg-light border-0" placeholder="John Doe" value="<?= old('name') ?>" required>
                    <?php if(session('errors.name')): ?>
                        <small class="text-danger mt-1 d-block"><?= session('errors.name') ?></small>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold text-dark opacity-75">Email Address</label>
                    <input type="email" name="email" class="form-control bg-light border-0" placeholder="name@email.com" value="<?= old('email') ?>" required>
                    <?php if(session('errors.email')): ?>
                        <small class="text-danger mt-1 d-block"><?= session('errors.email') ?></small>
                    <?php endif; ?>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label class="form-label small fw-bold text-dark opacity-75">Password</label>
                        <input type="password" name="password" class="form-control bg-light border-0" placeholder="••••••••" required>
                        <?php if(session('errors.password')): ?>
                            <small class="text-danger mt-1 d-block"><?= session('errors.password') ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold text-dark opacity-75">Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control bg-light border-0" placeholder="••••••••" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 fw-bold shadow-sm transition-transform hover-scale">Create Account</button>
            </form>
        </div>

        <div class="text-center mt-5">
            <p class="small text-muted mb-0">Already have an account? 
                <a href="<?= base_url('login') ?>" class="text-primary text-decoration-none fw-bold">Sign In</a>
            </p>
        </div>
    </div>
</div>
<?= $this->endSection() ?>