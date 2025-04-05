<?php
require_once ('inc/header.php');


$id = $_GET['id'];
$products = getProducts();

$result = null;
foreach($products as $product){
    if($product['id'] == $id){
        $result = $product;
        break;
    }
}


?>


<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row">
            <div class="col-lg-6">
                <img class="img-fluid" src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" />
            </div>
            <div class="col-lg-6">
                <h3><?php echo $product['name']; ?></h3>
                <p><?php echo $product['description']; ?></p>
                <p><strong>Price: </strong>$<?php echo $product['price']; ?></p>
  
                <form method="post" action="handelers/add_to_cart.php">
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    <a href="index.php" class="btn btn-outline-dark mt-auto">Go back</a>
                    <button type="submit" class="btn btn-outline-dark mt-auto">Add to cart</button>
                </form>
                
            </div>
        </div>
    </div>
</section>


<?php require_once('inc/footer.php'); ?>
