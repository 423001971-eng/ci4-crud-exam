<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row align-items-center mb-4">
    <div class="col">
        <h2 class="fw-bold mb-0">Students</h2>
        <p class="text-muted">Manage student records</p>
    </div>
    <div class="col-auto">
        <a href="<?= base_url('students/create') ?>" class="btn btn-primary shadow-sm">+ Add Student</a>
    </div>
</div>

<?php if (session('success')): ?>
    <div class="alert alert-success"><?= session('success') ?></div>
<?php endif; ?>

<div class="card overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th class="ps-4">#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Course</th>
                    <th>Description</th>
                    <th>Created At</th>
                    <th class="text-end pe-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $r): ?>
                <tr>
                    <td class="ps-4"><?= esc($r['id']) ?></td>
                    <td class="fw-semibold"><?= esc($r['name']) ?></td>
                    <td><?= esc($r['email']) ?></td>
                    <td><?= esc($r['course']) ?></td>
                    <td class="text-muted small"><?= esc(substr($r['description'], 0, 50)) ?>...</td>
                    <td class="small"><?= date('M d, Y', strtotime($r['created_at'])) ?></td>
                    <td class="text-end pe-4">
                        <div class="btn-group shadow-sm">
                            <a href="<?= base_url('students/show/' . $r['id']) ?>" class="btn btn-sm btn-outline-secondary">View</a>
                            <a href="<?= base_url('students/edit/' . $r['id']) ?>" class="btn btn-sm btn-outline-warning">Edit</a>
                            <a href="<?= base_url('students/delete/' . $r['id']) ?>" onclick="return confirm('Delete this student?')" class="btn btn-sm btn-outline-danger">Delete</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($records)): ?>
                <tr><td colspan="7" class="text-center text-muted py-4">No student records found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
