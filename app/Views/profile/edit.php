<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <h4 class="fw-bold mb-4 text-center">Edit Student Profile</h4>

            <form action="<?= base_url('profile/update') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="row">
                    <div class="col-md-4 text-center border-end">
                        <div class="mb-3">
                            <img id="preview" src="<?= !empty($user['profile_image']) ? base_url('uploads/profiles/' . $user['profile_image']) : '#' ?>" 
                                 class="rounded-circle img-thumbnail <?= empty($user['profile_image']) ? 'd-none' : '' ?>" 
                                 style="width: 160px; height: 160px; object-fit: cover;">
                        </div>
                        <label class="form-label small fw-bold">Update Profile Picture</label>
                        <input type="file" name="profile_image" id="profile_image" class="form-control form-control-sm" accept="image/*" onchange="previewImage(event)">
                        <div class="text-danger small mt-1"><?= session('errors.profile_image') ?></div>
                    </div>

                    <div class="col-md-8 px-4">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="name" class="form-control <?= session('errors.name') ? 'is-invalid' : '' ?>" value="<?= old('name', esc($user['name'])) ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control <?= session('errors.email') ? 'is-invalid' : '' ?>" value="<?= old('email', esc($user['email'])) ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Student ID</label>
                                <input type="text" name="student_id" class="form-control <?= session('errors.student_id') ? 'is-invalid' : '' ?>" value="<?= old('student_id', esc($user['student_id'])) ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Course</label>
                                <input type="text" name="course" class="form-control <?= session('errors.course') ? 'is-invalid' : '' ?>" value="<?= old('course', esc($user['course'])) ?>">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Year</label>
                                <input type="number" name="year_level" class="form-control <?= session('errors.year_level') ? 'is-invalid' : '' ?>" value="<?= old('year_level', esc($user['year_level'])) ?>">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Section</label>
                                <input type="text" name="section" class="form-control" value="<?= old('section', esc($user['section'])) ?>">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control <?= session('errors.phone') ? 'is-invalid' : '' ?>" value="<?= old('phone', esc($user['phone'])) ?>">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Home Address</label>
                                <textarea name="address" class="form-control <?= session('errors.address') ? 'is-invalid' : '' ?>"><?= old('address', esc($user['address'])) ?></textarea>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                            <a href="<?= base_url('profile') ?>" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        if (event.target.files && event.target.files[0]) {
            const reader = new FileReader();
            reader.onload = (e) => { 
                const previewImg = document.getElementById('preview');
                previewImg.src = e.target.result; 
                previewImg.classList.remove('d-none');
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    }
</script>
<?= $this->endSection() ?>