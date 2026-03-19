<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="mb-4">
            <a href="<?= base_url('admin/roles') ?>" class="text-decoration-none text-muted small">← Back to Roles</a>
            <h2 class="fw-bold mt-2">New Role</h2>
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
            <form action="<?= base_url('admin/roles/store') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Slug (Identifier)</label>
                    <input type="text" name="slug" class="form-control" placeholder="e.g. administrator" value="<?= old('slug') ?>" required>
                    <small class="text-muted">Unique identifier (no spaces)</small>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Name (Display Label)</label>
                    <input type="text" name="name" class="form-control" placeholder="e.g. System Administrator" value="<?= old('name') ?>" required>
                    <small class="text-muted">Display name for the UI</small>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary py-2 fw-bold">Create Role</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
