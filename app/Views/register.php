<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="card-title mb-3 text-center">Register</h3>
                <form action="/register" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" value="<?= old('name') ?>">
                        <?php if(isset(session()->getFlashdata('errors')['name'])): ?>
                            <div class="text-danger"><?= session()->getFlashdata('errors')['name'] ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?= old('email') ?>">
                        <?php if(isset(session()->getFlashdata('errors')['email'])): ?>
                            <div class="text-danger"><?= session()->getFlashdata('errors')['email'] ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control">
                        <?php if(isset(session()->getFlashdata('errors')['password'])): ?>
                            <div class="text-danger"><?= session()->getFlashdata('errors')['password'] ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="pass_confirm" class="form-control">
                        <?php if(isset(session()->getFlashdata('errors')['pass_confirm'])): ?>
                            <div class="text-danger"><?= session()->getFlashdata('errors')['pass_confirm'] ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-primary">Register</button>
                    </div>
                </form>
                <p class="mt-2 text-center">Already have an account? <a href="/login">Login</a></p>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>