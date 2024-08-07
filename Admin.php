<?php
session_start();

// Predefined array of email-password pairs
$users = [
    "user1@example.com" => "password123",
    "user2@example.com" => "securepass",
    "user3@example.com" => "mypassword",
];

// Get the input values
$email = $_POST['email'];
$password = $_POST['password'];

// Check if the email exists and the password matches
if (isset($users[$email]) && $users[$email] === $password) {
    // Successful login
    $_SESSION['email'] = $email;
    header("Location: Dash2.php"); // Redirect to another page
    exit();
} else {
    // Invalid credentials
    echo "Invalid email or password.";
}
?>

