<?php
session_start();
require 'Connection.php';

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header('location: http://localhost/Project1/Admin.html');
    exit();
}

// Check if the email parameter is set
if (isset($_GET['email'])) {
    // Sanitize the email parameter
    $email = mysqli_real_escape_string($connection, $_GET['email']);

    // Prepare the SQL statement to delete the record
    $deleteQuery = "DELETE FROM complete_info WHERE Email = ?";
    $stmt = $connection->prepare($deleteQuery);
    $stmt->bind_param("s", $email);

    // Execute the statement
    if ($stmt->execute()) {
        // If successful, redirect to the main page with a success message
        $_SESSION['message'] = "Record deleted successfully.";
        header('Location: Detail_view.php');
        exit();
    } else {
        // If there was an error, display an error message
        echo "Error deleting record: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    // If no email is provided, redirect to the main page
    header('Location: Detail_view.php');
    exit();
}

// Close the database connection
$connection->close();
?>
