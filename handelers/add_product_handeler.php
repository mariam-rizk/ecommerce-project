<?php
session_start();
include '../core/functions.php';
include '../core/validation.php';
include '../core/messages.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = (trim($_POST['name']));
    $price = (trim($_POST['price']));
    $description = (trim($_POST['description']));
    $image = $_FILES['image'];
    

   $errors = validateProduct($name, $description, $price);


    if (!empty($errors)) {
        setMessage('danger', $errors);
        header('Location: ../add_product.php');
        exit();
    }
   
    
    if (addProduct($name, $description, $price, $image)) {
        setMessage('success', "Product added successfully");
        header("Location: ../show_products.php");
        exit();
    } else {
        setMessage('danger', "Failed to add new product");
        header("Location: ../add_product.php");
        exit();
    }
} else {
    die("Invalid Request Method");
}
?>
