<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="card shadow-sm border-0">
        <div class="card-body p-5">
            <div class="row align-items-center">
                <div class="col-md-4 text-center">
                    <?php if (!empty($user['profile_image'])): ?>
                        <img src="<?= base_url('uploads/profiles/' . esc($user['profile_image'])) ?>" class="rounded-circle shadow" style="width: 180px; height: 180px; object-fit: cover;">
                    <?php else: ?>
                        <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center shadow" style="width: 180px; height: 180px;">
                            <span class="text-muted">No Photo</span>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-8">
                    <h2 class="fw-bold mb-1"><?= esc($user['name']) ?></h2>
                    <p class="text-primary mb-4"><?= esc($user['course']) ?> Student | ID: <?= esc($user['student_id']) ?></p>
                    
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <small class="text-muted d-block">Email Address</small>
                            <strong><?= esc($user['email']) ?></strong>
                        </div>
                        <div class="col-sm-3">
                            <small class="text-muted d-block">Year</small>
                            <strong><?= esc($user['year_level']) ?></strong>
                        </div>
                        <div class="col-sm-3">
                            <small class="text-muted d-block">Section</small>
                            <strong><?= esc($user['section']) ?></strong>
                        </div>
                        <div class="col-sm-6">
                            <small class="text-muted d-block">Phone Number</small>
                            <strong><?= esc($user['phone']) ?></strong>
                        </div>
                        <div class="col-sm-12">
                            <small class="text-muted d-block">Home Address</small>
                            <strong><?= esc($user['address']) ?></strong>
                        </div>
                    </div>
                    
                    <div class="mt-4 pt-3 border-top">
                        <a href="<?= base_url('profile/edit') ?>" class="btn btn-primary">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>