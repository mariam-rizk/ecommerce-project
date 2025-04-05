<?php
require_once ('inc/header.php');

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location:index.php");
    exit();
}

?>
<div class="container mt-4 mb-4">
<h2 class="mt-5">All Products</h2>
<a class="btn btn-outline-dark mt-auto" href="add_product.php">Add Product</a>
<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>id</th>
            <th>Product Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php
foreach (getProducts() as $product) {
    echo "<tr>
    <td>{$product['id']}</td>
    <td>{$product['name']}</td>
    <td>{$product['description']}</td>
    <td>{$product['price']}</td>
    <td><img src='{$product['image']}' alt='{$product['name']}' style='width: 100px; height: auto;'></td>
    <td style='display: flex; gap: 10px;'>
    <a href='edit_product.php?id={$product['id']}' class='btn btn-warning btn-sm'>Edit</a>
    <form action='handelers/delete_Product.php' method='POST' onsubmit='return confirmDelete();'>
    <input type='hidden' name='id' value='{$product['id']}'>
    <button class='btn btn-danger btn-sm'>Delete</button>
    </form>

    </td>
    </tr>
    ";
}
?>
</tbody>
</table>
</div>

<script>
function confirmDelete() {
    return confirm("Are you sure you want to delete this product?");
}
</script>

<?php
require_once ('inc/footer.php');
?>