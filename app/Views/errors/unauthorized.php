<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-6 text-center">
        <div class="card shadow-lg border-0 py-5">
            <div class="card-body">
                <div class="mb-4">
                    <span class="display-1 text-danger">403</span>
                </div>
                <h2 class="fw-bold mb-3">Unauthorized Access</h2>
                <p class="text-muted mb-4">
                    Your current role is <span class="badge bg-primary"><?= strtoupper(session('user')['role'] ?? 'Guest') ?></span>.
                    <br>
                    You do not have permission to access this page.
                </p>
                <div class="d-grid gap-2 col-8 mx-auto">
                    <?php 
                        $role = strtolower(session('user')['role'] ?? '');
                        $dashboard = match($role) {
                            'student' => base_url('student/dashboard'),
                            'coordinator' => base_url('coordinator/dashboard'),
                            'admin', 'teacher' => base_url('dashboard'),
                            default => base_url('login')
                        };
                    ?>
                    <a href="<?= $dashboard ?>" class="btn btn-primary py-2 fw-bold">Back to My Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
