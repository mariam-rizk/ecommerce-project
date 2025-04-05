<?php
session_start();
include '../core/validation.php';
include '../core/functions.php';
include '../core/messages.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}





if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    
    $imagePath = '';
    $image = $_FILES['image'];

    if (!empty($image['name'])) {
    $imageName = time() . '_' . $image['name'];
    move_uploaded_file($image['tmp_name'], "../assets/img/" . $imageName);
    $imagePath = "assets/img/" . $imageName;
    }





    $errors = validateProduct($name, $description, $price);

    if (!empty($errors)) {
        setMessage('danger', $errors);
        header("Location: ../edit_product.php?id=$id");
        exit;
    }

    $updated_data = [
        'id' => $id,
        'name' => $name,
        'description' => $description,
        'price' => $price,  
    ];
    if ($imagePath) {
    $updated_data['image'] = $imagePath;
    }

    if(updateProduct($id, $updated_data)){
        setMessage('success', "Product updated sucessfully");
        header("Location: ../show_products.php");
        exit;
    }else{
        setMessage('danger',"Fail to update Product");
        header("Location: ../edit_product.php?id=$id");
        exit;
    }
}else{
    die("Invalid request method");
}

    

?>

  



