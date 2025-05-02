<?php


function readJson($file_name){
    return file_exists($file_name) ? json_decode(file_get_contents($file_name), true) : [];
}




function writeJson($file_name, $data){
    return file_put_contents($file_name, json_encode($data, JSON_PRETTY_PRINT));
}


$usersJsonFile = realpath(__DIR__ . "/../data/users.json");
$productsJsonFile =realpath(__DIR__ . "/../data/products.json");
$ordersJsonFile = realpath(__DIR__ . "/../data/orders.json");
function register($name, $email , $password , $remember_me , $role = 'user') {
    $users_json_file = $GLOBALS['usersJsonFile'];
    $users = readJson($users_json_file);
    if(!is_array($users)){
        $users = [];
    }

    foreach($users as $user){
        if($user['email'] === $email){
            return "You have already registered with this email before";
        }
    }
    $id = empty($users) ? 1 : max(array_column($users , 'id')) + 1;
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $new_user = [
        'id' => $id,
        'name' => $name,
        'email' => $email,
        'password' => $hashedPassword,
        'role' => $role
    ];
    $users[] = $new_user;
    writeJson($users_json_file, $users);
    $_SESSION['user'] = $new_user;
    if ($remember_me) {
        setcookie('remember_me', $email, time() + (86400 * 30), "/"); 

    
    }  
    return true;
}



function login ($email, $password, $remember_me = false)
{
    $users_json_file = $GLOBALS['usersJsonFile'];
    $users = readJson($users_json_file);
    
    if(!is_array($users)){
        $users = [];
    }
    $user_found = false;
    foreach ($users as $user){
        if($user['email'] === $email && password_verify($password, $user['password'])){
            $user_found = $user;
            break;
        }
    }
    if($user_found){
        $_SESSION['user'] = $user_found;
    }
    if($remember_me){
        setcookie('remember_me', $email, time() + (86400 * 30), "/");
         return true;
    }
    
        return false;
}



function addProduct($name, $description, $price, $image) {
    $imageName = time() . '_' . $image['name'];
    move_uploaded_file($image['tmp_name'], "../assets/img/" . $imageName);

    $productsFile = $GLOBALS['productsJsonFile'];
    $products = readJson($productsFile);
    if (!is_array($products)) {
        $products = [];
    }

    $id = empty($products) ? 1 : max(array_column($products, 'id')) + 1;

    $newProduct = [
        'id' => $id,
        'name' => $name,
        'description' => $description,
        'price' => $price,
        'image' => "assets/img/" . $imageName 
    ];

    $products[] = $newProduct;
    writeJson($productsFile, $products);
    return true;

}




function getProducts()
{
    $productsFile = $GLOBALS['productsJsonFile'];
    return readJson($productsFile);
}

  
function updateProduct($id , $updated_data){
    $productsFile = $GLOBALS['productsJsonFile'];
    $products = readJson($productsFile);
    
    if(!$products){
        return false;
    }
    $product_founded = false;
    foreach($products as &$product){
        if($product['id'] == $id){
            $product['name'] = $updated_data['name'];	
            $product['description'] = $updated_data['description'];
            $product['price'] = $updated_data['price'];
            if (!empty($updated_data['image'])) {
                $product['image'] = $updated_data['image'];
            }
            $product_founded = true;
            break;
        }
    }
    if(!$product_founded){
        return false;
    }

    writeJson($productsFile, $products);
    return true;
}


function deleteProduct($id){
    $productsFile = $GLOBALS['productsJsonFile'];
    $products = readJson($productsFile);

    
    if(!file_exists($productsFile)){
        return false;
    }
        
    $products = json_decode(file_get_contents($productsFile),true);
        
    if(!$products){
        return false;
    }
    
    $product_found = false;
    foreach($products as $key => $product){
        if($product['id'] == $id){
            unset($products[$key]);
            $product_found = true;
            break;
        }
    }
    
    if(!$product_found){
        return false;
    }
    
    $products = array_values($products);
    file_put_contents($productsFile, json_encode($products, JSON_PRETTY_PRINT));
    return true;
}
function getProductById($id) {
    $productsFile = $GLOBALS['productsJsonFile'];
    $products = readJson($productsFile);

    foreach ($products as $product) {
        if ($product['id'] == $id) {
            return $product;
        }
    }

    return false; 
}
    



function saveOrder($userId, $name, $email, $address, $phone, $notes, $cart, $totalPrice) {
    $orders_json_file = $GLOBALS['ordersJsonFile'];
    $orders = readJson($orders_json_file);
    $orderId = empty($orders) ? 1 : max(array_column($orders,'order_id')) + 1;

    $newOrder = [
        'order_id' => $orderId,
        'user_id' => $userId,
        'name' => $name,
        'email' => $email,
        'address' => $address,
        'phone' => $phone,
        'notes' => $notes,
        'total_price' => $totalPrice,
        'items' => $cart,
        'order_date' => date('Y-m-d H:i:s'),
    ];

    $orders[] = $newOrder;

    writeJson($orders_json_file, $orders);
    return true;
}




