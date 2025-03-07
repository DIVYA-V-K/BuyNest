<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'products');


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert user data into the database
        $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $firstName, $lastName, $email, $hashedPassword);

        if ($stmt->execute()) {
            // Redirect to home page
            header("Location: index.html");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
}
?>
