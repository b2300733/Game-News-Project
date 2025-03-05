<?php
session_start();
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session
echo 'Logged out'; // Send a response back to the AJAX call

?>