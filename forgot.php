<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $new_password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $sql = "UPDATE users SET password='$new_password' WHERE email='$email'";

        if ($conn->query($sql) === TRUE) {
            echo "Password updated successfully";
        } else {
            echo "Error updating password: " . $conn->error;
        }
    } else {
        echo "Email and New Password are required.";
    }

    $conn->close();
}
?>
