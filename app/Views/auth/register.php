<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white"><h4>Register</h4></div>
            <div class="card-body">
                <form action="<?= base_url('register/store') ?>" method="POST">
                    <div class="mb-3">
                        <label>Full Name</label>
                        <input type="text" name="name" class="form-control" value="<?= old('name') ?>">
                        <small class="text-danger"><?= session('errors.name') ?></small>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="<?= old('email') ?>">
                        <small class="text-danger"><?= session('errors.email') ?></small>
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                        <small class="text-danger"><?= session('errors.password') ?></small>
                    </div>
                    <div class="mb-3">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control">
                    </div>
                    <button class="btn btn-primary w-100">Create Account</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>