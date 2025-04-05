
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity'] = $quantity;

        $itemTotal = $_SESSION['cart'][$id]['price'] * $quantity;

        $total = 0;
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        echo json_encode([
            'itemTotal' => $itemTotal,
            'totalPrice' => $total
        ]);
        exit;
    }
}



