<?php
session_start();


if (isset($_GET['id']) && !empty($_GET['id'])) {
    $productId = $_GET['id'];


    if (!empty($_SESSION['cart'])) {
        $_SESSION['cart'] = array_filter($_SESSION['cart'], function($item) use ($productId) {
            return $item['id'] != $productId;
        });


        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
}

header('Location: ../cart.php');
exit;
?>
