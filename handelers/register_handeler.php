<?php
include '../core/validation.php';
include '../core/functions.php';
include '../core/messages.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars(trim($_POST['password']));
    $confirm_password = htmlspecialchars(trim($_POST['confirm_password']));
    $remember_me = isset($_POST['remember_me']);

    $errors = validateRegister($name , $email , $password , $confirm_password);
   
    if(!empty($errors)){
        setMessage('danger' , $errors);
        header('location: ../register.php');
        exit();
    }
    
   $register = register($name, $email, $password,$remember_me);
    if($register === true){
        setMessage('success', "Registered Successfully");
        header('location: ../index.php');
        exit();
    }else{
    setMessage('danger', $register);
    header('location:../register.php');
    exit();
    }

}else{
    die('Invalid Request Method');
}


   
?>
