<?php
// Start session at the very beginning
session_start();

// Initialize variables and error array
$email = isset($_REQUEST['email']) ? trim($_REQUEST['email']) : '';
$password = isset($_REQUEST['password']) ? trim($_REQUEST['password']) : '';

$error = array();

// Validate input
if(empty($email)){
  $error['email'] = 'Email is required';
}
else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
  $error['email'] = 'Invalid email format';
}
if(empty($password)){
  $error['password'] = 'Password is required';
}

// Handle errors or proceed
if(empty($error)){
    require_once('classes.php');
    $user=User::login($email, md5($password));
    switch ($user->role) {
        case 'admin':
            $_SESSION['user'] =serialize( $user);
            header('Location: frontend/admin/');
            break;
        case 'subscriber':
            header('Location: frontend/users/');
            break;
    }
    exit();
}
else{
    $_SESSION['error'] = $error;
    header('Location: home.php');
    exit();
}
