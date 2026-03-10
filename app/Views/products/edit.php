<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="card shadow">
    <div class="card-header bg-warning text-dark"><h4>Edit Product</h4></div>
    <div class="card-body">
        <form action="<?= base_url('products/update/'.$product['id']) ?>" method="POST">
            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="<?= $product['title'] ?>" required>
            </div>
            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control"><?= $product['description'] ?></textarea>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Price</label>
                    <input type="number" step="0.01" name="price" class="form-control" value="<?= $product['price'] ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Stock</label>
                    <input type="number" name="stock" class="form-control" value="<?= $product['stock'] ?>" required>
                </div>
            </div>
            <button type="submit" class="btn btn-dark">Update Product</button>
            <a href="<?= base_url('products') ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
<?= $this->endSection() ?>