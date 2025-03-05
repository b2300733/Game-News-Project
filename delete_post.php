<?php
session_start();
include 'db.php';

if (isset($_GET['id'])) {
    $post_id = $_GET['id'];

    // Get the topic ID before deleting the post
    $sql = "SELECT topic_id FROM posts WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $stmt->bind_result($topic_id);
    $stmt->fetch();
    $stmt->close();

    // Delete the post
    $sql = "DELETE FROM posts WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $stmt->close();

    // Update the post count for the topic
    updatePostCount($conn, $topic_id);

    header("Location: admin.php");
    exit();
} else {
    header("Location: admin.php?error=Invalid post ID");
    exit();
}
?>
