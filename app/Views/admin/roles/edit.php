<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="mb-4">
            <a href="<?= base_url('admin/roles') ?>" class="text-decoration-none text-muted small">← Back to Roles</a>
            <h2 class="fw-bold mt-2">Edit Role</h2>
        </div>

        <?php if (session('errors')): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach (session('errors') as $e): ?>
                        <li><?= esc($e) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="card border-0 shadow-sm p-4">
            <form action="<?= base_url('admin/roles/update/' . $role['id']) ?>" method="POST">
                <?= csrf_field() ?>
                
                <?php 
                    $coreRoles = ['admin', 'teacher', 'student'];
                    $isCore = in_array($role['slug'], $coreRoles);
                ?>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Slug (Identifier)</label>
                    <input type="text" name="slug" class="form-control" value="<?= old('slug', $role['slug']) ?>" <?= $isCore ? 'readonly disabled' : 'required' ?>>
                    <?php if ($isCore): ?>
                        <small class="text-danger italic">Core role identifier cannot be changed.</small>
                    <?php else: ?>
                        <small class="text-muted">Unique identifier (no spaces)</small>
                    <?php endif; ?>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-semibold">Name (Display Label)</label>
                    <input type="text" name="name" class="form-control" value="<?= old('name', $role['name']) ?>" required>
                    <small class="text-muted">Display name for the UI</small>
                </div>
                
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-warning fw-bold">Update Role</button>
                    <a href="<?= base_url('admin/roles') ?>" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
