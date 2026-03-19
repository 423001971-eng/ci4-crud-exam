<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center mt-5">
    <div class="col-md-6 text-center">
        <div class="card shadow border-0 p-5">
            <h1 class="display-1 text-danger fw-bold">403</h1>
            <h4 class="fw-bold">Access Denied</h4>
            <p class="text-muted">You don't have permission to view this page.</p>
            <a href="<?= base_url('login') ?>" class="btn btn-primary mt-3">Go Back to Login</a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
