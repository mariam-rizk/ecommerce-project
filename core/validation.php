<?php

function requirements($field , $value){
    return empty($value) ? "$field is required" : null ;
}

function validateEmail($email){
    return filter_var($email, FILTER_VALIDATE_EMAIL) ? null : "Invalid Email";
}


function validatePassword($password){
    if(strlen($password) < 8){
    return "Password must be at least 8 characters long";
    }
    if(!preg_match("/[0-9]/", $password)){
    return "Password must contain at least one number";
    }
    if(!preg_match("/[A-Z]/", $password)){
    return "Password must contain uppercase letter";
    }
    if(!preg_match("/[a-z]/", $password)){
    return "Password must contain lowercase letter";
    }
    if(!preg_match("/[!@#$%^&*(),.?':{}|<>]/", $password)){
    return "Password must contain special characters";
    }
    return null;
}


function validatePasswordMatch($password, $confirm_password)
{
    return $password === $confirm_password ? null : "Password does not match";
}

function maxLength($field , $value , $max){
    return trim(strlen($value)) > $max? "$field must be less than or equal to $max characters" : null;
}

function minLength($field , $value , $min){
    return trim(strlen($value)) < $min? "$field must be at least $min characters long" : null;
}

function checkNumber($field , $value){
    return is_numeric($value) && $value > 0? null : "$field must be a number and greater than zero";
}

function validatePhone($phone){
    return preg_match("/^01[0-9]{9}$/", $phone)? null : "Invalid phone number";
}






function validateRegister($name, $email, $password, $confirm_password) {
    $errors = []; 
    $fields = [
        'name' => $name,
        'email' => $email,
        'password' => $password,
        'confirm_password' => $confirm_password
    ];
    foreach ($fields as $field => $value) {
        if ($error = requirements($field, $value)) {
            $errors[] = $error;
        }
    }
  
    if ($error = maxLength("Name", $name, 20)) {
        $errors[] = $error;
    }

    if ($error = minLength("Name",$name, 3)) {
        $errors[] = $error;
    }

    if ($error = validateEmail($email)) {
        $errors[] = $error;
    }
 
    if ($error = validatePassword($password)) {
        $errors[] = $error;
    }

    if ($error = validatePasswordMatch($password, $confirm_password)) {
        $errors[] = $error;
    }

    return $errors;
}



function validateLogin( $email, $password) {
    $errors = []; 
    $fields = [
        'email' => $email,
        'password' => $password
    ];
    foreach ($fields as $field => $value) {
        if ($error = requirements($field, $value)) {
            $errors[] = $error;
        }
    }

    if ($error = validateEmail($email)) {
        $errors[] = $error;
    }
 
    if ($error = validatePassword($password)) {
        $errors[] = $error;
    }
    
    return $errors;
}



function validateProduct($name, $description, $price) {
    $errors = [];
    $fields = [
        'name' => $name,
        'description' => $description,
        'price' => $price,
    ];

    foreach ($fields as $field => $value) {
        if ($error = requirements($field, $value)) {
            $errors[] = $error;
        }
    }
    
    if ($error = maxLength("Name", $name, 50)) {
        $errors[] = $error;
    }
    if ($error = maxLength("Description", $description, 500)) {
        $errors[] = $error;
    }
    if($error = minLength("Description", $description , 20)){
        $errors[] = $error;
    }
    if($error = minLength("Name", $name , 3)){
        $errors[] = $error;
    }

   if($error = checkNumber("Price" , $price)){
       $errors[] = $error;
 
   }

    return $errors;
}


function validateCheckout($name, $email, $address, $phone){
    $errors = [];
    $fields = [
        'name' => $name,
        'email' => $email,
        'address' => $address,
        'phone' => $phone
    ];
    foreach ($fields as $field => $value) {
        if ($error = requirements($field, $value)) {
            $errors[] = $error;
        }
    }
    if ($error = validateEmail($email)) {
        $errors[] = $error;
    }
    if ($error = maxLength("Name", $name, 30)) {
        $errors[] = $error;
    }
    if ($error = maxLength("Address", $address,60)){
        $errors[] = $error;
    }
    if ($error = minLength("Name", $name, 3)) {
        $errors[] = $error;
    }
    if ($error = minLength("Address", $address,10)){
        $errors[] = $error;
    }
    if($error = validatePhone($phone)){
        $errors[] = $error;
    }
    return $errors;  
}
?>
