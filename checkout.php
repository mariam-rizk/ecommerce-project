<?php 
require_once('inc/header.php'); 
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
$totalPrice = 0;
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $totalPrice += $item['price'] * $item['quantity'];
    }
}
?>

<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row">
            <!-- Products List -->
            <div class="col-4">
                <div class="border p-2">
                    <div class="products">
                    <h3>Products</h3>
                        <ul class="list-unstyled">
                            <?php if (!empty($_SESSION['cart'])): ?>
                                <?php foreach ($_SESSION['cart'] as $item): ?>
                                    <li class="border p-2 my-1">
                                        <?= $item['name'] ?> - 
                                        <span class="text-success mx-2 mr-auto bold"><?= $item['quantity'] ?> x <?= $item['price'] ?>$</span>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li class="text-center">No items in cart</li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <h3>Total: <?= $totalPrice ?>$</h3>
                </div>
            </div>

            <!-- Checkout Form -->
            <div class="col-8">
                <form action="handelers/process_checkout.php" method="POST" class="form border my-2 p-3" novalidate>
                <h3>Billing Information</h3>
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone">Phone</label>
                        <input type="number" name="phone" id="phone" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="notes">Notes</label>
                        <input type="text" name="notes" id="notes" class="form-control">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-outline-dark mt-auto">send</button>
                        <a href="index.php" class="btn btn-outline-dark mt-auto">Go back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require_once('inc/footer.php'); ?>

