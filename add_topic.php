<?php
session_start();
include 'db.php';

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    echo 'You need to log in first.';
    exit();
}

// Check if POST request contains title and description
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['title']) && isset($_POST['description'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $user = $_SESSION['email'];  // Get user's email from session
    $date = date('Y-m-d H:i:s');

    // Debugging: Check received data
    echo "Title: " . htmlspecialchars($title) . "<br>";
    echo "Description: " . htmlspecialchars($description) . "<br>";
    echo "User: " . htmlspecialchars($user) . "<br>";
    echo "Date: " . $date . "<br>";

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO topics (title, description, last_post_user, last_post_date, posts_count) VALUES (?, ?, ?, ?, 0)");
    $stmt->bind_param("ssss", $title, $description, $user, $date);

    if ($stmt->execute()) {
        echo "New topic created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    header("Location: community.php");
    exit();
} else {
    echo "Title and Description are required.";
}
?>
