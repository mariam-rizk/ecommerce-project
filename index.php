<?php require_once ('inc/header.php'); ?>


<!-- Section -->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
       
            <?php foreach (getProducts() as $product): ?>
            <div class="col mb-5">
                <div class="card h-100">
                    <!-- Product image -->
                    <img class="card-img-top" src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" />
                    <!-- Product details -->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name -->
                            <h5 class="fw-bolder"><?php echo $product['name']; ?></h5>
                            <!-- Product price -->
                            
                            $<?php echo $product['price']; ?>
                        </div>
                    </div>
                    <!-- Product actions -->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center">
                        <a class="btn btn-outline-dark mt-auto" href="product_details.php?id=<?php echo $product['id']; ?>">View options</a>
                        </div>
                    <div class="text-center mt-2">
                    <form method="post" action="handelers/add_to_cart.php">
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    <button type="submit" class="btn btn-outline-dark mt-auto">Add to cart</button>
                    </form>

                    </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require_once('inc/footer.php'); ?>



     