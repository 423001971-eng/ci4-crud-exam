<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row align-items-center mb-4">
    <div class="col">
        <h2 class="fw-bold mb-0">User Roles</h2>
        <p class="text-muted">Manage user roles and permissions</p>
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
                    <th class="ps-4">Name</th>
                    <th>Email</th>
                    <th>Current Role</th>
                    <th class="text-end pe-4">Assign New Role</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $u): ?>
                <tr>
                    <td class="ps-4 fw-semibold"><?= esc($u['name']) ?></td>
                    <td><?= esc($u['email']) ?></td>
                    <td>
                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle">
                            <?= esc($u['role_name'] ?? 'No Role Assigned') ?>
                        </span>
                    </td>
                    <td class="text-end pe-4">
                        <?php if ($u['id'] != session('user')['id']): ?>
                            <form action="<?= base_url('admin/users/assignRole/' . $u['id']) ?>" method="POST" class="d-flex justify-content-end gap-2">
                                <?= csrf_field() ?>
                                <select name="role_id" class="form-select form-select-sm" style="width: auto;">
                                    <?php foreach ($roles as $role): ?>
                                        <option value="<?= $role['id'] ?>" <?= $u['role_id'] == $role['id'] ? 'selected' : '' ?>>
                                            <?= esc($role['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <button type="submit" class="btn btn-sm btn-primary">Update</button>
                            </form>
                        <?php else: ?>
                            <span class="text-muted small italic">Logged-in User</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
