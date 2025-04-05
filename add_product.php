<?php
require_once ('inc/header.php');

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location:index.php");
    exit();
}

?>
<div class="container mt-4 mb-4">
<h2>Add New Product</h2>
<form action="handelers/add_product_handeler.php" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="name" class="form-label">Product Name</label>
        <input type="text" name="name" id="name" class="form-control">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" id="description" class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" name="price" id="price" step="0.01" class="form-control">
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" name="image" id="image" accept="image/*" class="form-control">
    </div>
    <button type="submit" class="btn btn-outline-dark">Add</button>
</form>
</div>
<?php
require_once ('inc/footer.php');
?>