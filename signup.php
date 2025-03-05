<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Email and Password are required.";
    }

    $conn->close();
}
?>
