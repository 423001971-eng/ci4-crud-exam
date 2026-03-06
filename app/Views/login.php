<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="card-title mb-3 text-center">Login</h3>
                <form action="/login" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?= old('email') ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-primary">Login</button>
                    </div>
                </form>
                <p class="mt-2 text-center">Don't have an account? <a href="/register">Register</a></p>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>