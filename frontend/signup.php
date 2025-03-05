<?php

//this file is used to send signup data to the database
//it is included in the signup.html file

// Check if the PHP script is working
if (isset($_GET["test"])) {
    echo "PHP is working!";
    exit;
}
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Database connection
$host = "localhost"; // Change if your database is on another server
$dbname = "lms";
$username = "root";  // Change to your database username
$password = "";  // Change to your database password

$conn = new mysqli($host, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $pass = trim($_POST["password"]);

    // Validate inputs
    if (empty($user) || empty($email) || empty($pass)) {
        die("All fields are required!");
    }

    // Hash the password for security
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

    // Insert user into the database
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $user, $email, $hashed_password);

    if ($stmt->execute()) {
        echo "<script>alert('Signup successful! Redirecting to login...'); window.location.href='login.html';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }

    $stmt->close();
}

$conn->close();
?>
