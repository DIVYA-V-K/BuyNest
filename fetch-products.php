<?php
include 'db-config.php';

$sql = "SELECT id, name, price, image FROM products";
$result = $conn->query($sql);

$products = array();
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

echo json_encode($products);
$conn->close();
?>
