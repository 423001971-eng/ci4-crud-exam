<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Item Details: #<?= esc($product['id']) ?></h5>
                <span class="badge bg-<?= ($product['stock'] > 0) ? 'success' : 'danger' ?>">
                    <?= ($product['stock'] > 0) ? 'In Stock' : 'Out of Stock' ?>
                </span>
            </div>
            
            <div class="card-body p-4">
                <h2 class="text-primary fw-bold"><?= esc($product['title']) ?></h2>
                <hr>
                
                <dl class="row">
                    <dt class="col-sm-3 fw-bold">Description</dt>
                    <dd class="col-sm-9 text-muted"><?= esc($product['description']) ?></dd>

                    <dt class="col-sm-3 fw-bold">Current Price</dt>
                    <dd class="col-sm-9">
                        <span class="h4 text-success fw-bold">₱<?= number_format($product['price'], 2) ?></span>
                    </dd>

                    <dt class="col-sm-3 fw-bold">Stock Level</dt>
                    <dd class="col-sm-9">
                        <span class="<?= ($product['stock'] <= 5) ? 'text-danger fw-bold' : '' ?>">
                            <?= esc($product['stock']) ?> units
                        </span>
                    </dd>

                    <dt class="col-sm-3 fw-bold">Added On</dt>
                    <dd class="col-sm-9"><?= date('F d, Y', strtotime($product['created_at'])) ?></dd>
                </dl>
            </div>
            
            <div class="card-footer bg-white py-3 border-top-0">
                <div class="d-flex gap-2">
                    <a href="<?= base_url('products') ?>" class="btn btn-secondary px-4">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                    <a href="<?= base_url('products/edit/'.$product['id']) ?>" class="btn btn-warning px-4">
                        Edit Record
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>