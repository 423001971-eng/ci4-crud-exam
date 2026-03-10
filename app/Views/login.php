<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="text-center mb-4">Login</h3>
                <form action="<?= base_url('login/auth') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-primary">Login</button>
                    </div>
                </form>
                <p class="mt-3 text-center">Don't have an account? <a href="<?= base_url('register') ?>">Register</a></p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
