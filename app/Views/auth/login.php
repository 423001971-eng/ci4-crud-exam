<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="row justify-content-center mt-5">
    <div class="col-md-5 col-lg-4">
        <div class="text-center mb-4">
            <h3 class="fw-bold">Welcome Back</h3>
            <p class="text-muted">Enter your credentials to manage stock</p>
        </div>
        <div class="card p-4 shadow-lg border-0">
            <form action="<?= base_url('login/auth') ?>" method="POST">
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Email Address</label>
                    <input type="email" name="email" class="form-control bg-light border-0 py-2" placeholder="name@company.com" required>
                </div>
                <div class="mb-4">
                    <label class="form-label small fw-semibold">Password</label>
                    <input type="password" name="password" class="form-control bg-light border-0 py-2" placeholder="••••••••" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 py-2 fw-bold shadow">Sign In</button>
            </form>
        </div>
        <div class="text-center mt-4">
            <p class="small text-muted">Don't have an account? <a href="<?= base_url('register') ?>" class="text-primary text-decoration-none fw-semibold">Register here</a></p>
        </div>
    </div>
</div>
<?= $this->endSection() ?>