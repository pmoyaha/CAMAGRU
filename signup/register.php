<?php
session_start();

include_once 'registration.php';

$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

$_SESSION['error'] = null;

if ($email == "" || $email == null || $username == "" || $username == null || $password == "" || $password == null) {
  $_SESSION['error'] = "Please fill all fields";
  header("Location: signup.php");
  return;
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $_SESSION['error'] = "Please enter a valid email";
  header("Location: signup.php");
  return;
}

if (strlen($username) > 25 || strlen($username) < 5) {
  $_SESSION['error'] = "Username should be beetween 5 and 25 characters";
  header("Location: signup.php");
  return;
}

if (strlen($password) < 5) {
  $_SESSION['error'] = "Password must atleast 5 characters, containing 1 out of 4 of the following: Lowercase charecters, uppercase characters, digits (0-9) and one or more of the following symbols: @ # $ & + = []";;
  header("Location: signup.php");
  return;
}

$url = $_SERVER['HTTP_HOST'] . str_replace("register.php", "", $_SERVER['REQUEST_URI']);

sign_up($email, $username, $password, $url);

header("Location: signup.php");
?>