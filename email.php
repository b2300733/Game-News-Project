<?php
session_start();

// Destroy the session and unset the user ID and username
session_destroy();
unset($_SESSION['user-email']);

// Redirect to the login page or any other desired page
header("Location: index.html");
exit();