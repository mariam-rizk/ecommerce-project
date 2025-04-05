<?php
session_start();
include '../core/functions.php';
include '../core/validation.php';
include '../core/messages.php';

if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
    exit();
}

if (empty($_SESSION['cart'])) {
    header('Location: ../cart.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $address = htmlspecialchars($_POST['address']);
    $phone = htmlspecialchars($_POST['phone']);
    $notes = htmlspecialchars($_POST['notes']);

    $errors = validateCheckout($name, $email, $address, $phone);
    if (!empty($errors)) {
        setMessage('danger', $errors);
        header('Location: ../checkout.php');
        exit();
    }

    $cart = $_SESSION['cart'];
    $totalPrice = 0;
    foreach ($cart as $item) {
        $totalPrice += $item['price'] * $item['quantity'];
    }
    $userId = $_SESSION['user']['id'];
    
    if(saveOrder($userId, $name, $email, $address, $phone, $notes, $cart, $totalPrice)){
        unset($_SESSION['cart']);
        $_SESSION['totalPrice'] = 0;
        setMessage('success', 'Your order has been placed successfully.');
        header('Location: ../index.php');
        exit();
    }
    else{
        setMessage('danger', 'Failed to place your order. Please try again.');
        header('Location: ../checkout.php');
        exit();
    }
    
  
  
}
?>
