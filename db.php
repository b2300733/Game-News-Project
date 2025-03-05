<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "assignment";

// Enable error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    echo "Database Connected successfully";
} catch (mysqli_sql_exception $e) {
    echo "Failed to connect: " . $e->getMessage();
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function updatePostCount($conn, $topic_id) {
    $sql = "UPDATE topics SET posts_count = (SELECT COUNT(*) FROM posts WHERE topic_id = ?) WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $topic_id, $topic_id);
    $stmt->execute();
    $stmt->close();
}

?>

