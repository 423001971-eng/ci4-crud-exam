<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Student Details: #<?= esc($record['id']) ?></h5>
            </div>
            <div class="card-body p-4">
                <h2 class="fw-bold text-primary"><?= esc($record['name']) ?></h2>
                <hr>
                <dl class="row">
                    <dt class="col-sm-3">Email</dt>
                    <dd class="col-sm-9"><?= esc($record['email']) ?></dd>

                    <dt class="col-sm-3">Course</dt>
                    <dd class="col-sm-9"><?= esc($record['course']) ?></dd>

                    <dt class="col-sm-3">Description</dt>
                    <dd class="col-sm-9 text-muted"><?= esc($record['description']) ?></dd>

                    <dt class="col-sm-3">Created At</dt>
                    <dd class="col-sm-9"><?= date('F d, Y h:i A', strtotime($record['created_at'])) ?></dd>

                    <dt class="col-sm-3">Updated At</dt>
                    <dd class="col-sm-9"><?= date('F d, Y h:i A', strtotime($record['updated_at'])) ?></dd>
                </dl>
            </div>
            <div class="card-footer bg-white py-3">
                <div class="d-flex gap-2">
                    <a href="<?= base_url('students') ?>" class="btn btn-secondary">← Back</a>
                    <a href="<?= base_url('students/edit/' . $record['id']) ?>" class="btn btn-warning">Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
