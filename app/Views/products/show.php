<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Item Details: #<?= $product['id'] ?></h5>
                <span class="badge bg-<?= ($product['stock'] > 0) ? 'success' : 'danger' ?>">
                    <?= ($product['stock'] > 0) ? 'In Stock' : 'Out of Stock' ?>
                </span>
            </div>
            <div class="card-body">
                <h2 class="text-primary"><?= $product['title'] ?></h2>
                <hr>
                <dl class="row">
                    <dt class="col-sm-3">Description</dt>
                    <dd class="col-sm-9 text-muted"><?= $product['description'] ?></dd>

                    <dt class="col-sm-3">Current Price</dt>
                    <dd class="col-sm-9"><span class="h4 text-success">$<?= number_format($product['price'], 2) ?></span></dd>

                    <dt class="col-sm-3">Stock Level</dt>
                    <dd class="col-sm-9"><?= $product['stock'] ?> units</dd>

                    <dt class="col-sm-3">Added On</dt>
                    <dd class="col-sm-9"><?= date('F d, Y', strtotime($product['created_at'])) ?></dd>
                </dl>
            </div>
            <div class="card-footer bg-white py-3">
                <a href="<?= base_url('products') ?>" class="btn btn-secondary">Back</a>
                <a href="<?= base_url('products/edit/'.$product['id']) ?>" class="btn btn-warning">Edit Record</a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>