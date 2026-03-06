<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Products</h2>
    <a href="/products/create" class="btn btn-success">Add Product</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Description</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if($products): foreach($products as $product): ?>
            <tr>
                <td><?= $product['id'] ?></td>
                <td><?= $product['title'] ?></td>
                <td><?= $product['description'] ?></td>
                <td><?= $product['price'] ?></td>
                <td><?= $product['stock'] ?></td>
                <td>
                    <a href="/products/edit/<?= $product['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="/products/delete/<?= $product['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this product?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; else: ?>
            <tr><td colspan="6" class="text-center">No products found</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<?= $this->endSection() ?>