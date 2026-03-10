<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="p-5 mb-4 bg-light rounded-3 border shadow-sm">
    <div class="container-fluid py-5 text-center">
        <h1 class="display-5 fw-bold">Welcome, <?= session()->get('user_name') ?>!</h1>
        <p class="col-md-12 fs-4 text-muted">Manage your inventory records efficiently using the tools below.</p>
        <hr class="my-4">
        
        <div class="row justify-content-center g-4">
            <div class="col-md-4">
                <div class="card h-100 border-primary shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-primary">View Records</h5>
                        <p class="card-text small text-muted">Browse, search, and manage existing products.</p>
                        <a href="<?= base_url('products') ?>" class="btn btn-outline-primary">Open List</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-success shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-success">New Entry</h5>
                        <p class="card-text small text-muted">Add a brand new product to the database.</p>
                        <a href="<?= base_url('products/create') ?>" class="btn btn-outline-success">Add Record</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>