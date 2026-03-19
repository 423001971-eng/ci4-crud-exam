<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row align-items-center mb-4">
    <div class="col">
        <h2 class="fw-bold mb-0">Role Management</h2>
        <p class="text-muted">Create and manage access roles</p>
    </div>
    <div class="col-auto">
        <a href="<?= base_url('admin/roles/create') ?>" class="btn btn-primary shadow-sm">+ New Role</a>
    </div>
</div>

<?php if (session('success')): ?>
    <div class="alert alert-success"><?= session('success') ?></div>
<?php endif; ?>
<?php if (session('error')): ?>
    <div class="alert alert-danger"><?= session('error') ?></div>
<?php endif; ?>

<div class="card overflow-hidden shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th class="ps-4">ID</th>
                    <th>Slug (Identifier)</th>
                    <th>Name (Label)</th>
                    <th>Users Count</th>
                    <th>Created At</th>
                    <th class="text-end pe-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($roles as $r): ?>
                <tr>
                    <td class="ps-4"><?= esc($r['id']) ?></td>
                    <td><span class="badge bg-secondary"><?= esc($r['slug']) ?></span></td>
                    <td class="fw-semibold"><?= esc($r['name']) ?></td>
                    <td><span class="badge bg-info-subtle text-info border border-info-subtle px-3"><?= esc($r['user_count']) ?></span></td>
                    <td class="small"><?= date('M d, Y', strtotime($r['created_at'])) ?></td>
                    <td class="text-end pe-4">
                        <div class="btn-group shadow-sm">
                            <a href="<?= base_url('admin/roles/edit/' . $r['id']) ?>" class="btn btn-sm btn-outline-warning">Edit</a>
                            <?php if ($r['slug'] !== 'admin'): ?>
                                <a href="<?= base_url('admin/roles/delete/' . $r['id']) ?>" onclick="return confirm('Delete this role? Users will be unassigned.')" class="btn btn-sm btn-outline-danger">Delete</a>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
