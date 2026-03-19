<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row g-4 mb-5">
    <!-- Welcome Card -->
    <div class="col-12">
        <div class="card bg-primary text-white p-4 border-0 shadow">
            <div class="card-body py-4">
                <h1 class="display-5 fw-bold mb-2">Welcome Back, <?= session()->get('user')['name'] ?>!</h1>
                <p class="fs-5 opacity-75 mb-0">Manage your student records and portal settings from here.</p>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100 p-3">
            <div class="card-body d-flex align-items-center">
                <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-4 me-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <div>
                    <h5 class="card-title fw-bold mb-0">Student List</h5>
                    <p class="text-muted small mb-2">Access all student records</p>
                    <a href="<?= base_url('students') ?>" class="btn btn-sm btn-primary rounded-pill px-3">View All</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100 p-3">
            <div class="card-body d-flex align-items-center">
                <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-4 me-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/></svg>
                </div>
                <div>
                    <h5 class="card-title fw-bold mb-0 text-primary">Add Student</h5>
                    <p class="text-muted small mb-2">Create a new entry</p>
                    <a href="<?= base_url('students/create') ?>" class="btn btn-sm btn-primary rounded-pill px-3">Register</a>
                </div>
            </div>
        </div>
    </div>

    <?php if (strtolower(session('user')['role']) === 'admin'): ?>
    <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100 p-3">
            <div class="card-body d-flex align-items-center">
                <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-4 me-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                </div>
                <div>
                    <h5 class="card-title fw-bold mb-0 text-primary">User Roles</h5>
                    <p class="text-muted small mb-2">Manage permissions</p>
                    <a href="<?= base_url('admin/roles') ?>" class="btn btn-sm btn-primary rounded-pill px-3">Manage</a>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>