<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'products');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        // Check if the user exists
        $stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($hashedPassword);
            $stmt->fetch();

            // Verify the password
            if (password_verify($password, $hashedPassword)) {
                // Redirect to home page
                echo "<script>
                alert('Sign-in successful!');
                window.location.href = 'index.html';
              </script>";
                
            } else {
                echo "<p>Invalid email or password. Please try again.</p>";
            }
        } else {
            echo "<p>User does not exist. Please register first.</p>";
        }

        $stmt->close();
        $conn->close();
    }
}
?>
