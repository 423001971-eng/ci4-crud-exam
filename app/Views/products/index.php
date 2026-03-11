<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row align-items-center mb-4">
    <div class="col">
        <h2 class="fw-bold mb-0">Products</h2>
        <p class="text-muted">Manage your inventory and stock levels</p>
    </div>
    <div class="col-auto">
        <a href="<?= base_url('products/create') ?>" class="btn btn-primary shadow-sm">+ Add Product</a>
    </div>
</div>

<div class="card overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th class="ps-4">Product Info</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th class="text-end pe-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($products as $p): ?>
                <tr>
                    <td class="ps-4">
                        <div class="fw-semibold text-dark"><?= esc($p['title']) ?></div>
                        <div class="small text-muted"><?= esc(substr($p['description'], 0, 40)) ?>...</div>
                    </td>
                    <td class="fw-medium text-dark">₱<?= number_format($p['price'], 2) ?></td>
                    <td>
                        <?php if($p['stock'] > 10): ?>
                            <span class="badge rounded-pill bg-success-subtle text-success border border-success">In Stock (<?= $p['stock'] ?>)</span>
                        <?php else: ?>
                            <span class="badge rounded-pill bg-warning-subtle text-warning border border-warning">Low Stock (<?= $p['stock'] ?>)</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-end pe-4">
                        <div class="btn-group shadow-sm rounded">
                            <a href="<?= base_url('products/show/'.$p['id']) ?>" class="btn btn-white btn-sm border">View</a>
                            <a href="<?= base_url('products/edit/'.$p['id']) ?>" class="btn btn-white btn-sm border">Edit</a>
                            <a href="<?= base_url('products/delete/'.$p['id']) ?>" onclick="return confirm('Confirm delete?')" class="btn btn-white btn-sm border text-danger">Delete</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>