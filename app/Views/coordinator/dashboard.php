<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row g-4 mb-5">
    <!-- Welcome Card -->
    <div class="col-12">
        <div class="card bg-primary text-white p-4 border-0 shadow">
            <div class="card-body py-4">
                <h1 class="display-5 fw-bold mb-2">Coordinator Portal</h1>
                <p class="fs-5 opacity-75 mb-0">Welcome Back, <?= session()->get('user')['name'] ?>!</p>
            </div>
        </div>
    </div>

    <!-- Coordinator Stats Cards -->
    <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100 p-3">
            <div class="card-body d-flex align-items-center">
                <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-4 me-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
                </div>
                <div>
                    <h5 class="card-title fw-bold mb-0 text-primary">Coordination Files</h5>
                    <p class="text-muted small mb-2">Access your shared resources</p>
                    <a href="<?= base_url('coordinator/files') ?>" class="btn btn-sm btn-primary text-white rounded-pill px-3">View Files</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
