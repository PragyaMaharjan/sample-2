<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
session_destroy();

// Use header function for redirection instead of JavaScript
header("Location: index.php");
exit();
?>
