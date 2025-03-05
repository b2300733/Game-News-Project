<?php
session_start();
include 'db.php';

// Check if user is not logged in or not admin
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    header('Location: community.php');
    exit();
}

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $content = $_POST['content'];

    $query = "UPDATE posts SET content = '$content' WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header('Location: admin.php'); // Redirect back to admin dashboard
        exit();
    } else {
        echo "Error updating post: " . mysqli_error($conn);
    }
} else {
    $id = $_GET['id'];
    $query = "SELECT * FROM posts WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    $post = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
</head>
<body>
    <h1>Edit Post</h1>
    <form action="edit_post.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
        <textarea name="content" rows="4" cols="50"><?php echo htmlspecialchars($post['content']); ?></textarea><br>
        <button type="submit" name="submit">Update Post</button>
    </form>
</body>
</html>
