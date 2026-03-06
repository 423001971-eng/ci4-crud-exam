<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Edit Product</h2>

<form action="/products/update/<?= $product['id'] ?>" method="post">
    <?= csrf_field() ?>
    <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" name="title" value="<?= $product['title'] ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control"><?= $product['description'] ?></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Price</label>
        <input type="number" step="0.01" name="price" value="<?= $product['price'] ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Stock</label>
        <input type="number" name="stock" value="<?= $product['stock'] ?>" class="form-control">
    </div>
    <div class="d-grid">
        <button class="btn btn-primary">Update</button>
    </div>
</form>

<?= $this->endSection() ?>