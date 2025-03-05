<?php
// rate_post.php

// Database connection
$host = 'localhost';
$db = 'your_database';
$user = 'your_username';
$pass = 'your_password';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the POST data
$data = json_decode(file_get_contents('php://input'), true);

$postId = $data['post_id'];
$ratingType = $data['rating_type'];

// Validate input
if (!is_numeric($postId) || ($ratingType !== 'up' && $ratingType !== 'down')) {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
    exit;
}

// Update the database
if ($ratingType === 'up') {
    $sql = "UPDATE posts SET upvotes = upvotes + 1 WHERE id = ?";
} else {
    $sql = "UPDATE posts SET downvotes = downvotes + 1 WHERE id = ?";
}

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $postId);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Database error']);
}

$stmt->close();
$conn->close();
?>
