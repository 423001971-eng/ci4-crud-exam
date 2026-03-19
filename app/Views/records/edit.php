<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="mb-4">
            <a href="<?= base_url('students') ?>" class="text-decoration-none text-muted small">← Back to Students</a>
            <h2 class="fw-bold mt-2">Edit Student</h2>
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
            <form action="<?= base_url('students/update/' . $record['id']) ?>" method="POST">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Name</label>
                    <input type="text" name="name" class="form-control" value="<?= old('name', esc($record['name'])) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= old('email', esc($record['email'])) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Course</label>
                    <input type="text" name="course" class="form-control" value="<?= old('course', esc($record['course'])) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Description</label>
                    <textarea name="description" class="form-control" rows="4"><?= old('description', esc($record['description'])) ?></textarea>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-warning fw-bold">Update Student</button>
                    <a href="<?= base_url('students') ?>" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
