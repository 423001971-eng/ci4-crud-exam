<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="mb-4">
            <a href="<?= base_url('products') ?>" class="text-decoration-none text-muted small">← Back to Inventory</a>
            <h2 class="fw-bold mt-2">Add New Product</h2>
        </div>

        <div class="card border-0 shadow-sm p-4">
            <form action="<?= base_url('products/store') ?>" method="POST">
                <div class="mb-4">
                    <label class="form-label fw-semibold">Product Title</label>
                    <input type="text" name="title" class="form-control bg-light border-0 py-2 <?= session('errors.title') ? 'is-invalid' : '' ?>" placeholder="e.g. Wireless Mouse" value="<?= old('title') ?>">
                    <div class="invalid-feedback"><?= session('errors.title') ?></div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Description</label>
                    <textarea name="description" class="form-control bg-light border-0 py-2 <?= session('errors.description') ? 'is-invalid' : '' ?>" rows="4" placeholder="Briefly describe the product..."><?= old('description') ?></textarea>
                    <div class="invalid-feedback"><?= session('errors.description') ?></div>
                </div>
<div class="row">
    <div class="col-md-6 mb-4">
        <label class="form-label fw-semibold">Price (PHP)</label>
        <div class="input-group">
            <span class="input-group-text bg-light border-0">₱</span>
            <input type="number" step="0.01" name="price" 
                   class="form-control bg-light border-0 py-2 <?= session('errors.price') ? 'is-invalid' : '' ?>" 
                   placeholder="0.00" value="<?= old('price') ?>">
        </div>
        <div class="text-danger small mt-1"><?= session('errors.price') ?></div>
    </div>
    <div class="col-md-6 mb-4">
        <label class="form-label fw-semibold">Stock Quantity</label>
        <input type="number" name="stock" 
               class="form-control bg-light border-0 py-2 <?= session('errors.stock') ? 'is-invalid' : '' ?>" 
               placeholder="0" value="<?= old('stock') ?>">
        <div class="text-danger small mt-1"><?= session('errors.stock') ?></div>
    </div>
</div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary py-2 fw-bold">Save Product to Inventory</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>