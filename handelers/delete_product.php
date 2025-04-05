<?php
session_start();
include '../core/functions.php';
include '../core/messages.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}


if($_SERVER["REQUEST_METHOD"] !== "POST" || !isset($_POST['id']) || empty($_POST['id'])){
    setMessage('danger',"Invalid request");
    header('Location: ../show_products.php');
    exit;
}


$id = $_POST['id'];

if(deleteProduct($id)){
    setMessage('success', "Product deleted sucessfully");
    header("Location: ../show_products.php");
    exit;
}else{
    setMessage('danger',"Failed to delete Product");
    header("Location: ../show_products.php");
    exit;
}
