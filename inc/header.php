<?php
session_start();

if (isset($_SESSION['user'])) {
    $user_name = $_SESSION['user']['name'];
    $user_role = $_SESSION['user']['role'];   
} else {
    $user_name = 'Guest'; 
}

$cartCount = 0;
if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $cartCount += $item['quantity']; 
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Shop Homepage - EraaSoft PMS Template</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="assets/css/styles.css" rel="stylesheet" />
        <style>
        .dropdown-item:active {
        background-color: black;
        
}
</style>

    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container d-flex justify-content-between align-items-center">
        <!-- Brand -->
        <a class="navbar-brand" href="#!">EraaSoft PMS</a>

        <!-- Navigation Links -->
        <ul class="navbar-nav d-flex flex-row gap-3 list-unstyled">
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
            <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
        </ul>

        <!-- User Info and Links -->
        <div class="d-flex align-items-center">
            <?php if (isset($_SESSION['user'])): ?>
                <!-- Admin Menu -->
                <?php if ($user_role == 'admin'): ?>
                    <li class="nav-item dropdown me-3" style="list-style: none;">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Admin Menu
                    </a>
                    <ul class="dropdown-menu" style="list-style: none; padding: 0; margin: 0;">
                        <li><a class="dropdown-item" href="show_products.php">All Products</a></li>
                        <li><a class="dropdown-item" href="add_product.php">Add new Product</a></li>
                    </ul>
                    </li>

                <?php endif; ?>

                <span class="nav-link me-3">Hello, <?php echo $user_name; ?> <?php echo ($user_role == 'admin') ? '(Admin)' : ''; ?></span>
                <a class="nav-link me-3" href="handelers/logout_handeler.php">Logout</a>
            <?php else: ?>
                <span class="nav-link me-3">Hello, Guest</span>
                <a class="nav-link me-3" href="login.php">Login</a>
                <a class="nav-link me-3" href="register.php">Register</a>
            <?php endif; ?>
        </div>

        <!-- Cart Button -->
    

        <form class="d-flex" action="cart.php" method="get">
        <button class="btn btn-outline-dark" type="submit">
        <i class="bi bi-cart-fill me-1"></i>
        Cart
        <span class="badge bg-dark text-white ms-2 rounded-pill">
            <?= $cartCount ?>
        </span>
        </button>
        </form>



        </div>
        </nav>



        
    <!-- Header-->
    <header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Shop in style</h1>
            <p class="lead fw-normal text-white-50 mb-0">With this shop homepage template</p>
        </div>
    </div>
    </header>

        <?php
        include "core/functions.php"; 
        include 'core/messages.php';
        $message = getMessage();
        ?>
