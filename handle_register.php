<?php
// Start session at the very beginning
session_start();

// Initialize variables and error array
$name = isset($_REQUEST['name']) ? trim($_REQUEST['name']) : '';
$email = isset($_REQUEST['email']) ? trim($_REQUEST['email']) : '';
$ps = isset($_REQUEST['ps']) ? trim($_REQUEST['ps']) : '';
$pc = isset($_REQUEST['pc']) ? trim($_REQUEST['pc']) : '';
$phone = isset($_REQUEST['phone']) ? trim($_REQUEST['phone']) : '';

$error = array();

// Validate input
if(empty($name)){
  $error['name'] = 'Name is required';
}

if(empty($phone)){
  $error['phone'] = 'Phone is required';
}
if(empty($email)){
  $error['email'] = 'Email is required';
}
else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
  $error['email'] = 'Invalid email format';
}
if(empty($ps)){
  $error['ps'] = 'Password is required';
}
else if (strlen($ps) < 6){
  $error['ps'] = 'Password must be at least 6 characters';
}
if(empty($pc)){
  $error['pc'] = 'Password confirmation is required';
}
else if ($ps !== $pc){
  $error['pc'] = 'Password confirmation does not match';
}

// Handle errors or proceed
if(empty($error)){
  // Code to store data in database goes here
    require_once('classes.php');
    Subscriber::register($name, $email, $ps, $phone);
  // Redirect to login.php
  header('Location: login.php');
  exit();

}
else{
  // Save errors in session and redirect to index.php
  $_SESSION['error'] = $error;
  header('Location: index.php');
  exit(); // Stop further script execution
}
?>
