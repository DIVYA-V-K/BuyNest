<?php
include 'db-config.php';

$sql = "SELECT * FROM products ORDER BY RAND() LIMIT 4"; // Randomly select 4 products
$result = $conn->query($sql);

$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

echo json_encode($products);
$conn->close();
?>


<?php
// Assume this is a mock response for the sake of example
header('Content-Type: application/json');

// Mock product data
$products = [
    ["name" => "Elegant Dress", "image" => "dress1.jpg", "price" => "$50"],
    ["name" => "Casual Shirt", "image" => "shirt1.jpg", "price" => "$30"],
    ["name" => "Stylish Jeans", "image" => "jeans1.jpg", "price" => "$40"]
];

echo json_encode($products);
?>
