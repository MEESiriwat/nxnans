<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $your_id = $_POST['your_id'];
    $password = $_POST['password'];

    // database connection
    $conn = new mysqli('127.0.0.1:3306', 'root', '', 'example_siriwat');
    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    } else {
        // Using prepared statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO register (your_id, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $your_id, $password);

        if ($stmt->execute()) {
            echo "Registration successful.";
        } else {
            echo "Error during registration: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
} else {
    echo "Invalid request method.";
}
?>
