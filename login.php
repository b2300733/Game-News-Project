<?php
include 'db.php';
session_start();

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email']) && isset($_POST['password'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT id, password, role FROM users WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $row['role'];
            $_SESSION['user_id'] = $row['id'];

            // Insert login event
            $user_id = $row['id'];
            $login_query = "INSERT INTO user_logins (user_id, login_time) VALUES (?, NOW())";
            $login_stmt = $conn->prepare($login_query);
            $login_stmt->bind_param("i", $user_id);
            $login_stmt->execute();

            $response['success'] = true;
            $response['message'] = "Login successful!";
            $response['role'] = $row['role'];

            if ($row['role'] == 'admin') {
                $response['redirect'] = 'admin.php';
            } else {
                $response['redirect'] = 'community.php';
            }
        } else {
            $response['success'] = false;
            $response['message'] = "Incorrect email/password combination.";
        }
    } else {
        $response['success'] = false;
        $response['message'] = "Incorrect email/password combination.";
    }
} else {
    $response['success'] = false;
    $response['message'] = "Email and Password are required.";
}

echo json_encode($response);
exit();
?>
