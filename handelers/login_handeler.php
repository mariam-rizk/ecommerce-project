<?php
session_start();
include '../core/validation.php';
include '../core/functions.php';
include '../core/messages.php';


if($_SERVER['REQUEST_METHOD']=='POST'){

    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars(trim($_POST['password']));
    $remember_me = isset($_POST['remember_me']);

    $errors = validateLogin($email , $password);
    if(!empty($errors)){
        setMessage('danger' , $errors);
        header('location:../login.php');
        exit();
    }
    if(login($email, $password, $remember_me)){
     
        setMessage('success' , "Login successful");
        header('location:../index.php');
        exit();
    }else{
        setMessage('danger',"Invalid email or password");
        header('location:../login.php');
        exit();
    }


}else {
    die("Invalid Request Method");
}




   



