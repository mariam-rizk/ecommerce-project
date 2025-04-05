<?php
require_once ('inc/header.php');
$totalPrice = 0;
?>



<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($_SESSION['cart'])): ?>
                        <?php foreach ($_SESSION['cart'] as $item): ?>
                            <?php
                                $itemTotal = $item['price'] * $item['quantity'];
                                $totalPrice += $itemTotal;
                            ?>
                            <tr>
                                <td><?= $item['id'] ?></td>
                                <td><?= $item['name'] ?></td>
                                <td><?= number_format($item['price'], 2) ?> $</td>
                                <td>
                                    <input type="number" class="form-control quantity-input" 
                                        data-id="<?= $item['id'] ?>" 
                                        value="<?= $item['quantity'] ?>" 
                                        min="1" style="width: 80px;">
                                </td>
                                <td id="item-total-<?= $item['id'] ?>">
                                   <?= number_format($itemTotal, 2) ?> $
                                </td>
                                <td>
                                    <a href="handelers/delete_from_cart.php?id=<?= $item['id'] ?>" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="4"><strong>Total Price</strong></td>
                            <td>
                                <strong id="total-price"><?= number_format($totalPrice, 2) ?> $
                            </strong>
                            </td>
                            <td>
                                <a href="index.php" class="btn btn-outline-dark">Continue Shopping</a>
                                <a href="checkout.php" class="btn btn-outline-dark">Checkout</a>
                            </td>
                        </tr>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Your Cart is empty</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<script>
document.querySelectorAll('.quantity-input').forEach(input => {
    input.addEventListener('change', function () {
        const productId = this.dataset.id;
        const quantity = parseInt(this.value);

        fetch('handelers/update_cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `product_id=${productId}&quantity=${quantity}`
        })
        .then(response => response.json())
        .then(data => {
            
            const itemTotalElement = document.getElementById(`item-total-${productId}`);
            if (itemTotalElement) {
                itemTotalElement.innerText = data.itemTotal + ' $';
            }

           
            const totalPriceElement = document.getElementById('total-price');
            if (totalPriceElement) {
                totalPriceElement.innerText = data.totalPrice + ' $';
            }
        });
    });
});
</script>

<?php require_once('inc/footer.php'); ?>
