<?php
session_start();
include 'db.php';

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    echo 'You need to log in first.';
    exit();
}

$topic_id = $_POST['topic_id'];
$content = $_POST['content'];
$user = $_SESSION['email'];  // Get user's email from session
$date = date('Y-m-d H:i:s');

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO posts (topic_id, content, user, post_date) VALUES (?, ?, ?, ?)");
$stmt->bind_param("isss", $topic_id, $content, $user, $date);

if ($stmt->execute()) {
    // Update topics table
    $stmt_update = $conn->prepare("UPDATE topics SET posts_count = posts_count + 1, last_post_user = ?, last_post_date = ? WHERE id = ?");
    $stmt_update->bind_param("ssi", $user, $date, $topic_id);
    $stmt_update->execute();
    
    echo "New post created successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$stmt_update->close();
$conn->close();

header("Location: topic.php?id=$topic_id#last-post");  // Redirect to the topic page with anchor to last post
exit();
?>
